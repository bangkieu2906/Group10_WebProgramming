@extends('admin_layout')
@section('admin_content')


<hr>
<h6 class="font-weight-bolder mb-0">All Order</h6>
<table class="table align-middle mb-0 bg-white" >
  <thead class="bg-light">
    <tr style="text-align:  center;">
      <th>ID</th>
      <th>Name</th>
      <th>Total</th>
      <th>Status</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody >
  	@foreach($all_order as $key => $value)
    <tr>
      <td style="text-align: center;">
        {{ $value-> order_id }}
      </td>
      <td>
        <div class="d-flex align-items-center">
         {{--  <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              /> --}}
          <div class="ms-3">
            <p class="fw-bold mb-1">{{ $value-> name }}</p>
          </div>
        </div>
      </td>
      <td style="text-align: center;">
      	{{ $value-> order_total }} VNĐ
      </td>
      <td style="text-align: center;">
        @if($value-> order_status == 1)
       	Pending
        @elseif($value-> order_status == 2)
        Confirm
        @elseif($value-> order_status == 3)
        Done
        @else
        Cancelled
        @endif
      </td>
      <td style="text-align: center;">
      	{{ $value-> created_at }}
      </td>
      <td style="text-align: center;">
      	<a href="{{URL::to('/view-order/'.$value->order_id)}}" type="button" class="btn btn-info">View</a>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<br>
<nav aria-label="navigation">
      <ul class="pagination mt-50 mb-70">
        {{-- Hiển thị nút Previous --}}
        @if ($all_order->currentPage() > 1)
          <li class="page-item"><a class="page-link" href="{{ $all_order->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Hiển thị các nút số trang --}}
        @for ($i = 1; $i <= $all_order->lastPage(); $i++)
          @if ($i >= $all_order->currentPage() - 2 && $i <= $all_order->currentPage() + 2)
            <li class="page-item {{ ($i == $all_order->currentPage()) ? 'active' : '' }}"><a class="page-link" href="{{ $all_order->url($i) }}">{{ $i }}</a></li>
          @endif
        @endfor

        {{-- Hiển thị nút Next --}}
        @if ($all_order->currentPage() < $all_order->lastPage())
          <li class="page-item"><a class="page-link" href="{{ $all_order->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
        @endif
      </ul>
    </nav>
@endsection