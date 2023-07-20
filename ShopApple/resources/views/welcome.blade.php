<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

   
    <link rel="icon" type="image/x-icon" href="{{ asset('/FE/img/core-img/icons8-apple-30.png') }}" >
     <!-- Title  -->
    <title>Apple Store</title>

    

    <!-- Core Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/FE/css/core-style.css') }}">


    <link rel="stylesheet" href="{{ asset('/FE/css/style.css') }}">
    

    @yield('ajax')
</head>

<body>
    
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                  <a class="nav-brand" href="{{ URL::to('/trangchu') }}"><img style="height: 40x; width: 90px;" src="{{ asset('/FE/img/core-img/logo4.png') }}" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li>
                                    <a href="{{ URL::to('/product-home') }}">Store</a>
                                <div class="megamenu">   
                                    @foreach($category as $key => $cate)
                                    <ul class="single-mega cn-col-4">                                        
                                        <a style="font-size:16px; font-weight:bold" href="{{ URL::to('/show-category',$cate->category_id) }}" class="title">{{ $cate -> category_name }}</a>    
                                        @foreach($brand as $key => $br)
                                            @if($br->category_id == $cate->category_id )
                                                <a style="font-size:13px" href="{{ URL::to('/show-brand',$br->brand_id) }}">{{ $br -> brand_name }}</a>
                                            @endif
                                        @endforeach                  
                                    </ul> 
                                     @endforeach                                                                      
                                </div>
                                
                            </li>
                            
                        </ul>
                    </div>
                    
                </div>
                    <!-- Nav End -->
            </nav>
            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->

                <div class="search-area">
                    <form action="{{ URL::to('/search') }}" method="get">
                        {{ csrf_field() }}
                        <input type="search" name="keyword" id="headerSearch" placeholder="Type for search" autocomplete="off">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                    <div id="search-suggestions"></div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function() {
                var $searchSuggestions = $('#search-suggestions');
                var $headerSearch = $('#headerSearch');

                $headerSearch.on('input', function() {
                    var keyword = $(this).val();
                    if (keyword.length >= 2) {
                        $.ajax({
                            url: '{{ route("search_suggestion") }}',
                            type: 'GET',
                            data: { keyword: keyword },
                            success: function(response) {
                                var suggestions = response.suggestions;
                                var suggestionsHTML = '';
                                for (var i = 0; i < suggestions.length; i++) {
                                    var suggestion = suggestions[i];
                                    suggestionsHTML += '<li><a href="/product-detail/' + suggestion.product_id + '">' + suggestion.product_name + '</a></li>';
                                }
                                if (suggestionsHTML) {
                                    $searchSuggestions.html('<ul>' + suggestionsHTML + '</ul>');
                                    $searchSuggestions.show();
                                } else {
                                    $searchSuggestions.hide();
                                }
                            }
                        });
                    } else {
                        $searchSuggestions.hide();
                    }
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.search-area').length) {
                        $searchSuggestions.hide();
                    }
                });
            });
            </script>


                <!-- Favourite Area -->
                @if(session('id') != NULL )
                    <div class="favourite-area">
                        <a href="{{ URL::to('/order-history') }}"><img src="{{ asset('/FE/img/core-img/heart.svg') }}" alt=""></a>
                    </div>  
                @endif 

                @if(session('id') != NULL )
                <div class="user-login-info">
                    <a href="{{ URL::to('/customer', Auth::id()) }}">{{ strtoupper(session('name')) }}</a>
                </div>
                <!-- @if(session('roll')==1)
                <div class="user-login-info">
                    <a href="{{ URL::to('/dashboard') }}"><img src="{{ asset('/BE/img/icons8-admin-50.png') }}" alt=""></a>
                </div>
                @endif -->
                <div class="user-login-info">
                    <a href="{{ URL::to('/logout') }}"><img src="{{ asset('/FE/img/core-img/sign_out.svg') }}" alt=""></a>
                </div>

                @else
                <div class="user-login-info">
                    <a href="{{ URL::to('/flogin') }}"><img src="{{ asset('/FE/img/core-img/user.svg') }}" alt=""></a>
                </div>
                @endif
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="{{ asset('/FE/img/core-img/bag.svg') }}" alt=""> <span></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{ asset('/FE/img/core-img/bag.svg') }}" alt=""></a>
        </div>

        <div class="cart-content d-flex">
            <?php
            $content = Cart::content();
            ?>
            <!-- Cart List Area -->
            <div class="cart-list">
                @foreach($content as $v_content)
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="{{ URL::to('/delete-to-cart/'.$v_content-> rowId) }}" class="product-image" style="width: 200px; height: 200px;">
                        <img src="{{ asset('/uploads/product/'.$v_content-> options-> image) }}" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                            <span class="product-remove"><i class="fa fa-close"  aria-hidden="true"></i></span>
                            <span class="badge"></span>
                            <h6>{{ $v_content -> name }}</h6>
                            <p class="size">{{ $v_content -> options -> storage }}</p>
                            <p class="color">{{ $v_content -> options -> color }}</p>
                            <p class="price">{{number_format($v_content-> price).' VNĐ'}}</p>
                            <div class="quantity">
                            <form action="/update-cart" method="post" id="cart-form">
                                @csrf
                                <input type="hidden" name="rowId" value="{{ $v_content->rowId }}">
                                <button class="quantity-minus"> - </button>
                                <input type="number" class="quantity-input" name="qty" value="{{ $v_content->qty }}" readonly>
                                <button class="quantity-plus">+</button>
                            </form>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                <li><span>subtotal:</span> <span class="cart-summary-subtotal">{{ Cart::subtotal().' VNĐ' }}</span></li>
                <li><span>delivery:</span> <span>Free</span></li>
                <li><span>discount:</span><span class="cart-summary-discount">{{ Cart::discount().' VNĐ' }}</span></li>
                <li><span>total:</span> <span class="cart-summary-total">{{ Cart::priceTotal().' VNĐ' }}</span></li>
                </ul>
                <div class="cart-info"></div>
                @if(session('id') != NULL )

                    <div class="checkout-btn mt-100">
                    <a href="{{ URL::to('/checkout') }}" class="btn essence-btn">check out</a>
                </div>
                @else
                    <div class="checkout-btn mt-100">
                    <a href="{{ URL::to('/flogin') }}" class="btn essence-btn">check out</a>
                </div>
                @endif
                
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        $('.quantity-plus').on('click', function() {
            var input = $(this).siblings('.quantity-input');
            var currentQty = parseInt(input.val());
            input.val(currentQty + 1);
        });

        $('.quantity-minus').on('click', function() {
            var input = $(this).siblings('.quantity-input');
            var currentQty = parseInt(input.val());
            if (currentQty > 1) {
                input.val(currentQty - 1);
            }
        });
        $('#cart-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: $(this).attr('action'), // Get the form action URL
                type: $(this).attr('method'), // Get the form method (POST)
                data: formData, // Set the serialized form data as the request payload
                success: function(response) {
                    // Handle the successful response here (if needed)
                    updateCartSummary(response.summary);
                    
                
            },
                error: function(xhr, status, error) {
                    // Handle any error that occurred during the request (if needed)
                    console.log(error);
                }
            });
        });
        function updateCartSummary(summary) {
    var subtotal = summary.subtotal;
    var discount = summary.discount;
    var total = summary.total;

    $('.cart-summary-subtotal').text(subtotal);
    $('.cart-summary-discount').text(discount);
    $('.cart-summary-total').text(total);
  }
  
    });
