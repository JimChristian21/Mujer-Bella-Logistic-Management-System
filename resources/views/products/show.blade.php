@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-4">
            <div class="card float-right w-100 product-images">
                @forelse($product['images'] as $image)
                    <div class="carousel-cell">
                        <img src="{{ asset('images/' . ($image ?? 'alt-product.png')) }}" class="card-img-top" alt="Product Image" style="height: 100%; width: 100%;">
                    </div>
                @empty
                    <div class="carousel-cell">
                        <img src="{{ asset('images/alt-product.png') }}" class="card-img-top" alt="Product Image" style="height: 100%; width: 100%;">
                    </div>
                @endforelse
                <!-- <img src="{{ asset('img/liptint_1.jpg') }}" class="card-img-top" alt="..." style="height: 100%; width: 100%;"> -->
                <!-- <div class="card-body">
                    <h5 class="card-title font-weight-bold">HD Matte Lip Tint</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div> -->
            </div>
        </div>
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between" style="background-color: #FEE3EC;">
                    <div>
                        <h5 class="card-title font-weight-bold">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <p class="card-text"><strong>Price:</strong> {{ $product['price'] }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $product['quantity'] }}</p>
                        <p class="card-text">
                            <strong>Quantity:</strong> 
                            <button id="btn-decrease" class="btn mb-border-black-1 mb-btn"style="padding: 0px 5px;"><i class="fa-solid fa-minus"></i></button>
                            <input id="quantity" type="text" name="quantity" value="0" placeholder="0" style="width: 30px;">
                            <button id="btn-increase" class="btn mb-border-black-1 mb-btn" style="padding: 0px 5px;"><i class="fa-solid fa-plus"></i></button>
                        </p>
                    </div>
                    <div class="w-100 justify-content-center" style="display: flex; align-items: center;">
                        <form action="{{ route('cart-product-store', $product['id']) }}" method="POST" id="add_to_cart">
                            @csrf
                            <input type="hidden" name="quantity" value="0" class="quantity">
                            <button class="btn btn-md mb-btn cart-btn" type="submit">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 mt-3">
            <hr/>
            <h3>Ratings</h3>
            <hr/>
        </div>
        @forelse($feedbacks as $feedback)
            <div class="col-12">
                <div class="card-header" style="background-color: #FEE3EC!important;">
                    <p class="d-inline">{{$feedback['customer_name']}}</p>
                    @for($i = 0; $i < $feedback['rating']; $i++)
                        <span style="font-size: 20px;">&#9733;</span>
                    @endfor
                </div>
                <div class="card-body d-flex flex-column justify-content-between" style="background-color: #f5f5f5;">
                        <p>{{$feedback['message']}}</p>     
                </div>  
            </div>
        @empty
            <div class="col-12">
                <h3>No ratings yet!</h3>  
            </div>
            
        @endforelse
    </div>
</div>
@endsection
    
@section('after-content')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        $('.product-images').flickity({
            cellAlign: 'center',
            contain: true
        });

        
        
        $('#btn-increase').click(function () {
            if(Number($('#quantity').val()) < {{ $product['quantity'] }}) {
                let quantityElement = $('#quantity');
                let quantityValue = Number($('#quantity').val()) + 1;
                $('.quantity').val(quantityValue);
                quantityElement.val(quantityValue);
            }
        });

        $('#btn-decrease').click(function () {
            if(Number($('#quantity').val()) > 0) {
                let quantityElement = $('#quantity');
                let quantityValue = Number($('#quantity').val()) - 1;
                $('.quantity').val(quantityValue);
                quantityElement.val(quantityValue);
            }   
        });

        $('.cart-btn').click(function (e){
            e.preventDefault();

            if(Number($('#quantity').val()) > 0) {
                toastr.success('Product added to cart!');
                $('#add_to_cart').submit();
            } else {
                toastr.error('Add Quantity!');
            }
        });
        
    </script>
@endsection
