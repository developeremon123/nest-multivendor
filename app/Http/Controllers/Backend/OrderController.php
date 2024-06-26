<?php

namespace App\Http\Controllers\Backend;

use toastr;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   // pending orders
    public function pendingOrder()
    {
        $orders = Order::where('status','pending')->orderBy('id','desc')->get();
        return view('backend.order.pending_order',compact('orders'));
    }

   // confirm orders
    public function confirmedOrder()
    {
        $orders = Order::where('status','confirm')->orderBy('id','desc')->get();
        return view('backend.order.confirm_orders',compact('orders'));
    }

   // processing orders
    public function processingOrder()
    {
        $orders = Order::where('status','processing')->orderBy('id','desc')->get();
        return view('backend.order.processing_orders',compact('orders'));
    }

   // deliverded orders
    public function deliverdedOrder()
    {
        $orders = Order::where('status','deliverd')->orderBy('id','desc')->get();
        return view('backend.order.deliverded_orders',compact('orders'));
    }

    // Pending Order Details
    public function adminOrderDetails($id)
    {
        $order = Order::with('division','district','state','user')->whereId($id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id','desc')->get();
        return view('backend.order.order_details',compact('order','orderItem'));  
    }

    // Pending Order Confrim
    public function pendingConfirm($id)
    {
        Order::findOrFail($id)->update(['status' => 'confirm']);
        toastr()->success('Order Confirmed Successfully');
        return redirect()->route('admin.confirmed.order');
    }

    // Pending Order Confrim
    public function confirmProcessing($id)
    {
        Order::findOrFail($id)->update(['status' => 'processing']);
        toastr()->success('Order Processing Successfully');
        return redirect()->route('admin.processing.order');
    }

    // Pending Order Confrim
    public function processingDeliverd($id)
    {
        $product = OrderItem::where('order_id', $id)->get();
            foreach ($product as $item) {
                Product::where('id',$item->product_id)->update([
                    'product_qty' => DB::raw('product_qty-'.$item->qty) 
                ]);
            }
        Order::findOrFail($id)->update(['status' => 'deliverd']);
        toastr()->success('Order Deliverd Successfully');
        return redirect()->route('admin.deliverded.order');
    }

    // Admin Invoice Download
    public function invoiceDownload($id)
    {
        $order = Order::with('division','district','state','user')->whereId($id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id','desc')->get();
        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
            'tempDir'=> public_path(),
            'chroot'=> public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }

}
