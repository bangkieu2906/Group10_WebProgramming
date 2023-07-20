@extends('welcome')
@section('content')

<section>
	<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Your order information</h3>
          <p class="card-text">Name: {{ Session::get('order_info.shipping_name') }}</p>
          <p class="card-text">Phone: {{ Session::get('order_info.shipping_phone') }}</p>
          <p class="card-text">Address: {{ Session::get('order_info.shipping_address') }}</p>
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Storage</th>
                <th>Color</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
        	@php
        	$content = session('content');
        	@endphp
            @foreach($content as $v_content)
              <tr>
                <td>{{ $v_content -> name }}</td>
                <td>{{ $v_content -> options->storage }}</td>
                <td>{{$v_content -> options->color }}</td>
                <td>{{ number_format($v_content -> price, 0, '.', ',') }}</td>
              </tr>
            </tbody>
            @endforeach
      </table>
      <h4 class="card-title">Order Total: {{ Session::get('order_info.order_total') }} VNĐ</h4>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Order Success!</h2>
          <p class="card-text">Thank you for ordering from us.</p>
          <a href="{{ URL::to('/trangchu')}}" class="btn btn-primary">Continue Shopping</a>
          <!-- Nút xem lịch sử đơn hàng -->
          <a href="{{ URL::to('/order-history')}}" class="btn btn-secondary">Order History</a>
        </div>
      </div>
    </div>
  </div>
</section>
<br>
<hr>
</div>

@endsection