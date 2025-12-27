<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Daftar semua order user
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Detail order tertentu
     */
   public function show($id)
{
    $order = Order::with('items.product')
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $snapToken = null;

    // Hanya generate token jika status pending
    if ($order->status === 'pending') {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false; // Sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number . '-' . uniqid(),
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->shipping_name,
                'phone' => $order->shipping_phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }

    return view('orders.show', compact('order', 'snapToken'));
    }

    public function destroy($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending') // hanya bisa hapus pending
            ->firstOrFail();

        $order->items()->delete(); // hapus item order
        $order->delete();          // hapus order

        return back()->with('success', 'Pesanan berhasil dihapus');
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.success', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran pending.
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.pending', compact('order'));
    }
   
}
