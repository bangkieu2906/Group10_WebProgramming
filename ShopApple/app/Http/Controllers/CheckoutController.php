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
session_start();

class CheckoutController extends Controller
{
    public function CheckAuth(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }

    public function check_coupon(Request $request)
        {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon -> coupon_code,
                            'coupon_type' => $coupon -> coupon_type,
                            'coupon_value' => $coupon -> coupon_value,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                    'coupon_code' => $coupon -> coupon_code,
                    'coupon_type' => $coupon -> coupon_type,
                    'coupon_value' => $coupon -> coupon_value,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message',$coupon -> coupon_code);
            }
        }else{
            Session::put('coupon',null);
            return redirect()->back()->with('message','Apply voucher failed');
        }
    }

    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if($coupon = true){
            Session::forget('coupon');
             return redirect()->back();
        }
    }

    public function checkout(){
        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        return view('pages.checkout.fcheckout')->with('category',$category)->with('brand',$brand);
    }

     public function payment(){

     }

     public function order_place(Request $request){
        // $content = Cart::content();
        // echo $content;

        $category = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','asc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        //insert shipping info
        $ship = array();
        $ship['shipping_name'] = $request->shipping_name;
        $ship['shipping_email'] = $request->shipping_email;
        $ship['shipping_address'] = $request->shipping_address;
        $ship['shipping_phone'] = $request->shipping_phone;
        $ship['shipping_note'] = $request->shipping_note;
        $ship_id = DB::table('tbl_shipping')->insertGetId($ship);
        Session::put('shipping_id',$ship_id);

        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Pending';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = number_format($request->total, 0, '.', ',');
        $order_data['order_status'] = '1';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $value){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $value->id;
            $order_d_data['product_name'] = $value->name;
            $order_d_data['product_price'] = $value->price;
            $order_d_data['order_details_quantity'] = $value->qty;
            $order_d_data['product_color'] = $value->options->color;
            $order_d_data['product_storage'] = $value->options->storage;
            $result = DB::table('tbl_order_details')->insertGetId($order_d_data);
        }

        $order_info = [
        'shipping_name' => $request->shipping_name,
        'shipping_address' => $request->shipping_address,
        'shipping_phone' => $request->shipping_phone,
        'shipping_note' => $request->shipping_note, 
        'payment_method' => $request->payment_option, 
        'order_total' => number_format($request->total, 0, '.', ','),
        // Thêm các thông tin khác tùy ý
        ];
        Session::put('order_info', $order_info);
        $request->session()->put('content', $content);
        $this->sendmail($request->shipping_email);
        $request->session()->flash('content', $content);
        Session::put('coupon', null);
        Session::put('success_paypal', null);
        if($data['payment_method']==1){
            Cart::destroy();
            return view('pages.checkout.cash')->with('order_info',$order_info)->with('category',$category)->with('brand',$brand);
        }elseif($data['payment_method']==2){
            Cart::destroy();
            return view('pages.checkout.cash')->with('order_info',$order_info)->with('category',$category)->with('brand',$brand);
        }

     }

    

     public function sendmail($to_email){
    $to_name = "Apple Store";
    $order_info = Session::get('order_info');
    $data = array(
        "customer_name" => $order_info['shipping_name'],
        "shipping_address" => $order_info['shipping_address'],
        "shipping_phone" => $order_info['shipping_phone'],
        "shipping_note" => $order_info['shipping_note'],
        "payment_method" => $order_info['payment_method'],
        "cart_items" => Session::get('content'),
        "total" => $order_info['order_total']
    );
    
    Mail::send('pages.sendmail',$data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email)->subject('Xác nhận đơn hàng');
        $message->from($to_email,$to_name);//send from this mail
    });
    return redirect('/trangchu')->with('message','');
}
     
}
