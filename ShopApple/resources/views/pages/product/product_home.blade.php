@extends('product_layout')
@section('title')
    All product
@endsection
@section('sort')
    @if (isset($checked))
        @if ($checked == 1)
            <option value="{{ URL::to('/sort_product_desc') }}" selected>Price: High - Low</option>
            <option value="{{ URL::to('/sort_product_asc') }}">Price: Low - High</option>
        @elseif ($checked == 2)
            <option value="{{ URL::to('/sort_product_desc') }}">Price: High - Low</option>
            <option value="{{ URL::to('/sort_product_asc') }}" selected>Price: Low - High</option>
        @endif

    @else
        <option value="{{ URL::to('/sort_product_desc') }}">Price: High - Low</option>
        <option value="{{ URL::to('/sort_product_asc') }}" >Price: Low - High</option>
    @endif
@endsection
