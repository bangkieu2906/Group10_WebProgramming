<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Mail;
session_start();

class HomeController extends Controller
{
    public function index()
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $iphone = DB::table('tbl_product')->where('category_id',1)->orderby('product_id', 'asc')->get();
        $ipad = DB::table('tbl_product')->where('category_id',6)->orderby('product_id','asc')->get();
        $mac = DB::table('tbl_product')->where('category_id',2)->orderby('product_id','asc')->get();
        $watch = DB::table('tbl_product')->where('category_id',5)->orderby('product_id','asc')->get();
        return view('pages.home')->with('category',$category)->with('brand',$brand)->with('iphone',$iphone)->with('ipad',$ipad)->with('mac',$mac)->with('watch',$watch);
    }

    public function information(){
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        $user = DB::table('users')->where('id', Session::get('id'))->get();
        return view('pages.user_info')->with('category',$category)->with('brand',$brand)->with('user',$user);
    }

    public function update_user(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required|unique:users,name,'.$id,
        'email' => 'email|unique:users,email,'.$id,
        'phone' => 'required|numeric',
        'address' => 'required'
        ]);
        
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();
        
        return redirect()->back();
    }

    // public function search(Request $request)
    // {
    //     $key = $request->keyword;
    //     $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
    //     $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();


    //     $search_product = DB::table('tbl_product')->where('product_name','like','%'.$key.'%')->get();

    //     return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('search_product',$search_product);
    // }

    public function search(Request $request)
    {
        $key = $request->keyword;


        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_name','like','%'.$key.'%')
        ->paginate(9);

        $categoryIds = $show->pluck('category_id')->toArray();
        $brandIds = $show->pluck('brand_id')->toArray();

        $category = DB::table('tbl_category_product')
        ->whereIn('category_id', $categoryIds)
        ->get();

        $brand = DB::table('tbl_brand')
        ->whereIn('brand_id', $brandIds)
        ->get();

        return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',null)->with('keyw',$key);
    }

    public function sort_asc($key)
    {

        
        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_name','like','%'. $key .'%')
        ->orderby('tbl_product.product_price','asc')
        ->paginate(9);

        $categoryIds = $show->pluck('category_id')->toArray();
        $brandIds = $show->pluck('brand_id')->toArray();

        $category = DB::table('tbl_category_product')
        ->whereIn('category_id', $categoryIds)
        ->get();

        $brand = DB::table('tbl_brand')
        ->whereIn('brand_id', $brandIds)
        ->get();

        return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',2)->with('keyw',$key);
    }

    public function sort_desc($key)
    {

        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_name','like','%'. $key .'%')
        ->orderby('tbl_product.product_price','desc')
        ->paginate(9);

        $categoryIds = $show->pluck('category_id')->toArray();
        $brandIds = $show->pluck('brand_id')->toArray();

        $category = DB::table('tbl_category_product')
        ->whereIn('category_id', $categoryIds)
        ->get();

        $brand = DB::table('tbl_brand')
        ->whereIn('brand_id', $brandIds)
        ->get();

        return view('pages.product.search')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',1)->with('keyw',$key);
    }



    public function searchSuggestion(Request $request)
    {
        $keyword = $request->input('keyword');

        $suggestions = DB::table('tbl_product')
            ->select('product_id', 'product_name')
            ->where('product_name', 'like', '%' . $keyword . '%')
            ->limit(5)
            ->get();

        return response()->json(['suggestions' => $suggestions]);
    }

    

}
