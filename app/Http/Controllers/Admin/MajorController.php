<?php

namespace App\Http\Controllers\Admin;

use App\Services\Upload\UploadManager;
use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    protected $major;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.major.index')->only('index');
        $this->middleware('can:admin.major.create')->only('create', 'store');
        $this->middleware('can:admin.major.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.major.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Major::query();

        if ($request->filled('search')) {
            // tambahkan kondisi pencarian sesuai kebutuhan
            $query->where('title', 'like', '%' . $request->search . '%');
            $query->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $items = $query->latest()->paginate($perPage)->appends($request->all());

        return view('admin.major.index', compact('items'));
    }

    public function create()
    {
        return view('admin.major.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        $major = new Major();
        $major->title = $request->input('title');
        $major->description = $request->input('description');

        if ($request->hasFile('image')) {
            $major->image = UploadManager::default($request->file('image'), 'major');
        }

        // isi kolom sesuai kebutuhan
        $major->save();

        return redirect()->route('admin.major.index')
            ->with('success', 'Major created successfully.');
    }

    public function edit(Major $major)
    {
        return view('admin.major.form', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        $major->title = $request->input('title');
        $major->description = $request->input('description');

        if ($request->hasFile('image')) {
            if ($major->image) {
                UploadManager::defaultDelete($major->image);
            }
            $major->image = UploadManager::default($request->file('image'), 'major');
        }

        // isi kolom sesuai kebutuhan
        $major->save();

        return redirect()->route('admin.major.index')
            ->with('success', 'Major updated successfully.');
    }

    public function destroy(Major $major)
    {
        if ($major->image) {
            UploadManager::defaultDelete($major->image);
        }
        $major->delete();

        return redirect()->route('admin.major.index')
            ->with('success', 'Major deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Major::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
