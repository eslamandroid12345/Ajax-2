<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function products(){

        $products = Product::paginate(5);

        return view('products.index',compact('products'));

    }


    public function create(){


        return view('products.create');
    }


    public function store(Request $request){


           $request->validate([

               'image' => 'required|mimes:jpg,png,jpeg',
               'name' => 'required',
               'price' => 'required',
               'description' => 'required'
           ]);

           if($request->has('image')){

               $image = $request->file('image');
               $destinationPath = 'products/';
               $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
               $image->move($destinationPath, $profileImage);
               $request['image'] = "$profileImage";
           }




            $product = new Product();
            $product->image = $profileImage;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();


        if($product){

            return response()->json([

                "status" => true,
                "message" => "product created successfully",

            ]);

        }else{

            return response()->json([

                "status" => false,
                "message" => "failed to create product please try again",

            ]);
        }


    }

    public function edit($id){


        $product = Product::find($id);

        return view('products.edit',compact('product'));
    }


    public function update(ProductRequest $request){


        $image = $request->file('image');

        $destinationPath = 'products/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $request['image'] = "$profileImage";



        $product = Product::find($request->product_id);
        $product->image = $profileImage;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($product){


            return response()->json([

                "status" => true,
                "message" => "product updated successfully",

            ]);

        }else{

            return response()->json([

                "status" => false,
                "message" => "failed to update product please try again",

            ]);
        }



    }


    public function delete(Request $request){

        $product = Product::find($request->id);   // Offer::where('id','$offer_id') -> first();

        $product->delete();

        return response()->json([

            'status' => true,
            'message' => 'تم الحذف بنجاح',
            'id' =>  $request->id
        ]);

    }

}