</script>
<!-- <script>
 $(document).ready(function() {
  $('.quantity-plus').on('click', function() {
    var input = $(this).prev('.quantity-input');
    var quantity = parseInt(input.val());
    quantity += 1;
    input.val(quantity);
    updateCartItem(input);
  });

  $('.quantity-minus').on('click', function() {
    var input = $(this).next('.quantity-input');
    var quantity = parseInt(input.val());
    if (quantity > 1) {
      quantity -= 1;
      input.val(quantity);
      updateCartItem(input);
    }
  });

  function updateCartItem(input) {
    var form = input.closest('form');
    var formData = form.serialize();
    var url = form.attr('action');

    $.ajax({
        url: $(this).attr('action'), // Get the form action URL
                type: $(this).attr('method'), // Get the form method (POST)
                data: formData, // Set the serialized form data as the request payload  
      success: function(response) {
        updateCartSummary(response.summary);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  function updateCartSummary(summary) {
    var subtotal = summary.subtotal;
    var discount = summary.discount;
    var total = summary.total;

    $('.cart-summary-subtotal').text(subtotal);
    $('.cart-summary-discount').text(discount);
    $('.cart-summary-total').text(total);
  }
    });
</script> -->
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->
    <!-- <section class="slide-home">
        <div class="slider">
          <div class="slider-wrapper">
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner3.jpg') }}" alt="Slide 1">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner4.jpg') }}" alt="Slide 2">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner2.jpg') }}" alt="Slide 3">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner1.jpg') }}" alt="Slide 4">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner6.jpg') }}" alt="Slide 5">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner7.jpg') }}" alt="Slide 6">
            </div>
            <div class="slider-slide">
              <img src="{{ asset('/FE/img/banner-img/banner5.jpg') }}" alt="Slide 7">
            </div>
          </div>
          
          <div class="slider-prev">&#10094;</div>
          <div class="slider-next">&#10095;</div>
        </div>
        <style>
            .slider {
              position: relative;
              overflow: hidden;  
              width: 2000px; 
              height: 550px;          
            }

            .slider-wrapper {
              display: flex;
              transition: transform 0.5s ease;
            }

            .slider-slide {
                box-sizing: border-box;
              width: 100%;
              padding: 0 auto;
              flex: 0 0 100%;
            }

            .slider-slide img {
              display: block; margin: 0 auto;
              width: 100%;
              height: auto;
            }

            .slider-prev,
            .slider-next {
              position: relative;
              top: 50%;
              
              z-index: 1;
              cursor: pointer;
            }

            .slider-prev {
              left: 0;
            }

            .slider-next {
              right: 0;
            }

        </style>   
        <script>
           var sliderWrapper = document.querySelector('.slider-wrapper');
            var sliderPrev = document.querySelector('.slider-prev');
            var sliderNext = document.querySelector('.slider-next');
            var slideWidth = document.querySelector('.slider-slide').clientWidth;
            var currentSlide = 0;

            function slideNext() {
              currentSlide++;
              if (currentSlide > sliderWrapper.children.length - 1) {
                currentSlide = 0;
              }
              sliderWrapper.style.transform = 'translateX(-' + slideWidth * currentSlide + 'px)';
            }

            var slideInterval = setInterval(slideNext, 5000);

            sliderPrev.addEventListener('click', function() {
              currentSlide--;
              if (currentSlide < 0) {
                currentSlide = sliderWrapper.children.length - 1;
              }
              sliderWrapper.style.transform = 'translateX(-' + slideWidth * currentSlide + 'px)';
            });

            sliderNext.addEventListener('click', slideNext);

        </script> 
    </section> -->
    <!-- <div class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                        <div class="splide__list">
                            <div class="splide__slide">
                                <div>
                                <img src="{{ asset('/FE/img/banner-img/banner3.jpg') }}" alt="Slide 1">
                                </div>
                            </div>
                            <div class="splide__slide">
                                <div >
                                <img src="{{ asset('/FE/img/banner-img/banner4.jpg') }}" alt="Slide 2">
                                </div>
                            </div>
                            <div class="splide__slide">
                                <div>
                                <img src="{{ asset('/FE/img/banner-img/banner2.jpg') }}" alt="Slide 3">
                                </div>
                            </div>
                        </div>
                </div>

                <div class="my-slider-progress">
                    <div class="my-slider-progress-bar"></div>
                </div>
            </div> -->
    
    
    @yield('slide')
  

            <!-- ##### Welcome Area End ##### -->
    @yield('content')

    <!-- ##### Footer Area Start ##### -->
    
    <footer class="footer_part" style=" margin-top: 10px; padding: 20px; background-color: #F8F8F8; background-clip: padding;">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Thông Tin Cửa Hàng</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Cửa Hàng AppleUS</a></li>
                            <li><a href="">In Your Imagination</a></li>
                            <li><a href="">Hotline: 2222.2222.22</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Chính Sách</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Quy chế hoạt động</a></li>
                            <li><a href="">Chính sách Bảo hành</a></li>
                            <li><a href="">Liên hệ hợp tác kinh doanh</a></li>
                            <li><a href="">Đơn Doanh nghiệp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Bảo Hành</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Tra thông tin bảo hành</a></li>
                            <li><a href="">Trung tâm bảo hành chính hãng</a></li>
                            <li><a href="">Quy định về việc sao lưu dữ liệu</a></li>
                            <li><a href="">Dịch vụ bảo hành điện thoại</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Hotline</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Gọi mua hàng: 8888.4444</a></li>
                            <li><a href="">Gọi kiếu nại: 1900.10008</a></li>
                            <li><a href="">Gọi bảo hành: 1111.1001</a></li>
                            <li><a href="">Không gọi vào: (00h00 - 24h00)</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                
                        <div class="copyright_text">
                            <p style="display: inline;">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved <i class="ti-heart" aria-hidden="true"></i> by <a href="https://www.facebook.com/cardib" target="_blank">AppleUS</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                   
                   
                </div>
            </div>
        </div>
    </footer> 
   
    <!-- ##### Footer Area End ##### -->
    <script src="{{ asset('/BE/ckeditor/ckeditor.js') }}"></script>
      <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
      </script>
    
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('/FE/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('/FE/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('/FE/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('/FE/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('/FE/js/classy-nav.min.js') }}"></script>

    

    <!-- Active js -->
    <script src="{{ asset('/FE/js/active.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
</body>

</html>