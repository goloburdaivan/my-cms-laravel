<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('site.home.main-page', [
            'products' => Product::query()->take(10)->get(),
            'categories' => Category::query()->where('parent_id', null)->get(),
        ]);
    }
}
