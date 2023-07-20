<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class ProductController extends Controller
{
    public function CheckAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    
     public function add_product()
    {
        $this->CheckAuth();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view ('admin.add_product')->with('category',$category)->with('brand',$brand);
    }

    public function all_product()
    {
        $this->CheckAuth();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->orderBy('tbl_product.product_id', 'desc')
        ->paginate(6);
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->CheckAuth();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->cate;
        $data['brand_id'] = $request->br;
        $data['product_price'] = $request->product_price;
         $data['product_storage'] = $request->product_storage;
          $data['product_color'] = $request->product_color;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;

        $get_img = $request-> file('product_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img-> move('public/uploads/product',$new_img);
            $data['product_img'] = $new_img;
            DB::table('tbl_product')-> insert($data);
            return Redirect::to('/add-product');
        }
        $data['product_img'] = '';
        DB::table('tbl_product')-> insert($data);
        return Redirect::to('/add-product');
    }

    public function active_product($product_id)
    {
        $this->CheckAuth();
        DB::table('tbl_product')->where('product_id',$product_id)-> update(['product_status'=>0]);

        return Redirect::to('/all-product');
    }

    public function inactive_product($product_id)
    {
        $this->CheckAuth();
        DB::table('tbl_product')->where('product_id',$product_id)-> update(['product_status'=>1]);

        return Redirect::to('/all-product');
    }

    public function edit_product($product_id)
    {
        $this->CheckAuth();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')-> where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('category',$category)->with('brand',$brand);
        return view ('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->CheckAuth();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->cate;
        $data['brand_id'] = $request->br;
        $data['product_price'] = $request->product_price;
        $data['product_storage'] = $request->product_storage;
        $data['product_color'] = $request->product_color;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $get_img = $request->file('product_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img-> move('public/uploads/product',$new_img);
            $data['product_img'] = $new_img;
            DB::table('tbl_product')->where('product_id',$product_id)-> update($data);
            Session::put('message','Success');
            return Redirect::to('/all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)-> update($data);
        Session::put('message','Success');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id)
    {
        $this->CheckAuth();
        DB::table('tbl_product')->where('product_id',$product_id)-> delete();
        return Redirect::to('/all-product');
    }


    //FE

    public function product_detail($product_id){
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        $product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();

        foreach($product as $key => $value){
            $category_id = $value -> category_id;
        }

        $realated_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.product.show_detail')->with('category',$category)->with('brand',$brand)->with('product',$product)->with('realated_product',$realated_product);
    }

    //all home
    public function product_home()
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        
        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_status',1)
        ->orderby('tbl_product.product_id','desc')
        ->paginate(9);

        return view('pages.product.product_home')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',null);
    }
    
    public function sort_asc()
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        
        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_status',1)
        ->orderby('tbl_product.product_price','asc')
        ->paginate(9);
        return view('pages.product.product_home')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',2);
    }

    public function sort_desc()
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        
        $show = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_status',1)
        ->orderby('tbl_product.product_price','desc')
        ->paginate(9);
        return view('pages.product.product_home')->with('category',$category)->with('brand',$brand)->with('show',$show)->with('checked',1);
    }
}