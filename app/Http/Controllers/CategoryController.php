<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function index(Category $category)
        {
            $categories = Category::all();
            return view('categories.index',compact('categories'))->with([
                'posts' => $category->getByCategory()
                ]);
        }
}
