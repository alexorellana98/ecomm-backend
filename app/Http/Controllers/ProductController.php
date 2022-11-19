<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    function addProduct(Request $request){
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->file('file')){
            $product->file_path = $request->file('file')->store('products');
        }

        // $product->file_path = $request->file('file')->store('uploads/pruducts', 'public');

        $product->save();

        return $product;
    }

    function listProduct(){
        return Product::all();
    }

    function deleteProduct($id){
        $result = Product::destroy($id);

        if($result){
            return ["result"=>"Product has been delete"];
        }else{
            return ["result"=>"Operation failed"];
        }
    }

    function getProduct($id){
        return Product::find($id);
    }

    function updateProduct($id,Request $request){
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->file('file')){
            $product->file_path = $request->file('file')->store('products');
        }

        // $product->file_path = $request->file('file')->store('uploads/pruducts', 'public');

        $product->save();

        return $product;
    }

    function searchProduct($key){
        if (empty($key)) {
            return Product::all();
        } else {
            return Product::where('name', 'LIKE', "%$key%")
                    ->orWhere('price', 'LIKE', "%$key%")
                    ->orWhere('description', 'LIKE', "%$key%")
                    ->get();
        }
    }

}
