<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $products = Product::ProductSearch($search); 
        $categories = Category::pluck('category_name','id')->all();
        return view('products.index',compact('search','products','categories'));
    }

   
    public function store(ProductCreateRequest $request)
    {
        $product_name = $request->input('product_name');
        $category_id = $request->input('category_id');
        
        $uuid = Str::uuid()->toString();
        $data = array(
            'product_name'=>$product_name,
            'product_uuid'=>$uuid,
            'category_id'=>$category_id
        );

        Product::create($data);
        return back()->with('success','PRODUCTS SUCCESSFULLY CREATED!');
    }

    public function update_products(Request $request){
        $product_name = $request->input('product_name');
        $category_id = $request->input('category_id');
        $product_id = $request->input('product_id');
        
        $check = Product::where('product_uuid',$product_id)->first();
        $check_update= $check->product_name;

        if(strtoupper($check_update) == strtoupper($product_name)):
            $data = array(
                'category_id'=>$category_id
            );
    
            Product::where('product_uuid',$product_id)->update($data);
            return back()->with('success','PRODUCT ALREADY UPDATED!');
        else:
            $product_row = Product::where('product_name',$product_name)->first();
            if(!empty($product_row)):
                return back()->with('danger','PRODUCT ALREADY EXIST!');
            else:
                $data = array(
                    'category_id'=>$category_id,
                    'product_name'=>$product_name
                );
        
                Product::where('product_uuid',$product_id)->update($data);
                return back()->with('success','PRODUCT ALREADY UPDATED!');
            endif;
        endif;
    }

    public function delete_product(Request $request){
        $product_id = $request->input('product_id');
        Product::where('product_uuid',$product_id)->delete();
        return back()->with('success','PRODUCT SUCCESSFULLY DELETED!');
    }   

}
