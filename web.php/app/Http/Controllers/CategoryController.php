<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::all();
        return view('category.index')->with('categories', $categories);

    }

    function create(){
        return view('category.create');
    }

    function store(Request $request){
        Category::create(['name' => $request->name]);
        return redirect(route('category.index'));
    }
}
