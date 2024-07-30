<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // $products = product::get();
        $products = product::latest()->paginate(2);
        return view('products.index',['products'=>$products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'mrp'=>'required|numeric',
            'price'=>'required|numeric',
            'image'=>'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);

        $products = new product;
        $products->image = $imageName;
        $products->name = $request->name;
        $products->mrp = $request->mrp;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->save();

        return back()->withSuccess('Product Details Added Successfully...');
    }

    public function show($id){
        $productList = product::where('id',$id)->first();
        return view('products.show',['product'=>$productList]);
    }

    public function edit($id){
        $productList = product::where('id',$id)->first();
        return view('products.edit',['product'=>$productList]);
    }

    public function update(Request $request,$id){
        $products = product::where('id',$id)->first();

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'mrp'=>'required|numeric',
            'price'=>'required|numeric',
            'image'=>'nullable',
        ]);

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'),$imageName);
        }

        $products->image = $imageName;
        $products->name = $request->name;
        $products->mrp = $request->mrp;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->save();

        return back()->withSuccess('Product Details Updated Successfully...');
    }

    public function destroy($id){
        $product = product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product Details Deleted Successfully...');
    }
}
