<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //admin
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.pages.order.index', compact('orders'));
    }


    public function show(string $id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id')->get();
        $transaction = Transaction::where('order_id', $id)->first();
        return view('admin.pages.order.show', compact('order', 'orderItems', 'transaction'));
    }

    public function update(Request $request)
    {
        //        dd($request);
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        if ($request->order_status == 'delivered') {
            $order->delivered_date = Carbon::now();
        } elseif ($request->order_status == 'cancelled') {
            $order->cancelled_date = Carbon::now();
        }
        $order->save();
        if ($request->order_status == 'delivered') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = 'approved';
            $transaction->save();
        }
        toastr()->success('Cập nhật thành công status!.', ['timer' => 1000]);
        return redirect()->back();
    }

    //    user

    public function view_order()
    {
        $orders = Order::where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('client.pages.viewOrder', compact('orders'));
    }
    // public function show_order($id)
    // {
    //     $order = Order::where('user_id', \Auth::user()->id)->where('id', $id)->first();
    //     if ($order) {
    //         $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(10);
    //         $transaction = Transaction::where('order_id', $order->id)->get();
    //         return view('client.pages.showOrder', compact('order', 'orderItems', 'transaction'));
    //     } else {
    //         return redirect()->back();
    //     }
    // }
    public function show_order($id)
    {
        $order = Order::where('user_id', \Auth::user()->id)->where('id', $id)->first();

        if (!$order) {
            toastr()->error('Đơn hàng không tồn tại hoặc bạn không có quyền xem!');
            return redirect()->route('client.orders'); // hoặc ->back()
        }

        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(10);
        $transaction = Transaction::where('order_id', $order->id)->get();
        // dd($transactions);
        // exit;

        return view('client.pages.showOrder', compact('order', 'orderItems', 'transaction'));
    }
    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = Carbon::now();
        $order->save();
        toastr()->success('Bạn đã huỷ đơn hàng!.', ['timer' => 1000]);
        return redirect()->back();
    }
}
