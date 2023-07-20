@extends('admin_layout')
@section('admin_content')

<h6 class="font-weight-bolder mb-0">Add Product</h6>
<hr>

<form style="width: 1500px;" action="{{ URL::to('/save-product') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Name</label>
    <input type="text" name="product_name" class="form-control" id="product-name" placeholder="Enter product name">
  </div>
  <label style="font-size:16px" for="product-parent">Category Product</label>
  <select name="cate" class="form-control" id="product-parent">
    @foreach($category as $key => $cate)
    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
    @endforeach
  </select>
  <br>
  <label style="font-size:16px" for="product-parent">Brand Product</label>
  <select name="br" class="form-control" id="product-parent">
    @foreach($brand as $key => $br)
    <option value="{{ $br->brand_id }}">{{ $br->brand_name }}</option>
    @endforeach
  </select>
  <br>
   <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Price</label>
    <input type="text" name="product_price" class="form-control" id="product-price" placeholder="Enter price">
  </div>
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Storage</label>
    <input type="text" name="product_storage" class="form-control" id="product-storage" placeholder="Enter storage">
  </div>
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Color</label>
    <input type="text" name="product_color" class="form-control" id="product-color" placeholder="Enter color">
  </div>
  <div class="form-group ">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Image</label>
    <input type="file" name="product_img" class="form-control" id="product-img" >
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Content</label>
    <textarea style="resize: none;" rows="5" class="form-control" name="product_content" id="editor" ></textarea>
  </div>
  <div class="form-group">
    <label style="font-size:16px" class="font-weight-bolder mb-0">Product Description</label>
    <textarea style="resize: none;" rows="5" class="form-control" name="product_desc" id="editor1" ></textarea>
  </div>
  <label style="font-size:16px" for="product-parent">Status</label>
  <select name="product_status" class="form-control" id="product-parent">
    <option value="">None</option>
    <option value="1">Visible</option>
    <option value="0">Invisible</option>
  </select>
  
  <hr>
  <button type="submit" name="add_product" class="btn btn-primary">Add</button>
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