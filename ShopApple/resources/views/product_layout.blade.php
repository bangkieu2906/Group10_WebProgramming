@extends('welcome')
@section('content')

 <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(public/FE/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>@yield('title')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget category mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Categories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    <li>
                                        @foreach($category as $key => $cate)
                                        <li>
                                            <a href="{{ URL::to('/show-category',$cate->category_id) }}" style="color: black; text-decoration: none">{{ $cate->category_name }}</a>
                                        </li>
                                        @endforeach
                                    </li>
                                </ul>
                            </div> 
                            <!-- ##### Single Widget ##### -->
                        </div>
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <h6 class="widget-title2 mb-30">Brands</h6>
                            <div class="widget-desc">
                                <ul>
                                    @foreach($brand as $key => $br)
                                        <li><a href="{{ URL::to('/show-brand',$br->brand_id) }}">{{ $br -> brand_name }}</a></li> 
                                    @endforeach   
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <!-- <div class="widget price mb-50">
                    
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div> -->

                        <!-- ##### Single Widget ##### -->
                        <!-- <div class="widget color mb-50">
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div>
                        </div> -->

                        
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>All</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                        <select onchange="window.location.href=this.value;" id="mySelect">
                                            @yield('sort')
                                        </select>

    
                                        <input type="submit" class="d-none" value="">
                                        </form>     
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                             @foreach($show as $key => $product)
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="{{ URL::to('/uploads/product/'.$product->product_img) }}" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="{{ asset('/uploads/product/'.$product->product_img) }}" alt="">
                                        

                                        <!-- Product Badge -->
                                        <div class="product-badge offer-badge">
                                            <span>New</span>
                                        </div>
                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span></span>
                                        <a href="{{ URL::to('/product-detail/'.$product->product_id) }}">
                                            <h6>{{ $product -> product_name }}</h6>
                                        </a>
                                        {{-- <span class="old-price">$75.00</span> --}}
                                        <p class="product-price">{{number_format($product->product_price).' VNĐ'}}</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                        <!-- Add to Cart -->
                                            <form id="add-to-cart-form" action="{{ URL::to('/save-cart') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input name="product_id_hidden" type="hidden" value="{{ $product->product_id }}">
                                                <button type="submit" class="btn essence-btn">Add to Cart</button>
                                            </form>
                                        </div>


 
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <!-- Pagination -->

                    <nav aria-label="navigation">
                      <ul class="pagination mt-50 mb-70">
                        {{-- Hiển thị nút Previous --}}
                        @if ($show->currentPage() > 1)
                          <li class="page-item"><a class="page-link" href="{{ $show->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                        @endif

                        {{-- Hiển thị các nút số trang --}}
                        @for ($i = 1; $i <= $show->lastPage(); $i++)
                          @if ($i >= $show->currentPage() - 2 && $i <= $show->currentPage() + 2)
                            <li class="page-item {{ ($i == $show->currentPage()) ? 'active' : '' }}"><a class="page-link" href="{{ $show->url($i) }}">{{ $i }}</a></li>
                          @endif
                        @endfor

                        {{-- Hiển thị nút Next --}}
                        @if ($show->currentPage() < $show->lastPage())
                          <li class="page-item"><a class="page-link" href="{{ $show->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                        @endif
                      </ul>
                    </nav>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
@endsection