<?php

namespace App\Http\Controllers\Page;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 2);
                    })
                    ->get();
        return view('page.gallery.index', compact('gallery'));
    }
}
