@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Add Coupon</h6>
<hr>

<form style="width: 1500px;" action="{{ URL::to('/insert-coupon-code') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Coupon Name</label>
    <input type="text" name="coupon_name" class="form-control" id="coupon-name" placeholder="">
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Coupon Code</label>
    <input type="text" name="coupon_code" class="form-control" id="coupon-name" placeholder="">
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Coupon Quantity</label>
    <input type="text" name="coupon_quantity" class="form-control" id="coupon-name" placeholder="">
  </div>
  <label style="font-size:16px" for="Coupon-parent">Type</label>
  <select name="coupon_type" class="form-control" id="Coupon-parent">
    <option value="">None</option>
    <option value="1">Discount by %</option>
    <option value="2">Discount by money</option>
  </select>
  <hr>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Discount Value</label>
    <input type="text" name="coupon_value" class="form-control" id="coupon-name" placeholder="">
  </div>
  
  <hr>
  <button type="submit" name="add_coupon" class="btn btn-primary">Add</button>
  <hr>
</form>


  @endsection