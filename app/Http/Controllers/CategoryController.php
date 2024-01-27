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
        
    public function doubleSearch(Request $request)
        {
            $keyword = $request->input('keyword');
            
            $category = Category::find($request->input('category'));
            
            $query = $category->posts();
        
            if (!empty($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%{$keyword}%")
                          ->orWhereHas('tags', function ($query) use ($keyword) {
                              $query->where('name', 'LIKE', "%{$keyword}%");
                          });
                });
            }
        
            $posts = $query->paginate(10);
        
            return view('posts.serch')->with([
                'posts' => $posts,
                'keyword' => $keyword,
                'category' => $category
            ]);
        }
    
}
