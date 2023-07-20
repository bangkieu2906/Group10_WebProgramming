@extends('welcome')
@section('slide')

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('/FE/img/banner-img/banner2.jpg') }}" alt="Slide 1">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('/FE/img/banner-img/banner4.jpg') }}" alt="Slide 2">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('/FE/img/banner-img/banner6.jpg') }}" alt="Slide 3">
            </div>
            <div class="carousel-item ">
            <img src="{{ asset('/FE/img/banner-img/banner7.jpg') }}" alt="Slide 4">
            </div>
           
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
</div>
           
@endsection

