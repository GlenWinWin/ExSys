<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;

use Validator;

use Session;

use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(5);

    	return view('product.all')->with('products',$products);
    }
    public function create(){
    	return view('product.create');
    }
    public function store(Request $requests){
        $inputs = $requests->all();

    	$validator = Validator::make(
            array(
                'name' => $requests->name,
                'price' => $requests->price
            ),
            array(
                'name' => 'required|min:3',
                'price' => 'required|numeric|min:10'
            ),
            array(
                'name.required' => 'Product name is needed !',
                'price.required' => 'You cannot have an empty price',
                'price.min' => 'Price must be >= 10! '
            )
        );

        if($validator->passes()){

            $product = Product::Create($inputs);

            Session::flash('flash_message','Product added');
            Session::flash('type_message','success');

            return redirect('product');
        }
        else{
            $oldproducts = Product::all();

            return view('product.create')->withErrors($validator,'errors');

        }
    }
    public function edit($id){
    	$product = Product::find($id);

    	return view('product.edit')->with('product',$product);
    }
    public function update(Request $request,$id){
    	$product = Product::find($id);

    	$product->name = $request->name;
    	$product->price = $request->price;
    	$product->save();

        Session::flash('flash_message','Product updated');
        Session::flash('type_message','info');

    	return redirect('product');
    }
    public function destroy($id){
    	Product::destroy($id);
        Session::flash('flash_message','Product deleted');
        Session::flash('type_message','success');
        return redirect('product');

    }

}
