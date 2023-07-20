@extends('welcome')
@section('content')

<section class="single_product_details_area d-flex align-items-center">
        @foreach($product as $key =>$value)
        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div style="text-align:center" class="product_thumbnail_slides owl-carousel">
                <img  src="{{ asset('/uploads/product/'.$value->product_img) }}" alt="">
                <img  src="{{ asset('/uploads/product/'.$value->product_img) }}" alt="">
                <img  src="{{ asset('/uploads/product/'.$value->product_img) }}" alt="">
            </div>
        </div>
        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>new</span>
            <a href="#">
                <h2>{{ $value ->product_name }}</h2>
            </a>
            <p class="product-price">{{number_format($value->product_price).' VNĐ'}} </p>
            <br>
            <strong style="font-size: 20px" class="product-desc">{{ $value ->product_content }}</strong>
            <hr>
            <p class="product-desc">{{ $value ->product_desc }}</p>

            <!-- Form -->
            <form action="{{ URL::to('/save-cart') }}" method="POST">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">128GB</option>
                        <option value="value">256GB</option>
                        <option value="value">512GB</option>
                        <option value="value">1TB</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                        {{ csrf_field() }}
                        <input name="product_id_hidden" type="hidden" value="{{ $value->product_id }}">
                    <button type="submit" name="addtocart" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
</section>
<hr>
<section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">      
                    <div class="section-heading text-center">
                        <h2>Sản phẩm liên quan</h2>    
                    </div>                   
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($realated_product as $key => $value)
                        
                        <div class="single-product-wrapper">
                           
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_img) }}" alt="">
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                         
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$value->product_id) }}">
                                    <h6>{{($value->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($value->product_price).' VNĐ'}}</p>
                                <div class="hover-content">
                                    <form action="{{ URL::to('/save-cart') }}" method="POST">
                                      <div class="add-to-cart-btn">
                                        {{ csrf_field() }}
                                        <input name="product_id_hidden" type="hidden" value="{{ $value->product_id }}">
                                        <button type="submit" class="btn essence-btn">Add to Cart</button>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>  
            </div>
        </div>
</section>


@endsection