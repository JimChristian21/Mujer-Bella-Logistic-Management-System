@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="card w-100">
            <div class="card-header">
                <a href="{{ route('inventory-create') }}" class="btn mb-btn btn-sm float-right">Add Product</a>
            </div>
            <div class="card-body">
                <table id="cart" class="w-100 row-border product-list">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach($products as $product)
                            @if($product->quantity <= 10 && $product->quantity > 0)
                                <tr class="mb-bb-1 font-weight-bold bg-warning text-dark">
                            @elseif($product->quantity == 0)
                                <tr class="mb-bb-1 font-weight-bold bg-danger text-light">
                            @else
                                <tr class="mb-bb-1 font-weight-bold">
                            @endif
                            
                                <td class="text-center">
                                  {{ $product->name }}
                                </td>
                                <td class="text-center">
                                  {{ $product->description }}
                                </td>
                                <td class="text-center">
                                  {{ $product->quantity }}
                                </td>
                                <td class="text-center">
                                 <i class="fa-solid fa-peso-sign"></i> {{ number_format($product->price, 2) }}
                                </td>
                                <td class="text-center">
								  <form id="delete-user" action="{{ route('inventory-destroy', $product->id) }}" method="POST">
                                    @csrf
                                    <a class="btn btn-sm mb-btn" href="{{ route('inventory-show', $product->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm mb-btn delete-btn"><i class='bx bxs-trash delete' ></i></a>
                                    <button type="submit" class="submit">
                                    </button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('after-content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  
    <script>
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

        $('.checkout-btn').click(function() {
            toastr.success('Products are moved to orders!');
        });

        $(document).ready( function () {
            $('.product-list').DataTable();
        });

		$('.submit').hide();
    </script>
    <style>
    </style>
@endsection
