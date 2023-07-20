<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function CheckAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }

    public function add_brand_product()
    {
        $this->CheckAuth();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('admin.add_brand_product')->with('category',$category);
    }

    public function all_brand_product()
    {
        $this->CheckAuth();
        $all_brand_product = DB::table('tbl_brand')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_brand.category_id')->paginate(9);
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view ('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }

    public function save_brand_product(Request $request)
    {
        $this->CheckAuth();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['category_id'] = $request->cate;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;
        DB::table('tbl_brand')-> insert($data);
        Session::put('message','Success');
        return Redirect::to('/add-brand-product');
    }

    public function active_brand_product($brand_id)
    {
        $this->CheckAuth();
        DB::table('tbl_brand')->where('brand_id',$brand_id)-> update(['brand_status'=>0]);

        return Redirect::to('/all-brand-product');
    }

    public function inactive_brand_product($brand_id)
    {
        $this->CheckAuth();
        DB::table('tbl_brand')->where('brand_id',$brand_id)-> update(['brand_status'=>1]);

        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_id)
    {
        $this->CheckAuth();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        
        $edit_brand_product = DB::table('tbl_brand')-> where('brand_id',$brand_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product)->with('category',$category);
        return view ('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_id)
    {
        $this->CheckAuth();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_id)-> update($data);
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_id)
    {
        $this->CheckAuth();
        DB::table('tbl_brand')->where('brand_id',$brand_id)-> delete();
        return Redirect::to('/all-brand-product');
    }

    public function show_brand($brand_id)
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        // $manager_cate = view('pages.category.show_category')->with('category',$category)->with('brand',$brand);
        // return view ('welcome')->with('pages.category.show_category',$manager_cate);
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id','=',$brand_id)->get();

        $brand_by_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$category)->with('brand',$brand)->with('brand_by_id',$brand_by_id)->with('brand_by_name',$brand_by_name);
    }
    
}
