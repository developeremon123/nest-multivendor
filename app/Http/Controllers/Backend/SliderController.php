<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\SliderStoreRequest;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function allSlider()
    {
        $sliders = Slider::select('id','slider_title','short_title','slider_image')->latest()->get();
        return view('backend.slider.all_sliders',compact('sliders'));
    }

    public function addSlider()
    {
        return view('backend.slider.add_slider');
    }

    public function sliderStore(SliderStoreRequest $request)
    {
        if($request->hasFile('slider_image')){
            $manager = new ImageManager(new Driver());
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/slider_images').'/'.$imageName;
            $make_img = $manager->read($request->file('slider_image'));
            $make_img->resize(2376,807)->save($imagePath);
            
            Slider::insert([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $imageName
            ]);
        }
        toastr()->success('New Slider Inserted Successfully');
        return redirect()->route('admin.all.slider');
    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.edit_slider',compact('slider'));
    }

    public function updateSlider(SliderStoreRequest $request, $id)
    {
        $slider = Slider::find($id);
        if($request->hasFile('slider_image')){
            if(File::exists(public_path('upload/slider_images/'.$slider->slider_image))){
                File::delete(public_path('upload/slider_images/'.$slider->slider_image));
            }
            $manager = new ImageManager(new Driver());
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $imagePath = public_path('upload/slider_images').'/'.$imageName;
            $make_img = $manager->read($request->file('slider_image'));
            $make_img->resize(2376,807)->save($imagePath);
            
            $slider->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $imageName
            ]);
        }
        toastr()->success('Slider Updated Successfully');
        return redirect()->route('admin.all.slider');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        if(File::exists(public_path('upload/slider_images/'.$slider->slider_image))){
            File::delete(public_path('upload/slider_images/'.$slider->slider_image));
        }
        $slider->delete();
        toastr()->success('Slider Deleted Successfully');
        return redirect()->route('admin.all.slider');
    }
}
