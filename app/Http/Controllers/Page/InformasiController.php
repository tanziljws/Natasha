<?php

namespace App\Http\Controllers\Page;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->whereIn('type', [3, 1]);
                    })
                    ->get();
        return view('page.informasi.index', compact('informasis'));
    }
}
