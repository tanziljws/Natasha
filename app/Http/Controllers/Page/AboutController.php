<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show($id)
    {
        $about = Profiles::findOrFail($id);
        return view('page.about.show', compact('about'));
    }
}
