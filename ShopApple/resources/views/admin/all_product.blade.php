@extends('admin_layout')
@section('admin_content')


<hr>
<h6 class="font-weight-bolder mb-0">Product</h6>
<table class="table align-middle mb-0 bg-white" >
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>Product Name</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Price</th>
      <th>Storage</th>
      <th>Color</th>
      <th>Product Image</th>
      <th>Content</th>
      <th>Description</th>
      <th>Status</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody >

  	@foreach($all_product as $key => $pro)
    <tr >
      <td>
        <div class="d-flex align-items-center">
         {{--  <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              /> --}}
          <div class="ms-3">
            <div style="max-width: 180px; overflow: hidden; text-overflow: ellipsis;">
              <p class="fw-bold mb-1">{{ $pro->product_name }}</p>
            </div>
          </div>
        </div>
      </td>
      <td style="text-align: center;">
        {{ $pro->category_name }}
      </td>
      <td style="text-align: center;">
        {{ $pro->brand_name }}
      </td>
      <td style="text-align: center;">
        {{number_format($pro->product_price).' VNĐ'}}
      </td >
      <td style="text-align: center;">
        {{ $pro->product_storage }}
      </td >
      <td style="text-align: center;">
        {{ $pro->product_color }}
      </td >
      <td style="text-align: center;">
        <img src="public/uploads/product/{{ $pro->product_img }}" alt="" height="100px"  width="100px">      
      </td>
      <td>
        <div style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
          {{ $pro->product_content }}
        </div>
      </td>
      <td>
      	<div style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
          {{ $pro->product_desc }}
        </div>
      </td>
      <td style="text-align: center;">
        <?php
      	if($pro-> product_status ==1){
          ?>
        <a href="{{ URL::to('/active-product/'.$pro->product_id) }}"><span class="btn btn-success">Visible</a>
          <?php
        }
        ?>

        <?php
        if($pro-> product_status ==0){
          ?>
        <a href="{{ URL::to('/inactive-product/'.$pro->product_id) }}"><span class="btn btn-secondary">Invisible</a>
          <?php
        }
        ?>

      </td>
      <td style="text-align: center;">
      	<div style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
          {{ $pro->created_at }}
        </div>
      </td>
      <td style="text-align: center;">
      	<a href="{{URL::to('/edit-product/'.$pro->product_id)}}" type="button" class="btn btn-info">Edit</a>
      	<a onclick="return confirm('Are you sure you want delete?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" type="button" class="btn btn-danger">Delete</a>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<nav aria-label="navigation">
      <ul class="pagination mt-50 mb-70">
        {{-- Hiển thị nút Previous --}}
        @if ($all_product->currentPage() > 1)
          <li class="page-item"><a class="page-link" href="{{ $all_product->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Hiển thị các nút số trang --}}
        @for ($i = 1; $i <= $all_product->lastPage(); $i++)
          @if ($i >= $all_product->currentPage() - 2 && $i <= $all_product->currentPage() + 2)
            <li class="page-item {{ ($i == $all_product->currentPage()) ? 'active' : '' }}"><a class="page-link" href="{{ $all_product->url($i) }}">{{ $i }}</a></li>
          @endif
        @endfor

        {{-- Hiển thị nút Next --}}
        @if ($all_product->currentPage() < $all_product->lastPage())
          <li class="page-item"><a class="page-link" href="{{ $all_product->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
        @endif
      </ul>
    </nav>
@endsection