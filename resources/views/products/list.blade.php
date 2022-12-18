@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end mt-2">
        <div class="col-md-3">
            <div class="w-100">
                <form action="#" method="POST">
                <div class="input-group mb-2">
                    <div class="input-group-prepend cursor-pointer">
                        <div class="input-group-text search-bg"><i class="fa-solid fa-magnifying-glass search-btn"></i></div>
                        </div>
                        <input class="form-control" type="text" name="search-item" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        @foreach($products as $product) 
            <div class="col-md-3 mt-5">
                
            @if($product['quantity'] == 0)  
                <a href="#" class="sold-out">
            @else
                <a href="{{ route('product-show', $product['id']) }}">
            @endif
                    <div class="card product-card">
                        @if($product['quantity'] == 0)
                        <div class="watermarked">
                            <img src="{{ asset('images/' . ($product['images'][0] ?? 'alt-product.png')) }}" class="card-img-top" alt="Product Image">
                        </div>
                        @else
                            <img src="{{ asset('images/' . ($product['images'][0] ?? 'alt-product.png')) }}" class="card-img-top" alt="Product Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $product['name'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- <div class="row justify-content-center">
        <div class="col-md-6 mt-5" style="">
            <span class="float-left" style="cursor: pointer;"> << </span> 
            <span class="ml-5" style="cursor: pointer;">1</span> 
            <span class="ml-5" style="cursor: pointer;">2</span> 
            <span class="ml-5" style="cursor: pointer;">3</span> 
            <span class="ml-5" style="cursor: pointer;">4</span> 
            <span class="ml-5" style="cursor: pointer;">5</span> 
            <span class="ml-5" style="cursor: pointer;">6</span> 
            <span class="ml-5" style="cursor: pointer;">7</span> 
            <span class="ml-5" style="cursor: pointer;">8</span> 
            <span class="float-right" style="cursor: pointer;"> >> </span>
        </div>
    </div> -->
</div>
@endsection

@section('after-content')
<script>

    $('.sold-out').click(function() {
        toastr.error('Product sold out!');
    });
</script>
@endsection
