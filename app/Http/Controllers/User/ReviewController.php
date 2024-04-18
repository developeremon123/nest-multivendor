<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Store Review
    public function storeReview(Request $request)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Review::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $request->vendor_id,
            'created_at' => Carbon::now()
        ]);

        toastr()->success('Review will approve by Admin');
        return redirect()->back();
    }

    /*
        Admin Manage Review Methods
    */

    public function pendingReview()
    {
        $penReviews = Review::with('user','product')->where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.pending_reviews',compact('penReviews'));
    }
}
