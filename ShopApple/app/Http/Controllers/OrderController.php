<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Coupon;
use DB;
use Session;
use Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use PDF;
session_start();

class OrderController extends Controller
{
    public function CheckAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }

    // public function print_order($order_id){
    //      $order = DB::table('tbl_order')
    //     ->join('users','tbl_order.customer_id','=','users.id')
    //     ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
    //     ->select('tbl_order.*','users.name','tbl_shipping.shipping_address')
    //     ->where('tbl_order.order_id','=',$order_id)
    //     ->first();

    //     $orderDetails = DB::table('tbl_order_details')
    //         ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
    //         ->select('tbl_order_details.*','tbl_product.product_name','tbl_product.product_price')
    //         ->where('tbl_order_details.order_id','=',$order_id)
    //         ->get();

    //     $invoice = [
    //         'invoice_no' => $order->order_id,
    //         'date' => $order->created_at,
    //         'customer_name' => $order->name,
    //         'customer_address' => $order->shipping_address,
    //         'items' => $orderDetails
    //     ];

    //     $pdf = PDF::loadView('pages.invoice', compact('invoice'));
    //     return $pdf->stream();
    // }

    // public function print_order_convert($order_id)
    // {
    //     return $order_id;
    // }

     public function manage_order(){
        $this->CheckAuth();
        $all_order = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->select('tbl_order.*','users.name')
        ->orderby('tbl_order.order_id','desc')->paginate(10);
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manager_order',$manager_order);
     }

     public function view_order($orderId){
        $this->CheckAuth();
        $all_order = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->select('tbl_order.*','users.name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);

        $order_by_id = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_payment','tbl_order.payment_id','=','tbl_payment.payment_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
        ->select('tbl_order.*','users.*','tbl_shipping.*','tbl_order_details.*','tbl_product.*','tbl_payment.*')
        ->where('tbl_order.order_id','=',$orderId)
        ->first();

        $order_by_id_product = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
        ->select('tbl_order.*','users.*','tbl_shipping.*','tbl_order_details.*','tbl_product.*')
        ->where('tbl_order.order_id','=',$orderId)
        ->get();


        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id)->with('all_order',$all_order)->with('order_by_id_product',$order_by_id_product);

        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
     }

     public function updateStatus(Request $request, $id)
    {
        $this->CheckAuth();
        $status = $request->input('status');
        DB::table('tbl_order')->where('order_id',$id)->update(['order_status'=>$status]);

        // Redirect back to order view page
        return redirect()->back();
    }

    public function order_history()
    { 
        $user = DB::table('users')->where('id', Session::get('id'))->get();
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

        $all_order = DB::table('tbl_order')
        ->where('customer_id',Session::get('id'))
        ->orderby('order_id','desc')->paginate(10);
        return view('pages.order.order_history', compact('category', 'brand', 'iphone', 'ipad', 'mac', 'watch', 'user', 'all_order'));
    }

    public function view_my_order($orderId){
        $user = DB::table('users')->where('id', Session::get('id'))->get();
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

        $all_order = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->select('tbl_order.*','users.name')
        ->orderby('tbl_order.order_id','desc')->get();

        $order_by_id = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_payment','tbl_order.payment_id','=','tbl_payment.payment_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
        ->select('tbl_order.*','users.*','tbl_shipping.*','tbl_order_details.*','tbl_product.*','tbl_payment.*')
        ->where('tbl_order.order_id','=',$orderId)
        ->first();

        $order_by_id_product = DB::table('tbl_order')
        ->join('users','tbl_order.customer_id','=','users.id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
        ->select('tbl_order.*','users.*','tbl_shipping.*','tbl_order_details.*','tbl_product.*')
        ->where('tbl_order.order_id','=',$orderId)
        ->get();

        return view('pages.order.view_my_order', compact('category', 'brand', 'iphone', 'ipad', 'mac', 'watch', 'user', 'all_order', 'order_by_id', 'order_by_id_product'));
     }

     public function cancel_order($order_id)
    {
        DB::table('tbl_order')->where('order_id',$order_id)-> update(['order_status'=>4]);
        return redirect()->back();
    }

}
