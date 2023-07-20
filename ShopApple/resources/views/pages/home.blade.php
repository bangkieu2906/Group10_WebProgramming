@extends('welcome_main')
@section('content')
{{--  <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(/FE/img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="#">Clothing</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(/FE/img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="#">Clothing</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(/FE/img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="#">Clothing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Top Category Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(/FE/img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### --> --}}

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Iphone Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($iphone as $key => $value)
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_img) }}" alt="">

                                <!-- Hover Thumb -->
                                {{-- <img class="hover-img" src="public/FE/img/product-img/product-2.jpg" alt=""> --}}

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$value->product_id) }}">
                                    <h6>{{($value->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($value->product_price).' VNĐ'}}</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
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
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Ipad Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($ipad as $key => $value)
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_img) }}" alt="">

                                <!-- Hover Thumb -->
                                {{-- <img class="hover-img" src="public/FE/img/product-img/product-2.jpg" alt=""> --}}

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$value->product_id) }}">
                                    <h6>{{($value->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($value->product_price).' VNĐ'}}</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
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
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Macbook Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($mac as $key => $value)
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_img) }}" alt="">

                                <!-- Hover Thumb -->
                                {{-- <img class="hover-img" src="public/FE/img/product-img/product-2.jpg" alt=""> --}}

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$value->product_id) }}">
                                    <h6>{{($value->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($value->product_price).' VNĐ'}}</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
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
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Apple Watch Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($watch as $key => $value)
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$value->product_img) }}" alt="">

                                <!-- Hover Thumb -->
                                {{-- <img class="hover-img" src="public/FE/img/product-img/product-2.jpg" alt=""> --}}

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$value->product_id) }}">
                                    <h6>{{($value->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($value->product_price).' VNĐ'}}</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
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
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <!-- ##### Brands Area End ##### -->

@endsection