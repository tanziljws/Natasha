<?php

namespace App\Http\Controllers\Admin;

use App\Services\Upload\UploadManager;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.post.index')->only('index');
        $this->middleware('can:admin.post.create')->only('create', 'store');
        $this->middleware('can:admin.post.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.post.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $perPage = $request->input('per_page', 10);
        $items = $query->latest()->paginate($perPage)->appends($request->all());

        return view('admin.post.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::query()->pluck('judul', 'id');
        $petugas = User::query()->pluck('name', 'id');
        return view('admin.post.form', compact('categories', 'petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $post = Post::create([
            'judul' => $request->input('judul'),
            'kategori_id' => $request->input('kategori_id'),
            'isi' => $request->input('isi'),
            'petugas_id' => auth()->user()->id,
            'status' => (bool) $request->input('status'),
        ]);

        return redirect()->route('admin.post.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::query()->pluck('judul', 'id');
        $petugas = User::query()->pluck('name', 'id');
        return view('admin.post.form', compact('post', 'categories', 'petugas'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $post->update([
            'judul' => $request->input('judul'),
            'kategori_id' => $request->input('kategori_id'),
            'isi' => $request->input('isi'),
            'petugas_id' => auth()->user()->id,
            'status' => (bool) $request->input('status'),
        ]);

        return redirect()->route('admin.post.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.post.index')
            ->with('success', 'Post deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Post::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
