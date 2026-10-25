<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RahmatHelper;
use App\Http\Controllers\Controller;
use App\Models\BookingServis;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', '');
        $search = trim($request->input('search', ''));

        $query = BookingServis::with(['pelanggan', 'layanan']);

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($search)) {
            $clean_num = preg_replace('/[^0-9]/', '', $search);
            $query->where(function ($q) use ($search, $clean_num) {
                if (!empty($clean_num)) {
                    $q->where('id', (int)$clean_num)
                      ->orWhereHas('pelanggan', function ($sub) use ($clean_num) {
                          $sub->where('no_hp', 'like', "%{$clean_num}%");
                      });
                }
                $q->orWhereHas('pelanggan', function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%");
                });
            });
        }

        $bookings = $query->latest('id')->paginate(15)->withQueryString();

        $counts = [
            'total' => BookingServis::count(),
            'Menunggu' => BookingServis::where('status', 'Menunggu')->count(),
            'Dikonfirmasi' => BookingServis::where('status', 'Dikonfirmasi')->count(),
            'Diproses' => BookingServis::where('status', 'Diproses')->count(),
            'Selesai' => BookingServis::where('status', 'Selesai')->count(),
            'Ditolak' => BookingServis::where('status', 'Ditolak')->count(),
            'Dibatalkan' => BookingServis::where('status', 'Dibatalkan')->count(),
        ];

        return view('admin.booking.index', compact('bookings', 'status', 'search', 'counts'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Dikonfirmasi,Diproses,Selesai,Ditolak,Dibatalkan',
            'catatan_admin' => 'nullable|string',
        ]);

        $booking = BookingServis::with(['pelanggan', 'layanan'])->findOrFail($id);
        $booking->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $redirect = redirect()->back()->with('success', 'Status booking #' . str_pad($booking->id, 3, '0', STR_PAD_LEFT) . ' berhasil diubah menjadi ' . $request->status);

        if ($request->has('send_wa') && $request->send_wa == '1' && !empty($booking->pelanggan->no_hp)) {
            $phone = RahmatHelper::formatNoHpWa($booking->pelanggan->no_hp);
            $pesan = RahmatHelper::generatePesanWaNotif($booking, $request->status, $request->catatan_admin ?? '');
            $wa_url = 'https://wa.me/' . $phone . '?text=' . urlencode($pesan);
            return $redirect->with('wa_url', $wa_url);
        }

        return $redirect;
    }

    public function destroy($id)
    {
        $booking = BookingServis::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking berhasil dihapus dari sistem.');
    }
}
