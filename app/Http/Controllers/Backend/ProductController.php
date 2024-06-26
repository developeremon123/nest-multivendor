<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\View\View;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    // Product List Method
    public function allProducts(): View
    {
        $products = Product::latest()->get();
        return view('backend.product.all-products', compact('products'));
    }

    // Add Product Method
    public function addProduct(): View
    {
        $activeVendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        $brands = Brand::select('id','brand_name')->get();
        $categories = Category::select('id','category_name')->get();
        return view('backend.product.add-product', compact('brands','categories','activeVendors'));
    }

    // Product Store Method
    public function storeProduct(ProductRequest $request): RedirectResponse 
    {
        $manager   = new ImageManager(new Driver());
        $extension = $request->file('product_thambnail')->getClientOriginalExtension();
        $imageName = hexdec(uniqid()).'.'.$extension;
        $imagePath = public_path('upload/product_images/thambnail').'/'.$imageName;
        $make_img  = $manager->read($request->file('product_thambnail'));
        $make_img->resize(800,800)->save($imagePath);

        $product = Product::insertGetId([
            'brand_id'          => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'      => $request->product_name,
            'product_slug'      => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tags'      => $request->product_tags,
            'product_size'      => $request->product_size,
            'product_color'     => $request->product_color,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_desc'        => $request->short_desc,
            'long_desc'         => $request->long_desc,
            'product_thambnail' => $imageName,
            'vendor_id'         => $request->vendor_id,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            'status'            => 1,
            'created_at'        => Carbon::now(),
        ]);
        $multi_imgs = $request->file('multi_img');
        foreach($multi_imgs as $img){
            $manager   = new ImageManager(new Driver());
            $extension = $img->getClientOriginalExtension();
            $imageName = hexdec(uniqid()).'.'.$extension;
            $imagePath = public_path('upload/product_images/multi_imgs').'/'.$imageName;
            $make_img  = $manager->read($img);
            $make_img->resize(800,800)->save($imagePath);

            MultiImg::insert([
                'product_id' => $product,
                'image_name' => $imageName,
                'created_at' => Carbon::now(),
            ]);
        }   

        toastr()->success('Product added successfully');
        return redirect()->route('admin.all.products');
    }

    // Edit Product Method
    public function editProduct($id): View
    {
        $activeVendors = User::where(['status' => 'active','role'=> 'vendor'])->latest()->get();
        $product = Product::findOrFail($id);
        $brands = Brand::select('id','brand_name')->get();
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        // dd($multi_imgs);
        $categories = Category::select('id','category_name')->get();
        $subcategories = SubCategory::select('id','sub_category_name')->get();
        return view('backend.product.edit-product', compact('brands','categories','product','activeVendors','subcategories','multi_imgs'));
    }

    // Update Product Method
    public function updateProduct(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id)->update([
            'brand_id'          => $request->brand_id,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'product_name'      => $request->product_name,
            'product_slug'      => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tags'      => $request->product_tags,
            'product_size'      => $request->product_size,
            'product_color'     => $request->product_color,
            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_desc'        => $request->short_desc,
            'long_desc'         => $request->long_desc,
            'vendor_id'         => $request->vendor_id,
            'hot_deals'         => $request->hot_deals,
            'featured'          => $request->featured,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals,
            'status'            => 1,
            'updated_at'        => Carbon::now(),
        ]);
        toastr()->success('Product updated successfully');
        return redirect()->route('admin.all.products');
    }

    // update product thambnail
    public function updateThambnail(ProductRequest $request, $id): RedirectResponse
    {
        $product_thambnail = Product::find($id);
        if(File::exists(public_path('upload/product_images/thambnail/'.$product_thambnail->product_thambnail))){
            File::delete(public_path('upload/product_images/thambnail/'.$product_thambnail->product_thambnail));
        }
        $manager   = new ImageManager(new Driver());
        $extension = $request->file('product_thambnail')->getClientOriginalExtension();
        $imageName = hexdec(uniqid()).'.'.$extension;
        $imagePath = public_path('upload/product_images/thambnail').'/'.$imageName;
        $make_img  = $manager->read($request->file('product_thambnail'));
        $make_img->resize(800,800)->save($imagePath);

        Product::findOrFail($id)->update([
            'product_thambnail' => $imageName,
            'updated_at'        => Carbon::now(),
        ]);
        toastr()->success('Product image thambnail updated successfully');
        return redirect()->route('admin.all.products');
    }
    
    // update product multi images
    public function updateMultiImg(Request $request): RedirectResponse
    {
        $request->validate([ 
            'multi_img'=> ['required','max:2048']
        ]);
        foreach($request->multi_img as $id => $img){
            $delImg = MultiImg::find($id);
            File::delete(public_path('upload/product_images/multi_imgs/'.$delImg->image_name));

            $manager   = new ImageManager(new Driver());
            $extension = $img->getClientOriginalExtension();
            $imageName = hexdec(uniqid()).'.'.$extension;
            $imagePath = public_path('upload/product_images/multi_imgs').'/'.$imageName;
            $make_img  = $manager->read($img);
            $make_img->resize(800,800)->save($imagePath);

            MultiImg::where('id',$id)->update([
                'image_name'        => $imageName,
                'updated_at'        => Carbon::now(),
            ]);
        }
        
        toastr()->success('Product multi-image updated successfully');
        return redirect()->back();
    }

    // Delete Product multi-image
    public function deleteMultiImg($id): RedirectResponse
    {
        $delImg = MultiImg::find($id);
        File::delete(public_path('upload/product_images/multi_imgs/'.$delImg->image_name));

        $delImg->delete();
        toastr()->success('Product multi-image deleted successfully');
        return redirect()->back();
    }

    // Product inactive
    public function inactive($id): RedirectResponse
    {
        Product::find($id)->update(['status' => 0]);
        toastr()->success('Product Inactive');
        return redirect()->back();
    }

    // Product active
    public function active($id): RedirectResponse
    {
        Product::find($id)->update(['status' => 1]);
        toastr()->success('Product Active');
        return redirect()->back();
    }

    // Product active
    public function productDelete($id): RedirectResponse
    {
        $product = Product::find($id);
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        
        File::delete(public_path('upload/product_images/thambnail/'.$product->product_thambnail));

        foreach ($multi_imgs as $multi_img) {
            File::delete(public_path('upload/product_images/multi_imgs/'.$multi_img->image_name));
            MultiImg::where('product_id',$id)->delete();
        }
        $product->delete();
        toastr()->success('Product deleted successfully');
        return redirect()->back();
    }

    // Product Stock
    public function productStock()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_stock',compact('products'));
    }
}
