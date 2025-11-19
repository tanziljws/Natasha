
@extends('layout.page.layout')
@section('title', 'Maps')

@section('content')
<section id="peta" class="py-20 bg-gradient-to-br from-indigo-50 via-white to-sky-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-wider uppercase"
                    style="font-family:'Merriweather', serif; color:#0b1d51;">Peta Sekolah</h2>
                <p class="mt-2 text-sm text-gray-600">Orientasi area kampus dan fasilitas utama</p>
            </div>
        </div>

        {{-- Grid Layout --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($maps as $item)
            <div class="rounded-xl border bg-white/80 p-6 shadow backdrop-blur">
                {{-- Gambar --}}
                <div class="mb-4">
                    @if(isset($item->gallery[0]) && isset($item->gallery[0]->fotos[0]) && isset($item->gallery[0]->fotos[0]->file[0]))
                    <img src="{{ asset('storage/'.$item->gallery[0]->fotos[0]->file) }}"
                        class="h-48 w-full rounded-xl object-cover shadow" alt="Gedung Utama">
                    @else
                    <img src="https://placehold.co/1200x800?text=Gambar+Tidak+Ada" 
                        class="h-48 w-full rounded-xl object-cover shadow" alt="Gambar Tidak Ada">
                    @endif
                </div>

                {{-- Konten --}}
                <h3 class="text-xl font-semibold text-gray-900">{{ $item->judul }}</h3>
                <p class="mt-2 text-gray-700">{!! nl2br(Str::limit($item->isi, 120)) !!}</p>
                <div class="mt-4">
                    <a href="{{ route('detail.show', $item->id) }}"
                        class="inline-flex items-center gap-2 rounded-md border border-indigo-600 px-4 py-2 text-indigo-700 hover:bg-indigo-50">Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection