@extends('admin_layout')
@section('admin_content')


<hr>
<h6 class="font-weight-bolder mb-0">Coupon</h6>
<table class="table align-middle mb-0 bg-white" >
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>Coupon Name</th>
      <th>Coupon Code</th>
      <th>Coupon Quantity</th>
      <th>Coupon Type</th>
      <th>Coupon Value</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody >

  	@foreach($coupon as $key => $cp)
    <tr>
      <td>
        <div class="d-flex align-items-center">
         {{--  <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              /> --}}
          <div class="ms-3">
            <p class="fw-bold mb-1">{{ $cp->coupon_name }}</p>
          </div>
        </div>
      </td>
      <td>
        {{ $cp->coupon_code }}
      </td>
      <td>
      	{{ $cp->coupon_quantity }}
      </td>
      <td>
        <?php
        if($cp-> coupon_type ==1){
          ?>
          Discount by %
          <?php
        }
        ?>

        <?php
        if($cp-> coupon_type ==2){
          ?>
          Discount by money
          <?php
        }
        ?>
      </td>
      <td>
        {{ $cp->coupon_value }}
      </td>
      <td style="text-align: center;">
      	<a onclick="return confirm('Are you sure you want delete?')" href="{{URL::to('/delete-coupon/'.$cp->coupon_id)}}" type="button" class="btn btn-danger">Delete</a>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>
@endsection