<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\CssSelector\Node\FunctionNode;

class SiteSettingsController extends Controller
{
    public function siteSetting()
    {
        $setting = SiteSetting::find(1);
        return view('backend.setting.site_setting',compact('setting'));
    }

    public function settingStore(Request $request, $id)
    {
        $setting = SiteSetting::find($id);
        if($request->hasFile('logo')){
            if(File::exists(public_path($setting->logo))){
                File::delete(public_path($setting->logo));
            }
            $file = $request->file('logo');
            $manager = new ImageManager(new Driver());
            $extension = $request->file('logo')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = 'upload/logo/'.$imageName;
            $make_img = $manager->read($file);
            $make_img->resize(180,56)->save($imagePath);
            
            $setting->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'copyright' => $request->copyright,
                'logo' => $imagePath
            ]);
        }else{
            $setting->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'copyright' => $request->copyright,
            ]);
        }
        toastr()->success('Site Updated Successfully');
        return redirect()->back();       
    }
}
