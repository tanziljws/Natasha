<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.dashboard.index', ['only' => ['index']]);
    }

    public function index()
    {
        $postCount = Post::count();
        $galeryCount = Galery::count();
        $fotoCount = Foto::count();
        $kategoriCount = Category::count();
        $petugasCount = User::count();

        return view('admin.dashboard.index', compact(
            'postCount', 'galeryCount', 'fotoCount', 'kategoriCount', 'petugasCount'
        ));
    }
}
