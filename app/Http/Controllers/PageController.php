<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(string $slug): View
    {
        return view('site.page.index', [
            'page' => Page::query()->where('slug', $slug)->firstOrFail(),
        ]);
    }
}
