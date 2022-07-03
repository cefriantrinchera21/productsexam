<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $categories = Category::CategorySearch($search); 
        return view('categories.index',compact('search','categories'));
    }

    
    public function store(CategoryRequest $request)
    {
        $category_name = $request->input('category_name');
        $uuid = Str::uuid()->toString();
        $data = array(
            'category_name'=>$category_name,
            'category_uuid'=>$uuid
        );

        Category::create($data);

        return back()->with('success','CATEGORY SUCCESSFULLY CREATED!');
    }

    public function update_category(CategoryUpdateRequest $request){
        $category_id = $request->input('category_id');
        $category_name = $request->input('category_name');

        $data=array(
            'category_name'=>$category_name,
        );
        Category::where('category_uuid',$category_id)->update($data);
        return back()->with('success','CATEGORY SUCCESSFULLY UPDATED!');
    }   
}
