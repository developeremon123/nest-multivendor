<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Admin Dashboard Method
    public function AdminDashboard(): View
    {
        return view('backend.admin.index');
    }

    //Admin Login Page
    public function adminLogin(): View
    {
        return view('backend.admin.login');
    }

    // Admin Logout Method
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }

    // Admin Profile Method
    public function adminProfile(): view
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('backend.admin.profile',compact('adminData'));
    }

    // Admin Profile Update Method
    public function adminProfileStore(AdminProfileRequest $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        if($request->hasFile('image')){
            if(File::exists(public_path('upload/admin_images/'.Auth::user()->image))){
                File::delete(public_path('upload/admin_images/'.Auth::user()->image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = strtolower(str_replace(' ','_',Auth::user()->name)).'.'.$extension;
            $imagePath = public_path('upload/admin_images').'/'.$imageName;
            $make_img = $manager->read($request->file('image'));
            $make_img->save($imagePath);
    
            $adminData->image = $imageName;
        }
        $adminData->name    = $request->name;
        $adminData->email   = $request->email;
        $adminData->phone   = $request->phone;
        $adminData->address = $request->address;
        $adminData->save();
        toastr()->success('You data has been save successfully');
        return redirect()->back();
    }

    // Admin Password Change Method
    public function adminChangePassword(): View
    {
        return view('backend.admin.password_change');
    }

    // Admin Password Update Method
    public function adminPasswordUpdate(AdminUpdatePasswordRequest $request): RedirectResponse
    {
        //match current password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return redirect()->back()->with('error', 'Current password does not match');
        }

        //update password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    // Vendor Inactive Method
    public function inactiveVendor(): View
    {
        $inactive_vendors = User::where(['status' => 'inactive','role'=> 'vendor'])->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inactive_vendors'));
    }

    // Vendor Active Method
    public function activeVendor(): View
    {
        $active_vendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        return view('backend.vendor.active_vendor',compact('active_vendors'));
    }

    // Inactive Vendor Details Method
    public function inactiveVendorDetails($id): View
    {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));
    }

    // Inactive Vendor Active Method
    public function activeVendorApprove(Request $request,$id): RedirectResponse
    {
        $active_vendor_id = User::findOrFail($id);
        User::findOrFail($id)->update([
            'status' => 'active'
        ]);

        toastr()->success('Vendor Active');
        return redirect()->route('admin.vendor.active');


    }
}
