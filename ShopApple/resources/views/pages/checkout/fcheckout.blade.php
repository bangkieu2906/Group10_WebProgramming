@extends('welcome')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

 <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(public/FE/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
   
    <div class="checkout_area section-padding-80">
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 ">
                    <form action="{{ URL::to('/order-place') }}" method="post">
                    {{ csrf_field() }}
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>
                            <?php
                            if (Session::has('id')) {
                                 $user = DB::table('users')->where('id', Session::get('id'))->first();?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">Name <span>*</span></label>
                                    <input name="shipping_name" type="text" class="form-control" id="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input  name="shipping_email" type="email" class="form-control" id="email_address" value="{{ $user->email }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Phone Number <span>*</span></label>
                                    <input name="shipping_phone" type="number" class="form-control" id="phone_number" min="0" value="{{ $user->phone }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="street_address">Address <span>*</span></label>
                                    <input name="shipping_address" type="text" class="form-control mb-3" id="address" value="{{ $user->address }}">
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="note">Note</label>
                                    <textarea style="resize: none;" name="shipping_note" type="text" class="form-control" id="note" value="" rows="4"> </textarea>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto" >
                  
                    
                    <div class="order-details-confirmation" style="width: 600px">
                        <?php
                        $content = Cart::content();
                        $int = Cart::priceTotal();
                        $totalPriceWithoutDot = str_replace(',', '', $int);
                        $totalPrice = (int) $totalPriceWithoutDot;
                        ?>
                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                        </div>
                        <ul class="order-details-form mb-4">
                            <li><span>Product</span> <span>Total</span></li>
                            @foreach($content as $v_content)
                            <li><span>{{ $v_content -> name }}</span> <span>{{number_format($v_content-> price).' VNĐ'}}</span></li>
                            @endforeach
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Coupon</span>
                                <span> <?php 
                                $message = Session::get('message');
                                if($message){
                                echo '<span class="--bs-voucher">',$message.'</span>';
                                Session::put('message',null);
                                }
                                ?> </span>
                                <span>
                                @if(Session::get('coupon'))
                                    @foreach(Session::get('coupon') as $key => $cou)
                                        @if($cou['coupon_type'] == 1)
                                            Discount {{ $cou['coupon_value'] }} %
                                            @php
                                                $dis = ($totalPrice*$cou['coupon_value'])/100;
                                            @endphp
                                        @elseif($cou['coupon_type'] == 2)
                                            Discount {{number_format($cou['coupon_value'],0,',',',').'VNĐ'}}
                                            <?php
                                                $dis = ($cou['coupon_value']);
                                            ?>
                                        @endif
                                    @endforeach
                                @else
                                    0 VNĐ
                                @endif
                                </span>
                            </li>
                            <li><span>Total</span> <span>
                             @if(Session::get('coupon'))
                                <?php
                                    $total_bill = $totalPrice - $dis
                                ?>
                                <input type="hidden" name="total" value="<?php echo $total_bill; ?>">
                                {{ number_format($total_bill,0,',',',').' VNĐ' }}

                            @else
                                <?php
                                    $total_bill = $totalPrice
                                ?>
                                <input type="hidden" name="total" value="<?php echo $total_bill; ?>">
                                {{ number_format($total_bill,0,',',',').' VNĐ' }}
                            @endif

                            </span></li>
                        </ul>
                        
                        {{-- <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <input type="hidden" name="momo" value="{{$total_bill }}">
                                    <input type="radio" name="payment_option" value="1">
                                    <i class="fa fa-square-o mr-3"></i>MOMO
                                </h6>
                              </div>
                              <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                  <input type="radio" name="payment_option" value="2">
                                  <i class="fa fa-square-o mr-3"></i>Cash on delivery
                                </h6>
                              </div>
                            </div>
                        </div> --}}

                        <style>
                            .card-header:hover {
                            background-color: #f8f9fa;
                            color: green;
                            cursor: pointer;
                            pointer-events: auto; 

                        }
                        .payment-method i.checked {
                           text-color: green;
                        }

                        </style>
                        @if(Session::get('success_paypal') == 1)
                            {{-- paypal --}}
                            <input type="hidden" name="payment_option" value="2">
                            <h5 style="color:green" href="">Success paypal</h5>
                        @else
                            {{-- cash --}}
                            <input type="hidden" name="payment_option" value="1">
                        @endif

                        <button type="submit" name="send" class="btn essence-btn">Place Order</button>
                    </div>
                </div>
                </form>
            </div>
            <hr style="width: 1270px;">
            @if(!Session::get('success_paypal') ==1)
            <form  style="float: right;" method="post" action="{{ url('/check-coupon') }}">
                {{ csrf_field() }}
                <label for="coupon">Voucher</label>
                <input style="width: 300px;" class="form-control" type="text" name="coupon">
                <br>
                <button class="btn essence-btn" type="submit" name="check_coupon">Apply</button>
            </form>
            @endif
            <label for="name">Payment Online</label>
            <br>
            <?php 
                $vnd_to_usd = $total_bill/23452;
                $total_paypal = round($vnd_to_usd,2);
                \Session::put('total_paypal',$total_paypal);
            ?>
            <input type="hidden" name="paypal" value="{{round($vnd_to_usd,2) }}">
            <a class="btn essence-btn" href="{{ route('processTransaction') }}">Paypal</a>
            <form action="{{ url('/momo_payment') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="momo" value="{{$total_bill }}">
                <br>
                <button type="submit" class="btn essence-btn" name="redirect">MOMO</button>
            </form>
            

            <form action="{{ url('/vnpay_payment') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="vnpay" value="{{$total_bill }}">
                <br>
                <button type="submit" class="btn essence-btn" name="redirect">VNPay</button>
            </form>

        </div>
    
    <br>
    <br>
</div>
    
    <!-- ##### Checkout Area End ##### -->


@endsection