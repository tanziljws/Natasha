<?php

namespace App\Http\Controllers\Admin;

use App\Services\Upload\UploadManager;
use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    protected $galery;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.galery.index')->only('index');
        $this->middleware('can:admin.galery.create')->only('create', 'store');
        $this->middleware('can:admin.galery.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.galery.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Galery::query();

        if ($request->filled('search')) {
            $query->where('position', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $items = $query->with('fotos')->latest()->paginate($perPage)->appends($request->all());

        return view('admin.galery.index', compact('items'));
    }

    public function create()
    {
        $posts = Post::query()->pluck('judul', 'id');
        return view('admin.galery.form', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $galery = Galery::create([
            'post_id' => $request->input('post_id'),
            'position' => $request->input('position', 0),
            'status' => (bool) $request->input('status'),
        ]);

        return redirect()->route('admin.galery.index')
            ->with('success', 'Galery created successfully.');
    }

    public function edit(Galery $galery)
    {
        $posts = Post::query()->pluck('judul', 'id');
        return view('admin.galery.form', compact('galery', 'posts'));
    }

    public function update(Request $request, Galery $galery)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $galery->update([
            'post_id' => $request->input('post_id'),
            'position' => $request->input('position', 0),
            'status' => (bool) $request->input('status'),
        ]);

        return redirect()->route('admin.galery.index')
            ->with('success', 'Galery updated successfully.');
    }

    public function destroy(Galery $galery)
    {
        $galery->delete();

        return redirect()->route('admin.galery.index')
            ->with('success', 'Galery deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Galery::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
