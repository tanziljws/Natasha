<?php

namespace App\Http\Controllers\Page;


use App\Models\Post;
use App\Models\Major;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Advantage;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $majors= Major::get();
        $gallery = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 2);
                    })
                    ->get();
            
        $agenda = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 3);
                    })
                    ->take(4)
                    ->get();
        $informasi = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 1);
                    })
                    ->take(4)->get();

        $maps = Post::where('status', 1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 4);
                    })
                    ->get();
        
                    
        return view('page.home.index',compact('majors','agenda','gallery','maps','informasi'));
    }
}
