<?php

namespace App\Http\Controllers\Admin;

use App\Services\Upload\UploadManager;
use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Galery;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    protected $foto;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.foto.index')->only('index');
        $this->middleware('can:admin.foto.create')->only('create', 'store');
        $this->middleware('can:admin.foto.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.foto.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        return redirect()->route('admin.galery.index');
    }

    public function create()
    {
        $galeries = Galery::query()->pluck('id', 'id');
        return view('admin.foto.form', compact('galeries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'judul' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = UploadManager::default($request->file('file'), 'foto');
        }

        $foto = Foto::create([
            'galery_id' => $request->input('galery_id'),
            'judul' => $request->input('judul'),
            'file' => $path,
        ]);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto created successfully.');
    }

    public function edit(Foto $foto)
    {
        $galeries = Galery::query()->pluck('id', 'id');
        return view('admin.foto.form', compact('foto', 'galeries'));
    }

    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $data = [
            'galery_id' => $request->input('galery_id'),
            'judul' => $request->input('judul'),
        ];

        if ($request->hasFile('file')) {
            if ($foto->file) {
                UploadManager::defaultDelete($foto->file);
            }
            $data['file'] = UploadManager::default($request->file('file'), 'foto');
        }

        $foto->update($data);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto updated successfully.');
    }

    public function destroy(Foto $foto)
    {
        if ($foto->file) {
            UploadManager::defaultDelete($foto->file);
        }
        $foto->delete();

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Foto::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
