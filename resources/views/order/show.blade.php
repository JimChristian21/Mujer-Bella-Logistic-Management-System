@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="w-100">
                <div class="w-100">
                  <p><strong>Name:</strong> {{ $data['user']['name'] }}</p>
                  <p><strong>Address:</strong> {{ $data['orderAddress']['address'] }}</p>
                  <p><strong>Zip code:</strong> {{ $data['orderAddress']['zipCode'] }}</p>
                  <p><strong>Contact Number:</strong> {{ $data['user']['phoneNumber'] }}</p>
                </div>
                <table id="cart" class="w-100 mt-5">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Quantity</th>
                            @if($data['orderStatus'] == 'Received')
                                <th class="text-center">Feedback</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['products'] as $product)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3 product-images">
                                            <img class="d-inline w-100" src="{{ asset("images/" . ($product['images'][0] ?? 'alt-product.png')) }}" alt="Product Image">
                                        </div>
                                        <div class="col-md-9">
                                            <h5 class="font-weight-bold">{{ $product['name'] }}</h5>
                                            <p>{{ $product['description'] }}</p>
                                        <div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <i class="fa-solid fa-peso-sign"></i> {{ $product['price'] }}
                                </td>
                                <td class="text-center">
                                    {{ $product['quantity'] }}
                                </td>
                                @if($data['orderStatus'] == 'Received')
                                    <td class="text-center">
                                        @if(!$product['is_added_feedback'])
                                            <button 
                                                class="btn btn-md mb-btn update-btn rate" 
                                                type="button"
                                                data-toggle="modal" 
                                                data-target="#rating" 
                                                product-id="{{$product['id']}}"
                                                user-id="{{Auth::user()->id}}"
                                            >
                                                Rate
                                            </button>
                                        @else
                                            Done
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="w-100 mt-4 pb-5">
                @if($data['orderStatus'] == "To Pay")
                    <form id="delete-user" action="{{ route('order-destroy', $data['id'])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-md mb-btn float-right cancel-order-btn">Cancel Order
                        </button>
                    </form>
                    <a href="{{ $data['checkout_url'] }}" class="btn btn-md mb-btn float-right mr-2" target="_blank">Pay through Gcash</a>
                @endif
                <span class="float-right mr-4 mt-2 font-weight-bold">Total: <i class="fa-solid fa-peso-sign"></i> {{ $data['totalPrice'] }}</span>
                <h3 class="mr-4 font-weight-bold text-center"><strong>Status:</strong> {{ $data['orderStatus'] }}</h3>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('order-payment', $data['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Payment Form</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center font-weight-bold">Send Payment through GCASH</p>
                                <p>Name: Juan Dela Cruz</p>
                                <p>GCash Number: 09XXXXXXXXX</p>
                                <label for="reference-number">Reference Number:</label>
                                <input id="reference-number" class="form-control" type="text"  name="reference_number" required>
                                <label for="reference-proof-image" class="mt-3">Upload Screenshot:</label>
                                <input id="reference-proof-image" class="form-control" type="file"  name="reference_proof_image" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn mb-btn payment-submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="rating" tabindex="-1" role="dialog" aria-labelledby="rating" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('product-rate')}}" method="POST" enctype="multipart/form-data" class="rated">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Feedback</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center font-weight-bold">STAR</p>
                                <select name="rating" class="form-control rating-number">
                                    <option value="1">&#9733;</option>
                                    <option value="2">&#9733;&#9733;</option>
                                    <option value="3">&#9733;&#9733;&#9733;</option>
                                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                </select>
                                <label for="message">Message: </label>
                                <textarea class="form-control" name="message" class="message-val" required></textarea>
                                <input type="hidden" name="product_id" id="rate_product_id" value="0" required/>
                                <input type="hidden" name="order_id" id="order_id" value="{{$data['id']}}" required/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn mb-btn rating-submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- <div class="card h-100">
                <div class="card-body" style="background-color: #FEE3EC;">
                    <h5 class="card-title font-weight-bold">HD Matte Lip Tint</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="card-text"><strong>Price:</strong> 999</p>
                    <p class="card-text"><strong>Stock:</strong> 999</p>
                    <p class="card-text">
                        <strong>Quantity:</strong> 
                        <button id="btn-decrease" class="btn mb-border-black-1 mb-btn"style="padding: 0px 5px;"><i class="fa-solid fa-minus"></i></button>
                        <input id="quantity" type="text" name="quantity" value="0" placeholder="0" style="width: 30px;">
                        <button id="btn-increase" class="btn mb-border-black-1 mb-btn" style="padding: 0px 5px;"><i class="fa-solid fa-plus"></i></button>
                    </p>
                    <div class="w-100 justify-content-center" style="display: flex; align-items: center;">
                        <button class="btn btn-md mb-btn cart-btn">ADD TO CART</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
    
@section('after-content')
    <script>
        var productId = 0;
        $('.payment-submit-btn').click(function(e) {
            toastr.success('Payment has been submitted and will refresh the page!');
        });

        $('.cancel-order-btn').click(function(e) {
            toastr.success('Order has been cancelled!');
        });

        $('.rate').click(function() {
            productId = $(this).attr('product-id');
        });

        $('.rating-submit-btn').click(function(e) {
            
            e.preventDefault();
            $('#rate_product_id').attr('value', productId);

            $('.rated').submit();            
        });
    </script>
@endsection
