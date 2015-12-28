<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 00:11
 */

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{

    public function index() {
        $products = Product::all();
        return view('product.index', ['products' => $products]);
    }

    public function newProduct() {
        return view('product.create');
    }

    public function storeProduct(ProductRequest $request) {
        $product = Product::where('name', $request->name)->where('color', $request->color)->first();
        if($product) {
            $product->quantity = $request->quantity;

            $product->save();
        }else{
            $product = new Product([
                'name' => $request->name,
                'color' => $request->color,
                'quantity' => $request->quantity
            ]);

            $product->save();
        }
        return redirect('products');
    }

    public function removeProduct($id) {
        Product::where('id', $id)->delete();
        return redirect('products');
    }

    public function editProduct($id) {
        $product = Product::where('id', $id)->first();
        return view('product.edit', ['product' => $product]);
    }

    public function updateProduct(ProductRequest $request) {
        $product = Product::where('id', $request->id)->first();
        $product->name = $request->name;
        $product->color = $request->color;
        $product->quantity = $request->quantity;

        $product->save();

        return redirect('products');
    }

}