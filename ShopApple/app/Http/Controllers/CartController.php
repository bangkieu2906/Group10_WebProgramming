<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status',1)->orderby('product_id','desc')-> limit(4)->get();

        $productId = $request-> product_id_hidden;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

        $data['id'] = $product_info -> product_id;
        $data['qty'] = '1';
        $data['name'] = $product_info -> product_name;
        $data['price'] = $product_info -> product_price;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info -> product_img;
        $data['options']['storage'] = $product_info-> product_storage;
        $data['options']['color'] = $product_info-> product_color;

        Cart::add($data);
         // Cart::destroy();
        return redirect()->back();
    }

    // public function show_cart(){
    //     $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
    //     $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();
    //     $all_product = DB::table('tbl_product')->where('product_status',1)->orderby('product_id','desc')-> limit(4)->get();

    //     return redirect()->back()->with('category',$category)->with('brand',$brand)->with('all_product',$all_product);
    // }

    public function delete_to_cart($rowId){
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status',1)->orderby('product_id','desc')-> limit(4)->get();

        Cart::update($rowId, 0);

        return redirect()->back()->with('category',$category)->with('brand',$brand)->with('all_product',$all_product);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');
    
        // Update the cart item quantity
        Cart::update($rowId, $qty);
    
        $summary = [
            'subtotal' => Cart::subtotal().' VNĐ',
            'discount' => Cart::discount().' VNĐ',
            'total' => Cart::priceTotal().' VNĐ',
        ];
    
    
        // // Return a JSON response
        return response()->json($summary);
        //return redirect()->back();
    }
    

}
