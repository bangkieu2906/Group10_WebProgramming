@extends('welcome_main')
@section('content')
 <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">      
                    <div class="section-heading text-center">
                        @foreach($category_by_name as $key => $name)
                        <h2>Sản phẩm {{ ($name->category_name) }}</h2>    
                        @endforeach        
                    </div>                   
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($category_by_id as $key => $product)
                        
                        <div class="single-product-wrapper">
                           
                            <div class="product-img">
                                <img src="{{ URL::to('/uploads/product/'.$product->product_img) }}" alt="">
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                         
                            <div class="product-description">
                                <span></span>
                                <a href="{{ URL::to('/product-detail/'.$product->product_id) }}">
                                    <h6>{{($product->product_name)}}</h6>
                                </a>
                                <p class="product-price">{{number_format($product->product_price).' VNĐ'}}</p>                         
                                <div class="hover-content">
                                    <div class="add-to-cart-btn">
                                        <button href="{{ URL::to('/product-detail/'.$product->product_id) }}" class="btn essence-btn">Add to Cart</button>
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
 
@endsection

