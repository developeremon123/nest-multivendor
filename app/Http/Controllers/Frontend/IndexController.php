<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class IndexController extends Controller
{
    public function index()
    {
        $skip_category_5 = Category::skip(5)->first();
        $skip_product_5 = Product::where(['status'=>1,'category_id'=>$skip_category_5->id])->orderBy('id','desc')->limit(5)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','desc')->limit(3)->get();
        $special_offers = Product::where('special_offer',1)->orderBy('id','desc')->limit(3)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','desc')->limit(3)->get();
        $recently_added = Product::where('status',1)->orderBy('id','desc')->limit(3)->get();
        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where(['status'=>1,'category_id'=>$skip_category_2->id])->orderBy('id','desc')->limit(5)->get();
        $skip_category_7 = Category::skip(7)->first();
        $skip_product_7 = Product::where(['status'=>1,'category_id'=>$skip_category_7->id])->orderBy('id','desc')->limit(5)->get();
        return view('frontend.index',compact('skip_category_5','skip_product_5','skip_category_2','skip_product_2','skip_category_7','skip_product_7','hot_deals','special_offers','special_deals','recently_added'));
    }
    public function productDetails($id,$slug)
    {
        $product = Product::findOrFail($id);
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','desc')->limit(4)->get();
        return view('frontend.product.product_details',compact('product','product_color','product_size','multi_imgs','relatedProduct'));
    }

    public function vendorDetails($id)
    {
        $vendor = User::find($id);
        $vProduct = Product::where('vendor_id',$id)->get();
        return view('frontend.vendor.vendor_details',compact('vendor','vProduct'));
    }

    public function all_vendor()
    {
        $vendors = User::where(['status' => 1, 'role' => 'vendor'])
        ->orderBy('id', 'desc')
        ->get();
        return view('frontend.vendor.all_vendor',compact('vendors'));
    }

    public function CateWiseProduct($id)
    {
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','desc')->paginate(2)->onEachSide(1);
        $categories = Category::orderBy('category_name','asc');
        $breadCat = Category::where('id',$id)->first();
        $newProduct = Product::orderBy('id','desc')->limit(3)->get();
        return view('frontend.product.view_category',compact('categories','products','breadCat','newProduct'));
    }

    public function SubCateWiseProduct($id,$slug)
    {
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','desc')->paginate(2)->onEachSide(1);
        $categories = Category::orderBy('category_name','asc')->get();
        $breadSubCat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','desc')->limit(3)->get();
        return view('frontend.product.view_subcategory',compact('categories','products','breadSubCat','newProduct'));
    }

    public function viewModal($id)
    {
        $product = Product::with(['category','brand'])->findOrFail($id);
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        return response()->json(
            [
                'product' => $product,
                'color_area' => $product_color,
                'size_area' => $product_size
            ]
        );
    }

    // Search Product 
    public function productSearch(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $item = $request->search;
        $newProduct = Product::orderBy('id','desc')->limit(3)->get();
        $categories = Category::orderBy('category_name','asc')->get();
        $products = Product::where('product_name','LIKE',"%$item%")->get();
        return view('frontend.product.search',compact('products','item','categories','newProduct'));
    }

    public function searchProduct(Request $request)
    {
     
        $request->validate([
            'search' => 'required'
        ]);
        $item = $request->search;
        $products = Product::where('product_name','LIKE',"%$item%")->select('product_name','product_slug','product_thambnail','selling_price','id')->limit(6)->get();
        return view('frontend.product.search_product',compact('products'));
    }
}
