<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories\CategoryModel;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
      
        $categories = CategoryModel::all();
        return view('welcome', ['categories' => $categories]);
    }
}
