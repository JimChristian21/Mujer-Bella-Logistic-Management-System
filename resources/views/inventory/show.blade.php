@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="card w-100">
            <!-- <div class="card-header">
                <a href="{{ route('inventory-create') }}" class="btn mb-btn btn-sm float-right">Add Product</a>
            </div> -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4 pb-3">
                    <div class="product-images w-100">
                        @foreach($product['images'] as $image)
                        <div class="carousel-cell">
                          <img src="{{ asset("images/$image") }}" alt="product-image" height="250"/>
                        </div>
                        @endforeach
                    </div>
                  </div>
                  <div class="col-md-8 d-flex flex-column">
                    <div class="mb-auto">
                      <h5 class="card-text"><strong>Name:</strong> {{ $product['name'] }} </h5>
                      <p class="card-text"><strong>Description:</strong> {{ $product['description'] }}</p>
                      <p class="card-text"><strong>Price:</strong> {{ $product['price'] }}</p>
                      <p class="card-text"><strong>Stock:</strong> {{ $product['quantity'] }}</p>
                    </div>
                    <div class="w-100 justify-content-center" style="display: flex; align-items: center; justify-content-end">
                      <form id="delete-user" action="{{ route('inventory-destroy', $product['id']) }}" method="POST">
                        @csrf
                        <a class="btn mb-btn btn-md mr-3" href="{{ route('inventory-edit', $product['id']) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a class="btn mb-btn btn-md mr-3 delete-btn" href="#"><i class="fa-solid fa-trash"></i> Delete</a>
                        <a class="btn mb-btn btn-md" href="#" onclick="window.history.back()"><i class="fa-solid fa-angle-left"></i> Back</a>
                        <button type="submit" class="submit">
                        </button>
                      </form>
                    </div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('product-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Update Information</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="name">Name:</label>
                                <input id="name" class="form-control" type="text"  name="name" value="{{ $product['name'] }}" required>

                                <label for="description" class="mt-3">Description:</label>
                                <input id="description" class="form-control" type="text" value="{{ $product['description'] }}"  name="description" required>

                                <label for="quantity" class="mt-3">Quantity:</label>
                                <input id="quantity" class="form-control" type="number" value="{{ $product['quantity'] }}"  name="quantity" required>

                                <label for="unit_price" class="mt-3">Unit Price:</label>
                                <input id="unit_price" class="form-control" type="number" value="{{ $product['price'] }}" name="price" required>

                                <input type="file" id="images" name="filename" class="form-control">

                                <div class="mb-3 increment">
                                  <label for="images">Images:</label>
                                  <input type="file" id="images" name="filename[]" class="form-control">
                                </div>
                                <div class="clone hide">
                                  <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn"> 
                                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                  </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                  <button class="btn mb-btn btn-sm add-btn" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn mb-btn submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
@endsection

@section('after-content')
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script>
    $('.product-images').flickity({
      // options
      cellAlign: 'center',
      contain: true
    });

    $('.submit').hide();


    $('.delete-btn').click(function(e) {
            // swal({
            //     title: "Are you sure you want to cancel the order?",
            //     text: "",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete) => {
            //     if (willDelete) {
            //         swal("Product has been deleted!", {
            //         icon: "success",
            //         });
                    
            //         const xhttp = new XMLHttpRequest();
            //         xhttp.onload = function() {
                        
            //         }
            //         xhttp.open("GET", "ajax_info.txt", true);
            //         xhttp.send();
            //     }
            // });
						$('.submit').click();
        });


        $(document).ready(function() {
            var html = $(".clone").html();
            $(".add-btn").click(function(){ 
                $(".increment").after(html);
            });
            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
          });
  </script>
@endsection
