<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories\CategoryModel;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category/add');
    }

    public function add(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       ]);

       $category = new CategoryModel;

       if ($request->file('image')) {
        $file = $request->file('image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $category['image'] = $filename;
    }       
       $category->catname = $request->name;
       $category->save();
       Session::flash('message', 'Category added successfully !');
       return redirect('/category/index');
    }   

}
