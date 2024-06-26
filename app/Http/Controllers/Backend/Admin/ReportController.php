<?php

namespace App\Http\Controllers\Backend\Admin;

use DateTime;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ReportController extends Controller
{
    // View Report
    public function reportView()
    {
        return view('backend.report.view_report');
    }

    // Order By User Report
    public function orderByUser()
    {
        $users = User::where('role','user')->latest()->get();
        return view('backend.report.report_by_user',compact('users'));
    }

    // search by date
    public function searchByDate(Request $request)
    {
        $date = New DateTime($request->date);
        $formatDate = $date->format('d M Y');
        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_by_date',compact('orders','formatDate'));
    }

    // search by date
    public function searchByMonth(Request $request)
    {
        $month = $request->month;
        $year_name = $request->year_name;
        $orders = Order::where(['order_month'=>$month,'order_year'=>$year_name])->latest()->get();
        return view('backend.report.report_by_month',compact('orders','month','year_name'));
    }

    // search by date
    public function searchByYear(Request $request)
    {
        $year = $request->year;
        $orders = Order::where('order_year',$year)->latest()->get();
        return view('backend.report.report_by_year',compact('orders','year'));
    }

    // search by user
    public function searchByUser(Request $request)
    {
        $user = $request->user;
        $orders = Order::where('user_id',$user)->latest()->get();
        return view('backend.report.report_by_user_data',compact('orders','user'));
    }
}
