@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="card w-100">
            <div class="card-header text-center mb-bg-pink-light">
              <h3>Update Product Details</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('inventory-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="name">Name:</label>
                  <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="description">Description:</label>
                  <input type="text" id="description" name="description" value="{{ $product->description }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="quantity">Quantity:</label>
                  <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="unit-price">Unit Price:</label>
                  <input type="number" id="unit-price" name="unitPrice" value="{{ $product->price }}" class="form-control" required>
                </div>
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
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="text-center">
                  <button class="btn btn-md mb-btn" type="submit">Submit</button>
                  <a class="btn btn-md mb-btn" href="{{ route('inventory-show', $product->id) }}">Back</a>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('after-content')
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script>  

         $(document).ready(function() {
            $(".add-btn").click(function(){ 
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
          });
    </script>
    

    <style>
    </style>
@endsection
