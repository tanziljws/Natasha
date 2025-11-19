<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.category.index')->only('index');
        $this->middleware('can:admin.category.create')->only('create', 'store');
        $this->middleware('can:admin.category.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.category.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
            $query->where('type', $request->type);
        }

        $perPage = $request->input('per_page', 10);
        $items = $query->paginate($perPage)->appends($request->all());

        return view('admin.category.index', compact('items'));
    }

    public function create()
    {
        return view('admin.category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'type' => 'required|integer|in:1,2,3,4',
        ]);

        Category::create([
            'judul' => $request->input('judul'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'type' => 'required|integer|in:1,2,3,4',
        ]);

        $category->update([
            'judul' => $request->input('judul'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Category::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
