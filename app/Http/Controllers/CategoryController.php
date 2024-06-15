<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showByCategory(Category $category)
    {
        $posts = $category->posts()->paginate(10);

        return view('posts_category')->with([
            'posts' => $posts,
            'pagination_enabled' => true,
            'name' => $category->name
        ]);
    }

}
