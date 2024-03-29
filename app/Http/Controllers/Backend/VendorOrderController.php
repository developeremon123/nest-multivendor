<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function vendorOrder()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','desc')->get();
        return view('backend.vendor.order.pending_order',compact('orderItems'));
    }
}
