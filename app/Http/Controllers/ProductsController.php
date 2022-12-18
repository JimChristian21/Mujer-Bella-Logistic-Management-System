<?php

namespace App\Http\Controllers;

use App\Models\{
    ProductImage,
    Products,
    feedback,
    OrderProduct,
    UserPersonalInformation
};
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function index() {
        
        $products = Products::all();
        $productsImages = ProductImage::all();
        $items = [];

        foreach($products as $product) {
            $images = [];
                
            foreach($productsImages as $image) {
                if($image['product_id'] == $product['id']) {
                    $images[] = $image['link'];
                }
            }
            
            $items[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'images' => $images
            ];
        }

        return view('products.list', ['products' => $items]);
    }

    function show($id) {
        $products = Products::find($id);
        $productsImages = ProductImage::where('product_id', '=', $id)->get();
        $feedback = feedback::where('product_id', '=', $id)->get();
        $images = [];
        $feedbacks = [];

        foreach($productsImages as $item) {
            $images[] = $item->link;
        }

        $product = [
            'id' => $products->id,
            'name' => $products->name,
            'description' => $products->description,
            'quantity' => $products->quantity,
            'price' => $products->price,
            'images' => $images
        ];

        foreach($feedback as $rating) {

            $user = UserPersonalInformation::find($rating->person_information_id);
            
            $feedbacks[] = [
                'rating' => $rating->star,
                'message' => $rating->message,
                'customer_name' => $user->first_name . ' ' . $user->last_name,
            ];
        }

        return view('products.show', ['product' => $product, 'feedbacks' => $feedbacks]);
    }

    function rate(Request $request)
    {

        $order_product = OrderProduct::where([
            ['order_id', '=', $request->order_id],
            ['product_id', '=', $request->product_id]
        ])->first();
        $order_product->is_added_feedback = TRUE;
        $order_product->save();

        $feedback = new feedback();
        $feedback->star = $request->rating;
        $feedback->message = $request->message;
        $feedback->product_id = $request->product_id;
        $feedback->person_information_id = Auth::user()->id;
        $feedback->save();
       
        return redirect()->route('order-show', [$request->order_id]);
    }
}
