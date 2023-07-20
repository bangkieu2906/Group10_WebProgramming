@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Edit Brand Product</h6>

<hr>
@foreach($edit_brand_product as $key => $edit_value)
<form style="width: 1500px;" action="{{ URL::to('/update-brand-product/'.$edit_value->brand_id) }}" method="post">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Brand Name</label>
    <input type="text" value="{{ $edit_value -> brand_name }}" name="brand_name" class="form-control" id="brand-name" placeholder="Enter brand name">
  </div>
  <label style="font-size:16px" for="product-parent">Category Product</label>
  <select name="cate" class="form-control" id="product-parent">
    @foreach($category as $key => $cate)
      @if($cate->category_id == $edit_value->category_id )
      <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
      @else
      <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
      @endif
    @endforeach
  </select>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Brand Description</label>
    <textarea  style="resize: none;" rows="5" class="form-control" name="brand_desc" id="brand-description" rows="3">{{ $edit_value -> brand_desc }}</textarea>
  </div>
  <hr>
  <button type="submit" name="update_brand_product" class="btn btn-primary">Save</button>
  <hr>
</form>

@endforeach


@endsection