@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Edit Category Product</h6>

<hr>
@foreach($edit_category_product as $key => $edit_value)
<form style="width: 1500px;" action="{{ URL::to('/update-category-product/'.$edit_value->category_id) }}" method="post">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Category Name</label>
    <input type="text" value="{{ $edit_value -> category_name }}" name="category_name" class="form-control" id="category-name" placeholder="Enter category name">
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Category Description</label>
    <textarea  style="resize: none;" rows="5" class="form-control" name="category_desc" id="category-description" rows="3">{{ $edit_value -> category_desc }}</textarea>
  </div>
  <hr>
  <button type="submit" name="update_category_product" class="btn btn-primary">Save</button>
  <hr>
</form>

@endforeach


@endsection