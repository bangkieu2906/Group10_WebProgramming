@extends('product_layout')
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection
@section('title')
    @if(isset($keyw))  
        Result for '{{$keyw}}'' 
    @else Result 
    @endif
@endsection
@section('sort')
    @if (isset($checked))
        @if ($checked == 1)
            <option value="{{ URL::to('/search_sort_product_desc/'.$keyw) }}" selected>Price: High - Low</option>
            <option value="{{ URL::to('/search_sort_product_asc/'.$keyw) }}">Price: Low - High</option>
        @elseif ($checked == 2)
            <option value="{{ URL::to('/search_sort_product_desc/'.$keyw) }}">Price: High - Low</option>
            <option value="{{ URL::to('/search_sort_product_asc/'.$keyw) }}" selected>Price: Low - High</option>
        @endif

    @else
    <option value="{{ URL::to('/search_sort_product_desc/'.$keyw) }}">Price: High - Low</option>
    <option value="{{ URL::to('/search_sort_product_asc/'.$keyw) }}">Price: Low - High</option>

    @endif
@endsection
