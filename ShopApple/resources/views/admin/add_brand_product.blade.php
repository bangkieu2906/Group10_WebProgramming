@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Add Brand Product</h6>
<hr>

<form style="width: 1500px;" action="{{ URL::to('/save-brand-product') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Brand Name</label>
    <input type="text" name="brand_name" class="form-control" id="brand-name" placeholder="Enter brand name">
  </div>
  <label style="font-size:16px" for="product-parent">Category Product</label>
  <select name="cate" class="form-control" id="product-parent">
    @foreach($category as $key => $cate)
    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
    @endforeach
  </select>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Brand Description</label>
    <textarea style="resize: none;" rows="5" class="form-control" name="brand_desc" id="brand-description" rows="3"></textarea>
  </div>
  <label style="font-size:16px" for="brand-parent">Status</label>
  <select name="brand_status" class="form-control" id="brand-parent">
    <option value="">None</option>
    <option value="1">Visible</option>
    <option value="0">Invisible</option>
  </select>
  
  <hr>
  <button type="submit" name="add_brand_product" class="btn btn-primary">Add</button>
  <hr>
  <?php 
        $message = Session::get('message');
        if($message){
        echo '<span class="--bs-danger">',$message.'</span>';
        Session::put('message',null);
    }
    ?>
</form>


  @endsection