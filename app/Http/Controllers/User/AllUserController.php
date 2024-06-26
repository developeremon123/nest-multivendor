<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    // User Account Details page
    public function userAccount(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details',compact('userData'));
    }

    // User Change Password page
    public function userChangePassword()
    {
        return view('frontend.userdashboard.change_password');

    }

    // User orders page
    public function userOrder()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id','desc')->get();
        return view('frontend.userdashboard.order_details',compact('orders'));

    }

    // User Order Details
    public function userOrderDetails($order_id)
    {
        $order = Order::with('division','district','state','user')->where((['id'=> $order_id, 'user_id'=> Auth::id()]))->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','desc')->get();
        return view('frontend.order.order_details',compact('order','orderItem'));   
    }

    // Invoice Download
    public function userOrderinvoice($order_id)
    {
        $order = Order::with('division','district','state','user')->where((['id'=> $order_id, 'user_id'=> Auth::id()]))->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','desc')->get();
        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
            'tempDir'=> public_path(),
            'chroot'=> public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }


    // Return Order
    public function returnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d M Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1
        ]);

        toastr()->success('Return Request Send Successfully');
        return redirect()->route('user.order');
    }
    

    // Return Order Page
    public function getReturnOrder()
    {
        $return_orders = Order::where('user_id', Auth::id())->where('return_reason','!=',null)->orderBy('id','desc')->get();
        return view('frontend.order.return_orders',compact('return_orders'));
    }

    // User Track Order
    public function userTrackOrder()
    {
        return view('frontend.userdashboard.user_track_order');
    }

    // User Order Tracking
    public function orderTracking(Request $request)
    {
        $invoice = $request->code;
        $track = Order::where('invoice_no',$invoice)->first();
        if($track)
        {
            return view('frontend.tracking.track_order',compact('track'));
        }else{
            toastr()->error('Invoice No is invalid! Please check your invoice and try again.');
            return redirect()->back();
        }
    }
}
