<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    //
     public function insert_coupon()
    {
        return view('admin.insert_coupon');
    }

    public function list_coupon()
    {
        $coupon = Coupon::orderby('coupon_id','DESC')->get();
        return view('admin.list_coupon')->with(compact('coupon'));
    }

    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon -> coupon_name = $data['coupon_name'];
        $coupon -> coupon_code = $data['coupon_code'];
        $coupon -> coupon_type = $data['coupon_type'];
        $coupon -> coupon_value = $data['coupon_value'];
        $coupon -> coupon_quantity = $data['coupon_quantity'];

        $coupon -> save();
        Session::put('message','Success');
        return Redirect::to('laravel/php/list-coupon');
    }

    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return redirect()->back();
    }
}
