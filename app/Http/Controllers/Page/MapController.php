<?php

namespace App\Http\Controllers\Page;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    //
    public function index()
    {
         $maps = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 4);
                    })
                    ->get();
        return view('page.map.index', compact('maps'));
    }

    public function show($id){
           $maps = Post::where('status', 1)
                   ->with('gallery.fotos')
                    ->findOrFail($id);

        return view('page.map.show', compact('maps'));
    }
}
