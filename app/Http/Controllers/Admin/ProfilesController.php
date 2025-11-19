<?php

namespace App\Http\Controllers\Admin;

use App\Services\Upload\UploadManager;
use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    protected $profiles;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.profiles.index')->only('index');
        $this->middleware('can:admin.profiles.create')->only('create', 'store');
        $this->middleware('can:admin.profiles.edit')->only('edit', 'update', 'sort');
        $this->middleware('can:admin.profiles.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Profiles::query();

        if ($request->filled('search')) {
            // tambahkan kondisi pencarian sesuai kebutuhan
            $query->where('judul', 'like', '%' . $request->search . '%');
            $query->orWhere('isi', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $items = $query->latest()->paginate($perPage)->appends($request->all());

        return view('admin.profiles.index', compact('items'));
    }

    public function create()
    {
        return view('admin.profiles.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'nullable|string',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        $profiles = new Profiles();
        $profiles->judul = $request->input('judul');
        $profiles->isi = $request->input('isi');

        // isi kolom sesuai kebutuhan
        $profiles->save();

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profiles created successfully.');
    }

    public function edit(Profiles $profiles)
    {
        return view('admin.profiles.form', compact('profiles'));
    }

    public function update(Request $request, Profiles $profiles)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'nullable|string',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        $profiles->judul = $request->input('judul');
        $profiles->isi = $request->input('isi');



        // isi kolom sesuai kebutuhan
        $profiles->save();

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profiles updated successfully.');
    }

    public function destroy(Profiles $profiles)
    {
        $profiles->delete();

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profiles deleted successfully.');
    }

    // public function updateOrder(Request $request)
    // {
    //     try {
    //         foreach ($request->order as $item) {
    //             Profiles::where('id', $item['id'])->update(['order' => $item['order']]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }
}
