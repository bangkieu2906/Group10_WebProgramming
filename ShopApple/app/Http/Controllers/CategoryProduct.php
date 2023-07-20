<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function CheckAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }

    public function add_category_product()
    {
        $this->CheckAuth();
        return view('admin.add_category_product');
        
    }

    public function all_category_product()
    {
        $this->CheckAuth();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_id','asc')->paginate(9);
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view ('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }

    public function save_category_product(Request $request)
    {
        $this->CheckAuth();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;
        DB::table('tbl_category_product')-> insert($data);
        Session::put('message','Success');
        return Redirect::to('/add-category-product');
    }

    public function active_category_product($category_id)
    {
        $this->CheckAuth();
        DB::table('tbl_category_product')->where('category_id',$category_id)-> update(['category_status'=>0]);

        return Redirect::to('/all-category-product');
    }

    public function inactive_category_product($category_id)
    {
        $this->CheckAuth();
        DB::table('tbl_category_product')->where('category_id',$category_id)-> update(['category_status'=>1]);

        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_id)
    {
        $this->CheckAuth();
        $edit_category_product = DB::table('tbl_category_product')-> where('category_id',$category_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view ('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request, $category_id)
    {
        $this->CheckAuth();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)-> update($data);
        return Redirect::to('/all-category-product');
    }

    public function delete_category_product($category_id)
    {
        $this->CheckAuth();
        DB::table('tbl_category_product')->where('category_id',$category_id)-> delete();
        return Redirect::to('/all-category-product');
    }


    //FE
    public function show_category($category_id)
    {
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_id','=',$category_id)->get();

        $category_by_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        
        return view('pages.category.show_category')->with('category',$category)->with('brand',$brand)->with('category_by_id',$category_by_id)->with('category_by_name',$category_by_name);
    }
    
}
