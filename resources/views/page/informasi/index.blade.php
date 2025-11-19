
@extends('layout.page.layout')
@section('title', 'Gallery')

@section('content')
<section id="peta" class="py-20 bg-gradient-to-br from-indigo-50 via-white to-sky-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-wider uppercase"
                    style="font-family:'Merriweather', serif; color:#0b1d51;">Informasi Dan Agenda Sekolah</h2>
                <p class="mt-2 text-sm text-gray-600">Informasi dan agenda sekolah</p>
            </div>
        </div>

        @php
            $categoryMap = [];
            foreach($informasis as $inf){
                $categoryMap[$inf->kategori_id] = optional($inf->category)->judul ?? ('Kategori '.$inf->kategori_id);
            }
        @endphp

        <div id="categoryFilter" class="mb-6 flex flex-wrap gap-2">
            <button type="button" data-filter="all" class="filter-btn rounded-md border px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ring-2 ring-indigo-600 bg-indigo-50 text-indigo-700">Semua</button>
            @foreach($categoryMap as $catId => $catName)
                <button type="button" data-filter="{{ $catId }}" class="filter-btn rounded-md border px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $catName }}</button>
            @endforeach
        </div>

        {{-- Grid Layout --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($informasis as $item)
            <div class="rounded-xl border bg-white/80 p-6 shadow backdrop-blur info-card" data-category-id="{{ $item->kategori_id }}">
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
                <h3 class="text-xl font-semibold text-gray-900 break-words">{{ $item->judul }}</h3>
                <p class="mt-2 text-gray-700 break-words whitespace-normal">{!! nl2br(Str::limit($item->isi, 120)) !!}</p>
                <div class="mt-4">
                    <a href="{{ route('detail.show', $item->id) }}"
                        class="inline-flex items-center gap-2 rounded-md border border-indigo-600 px-4 py-2 text-indigo-700 hover:bg-indigo-50">Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
    const filterBar = document.getElementById('categoryFilter');
    if(!filterBar) return;
    const buttons = Array.from(filterBar.querySelectorAll('.filter-btn'));
    const cards = Array.from(document.querySelectorAll('.info-card'));
    function setActive(btn){
      buttons.forEach(b=>b.classList.remove('ring-2','ring-indigo-600','bg-indigo-50','text-indigo-700'));
      btn.classList.add('ring-2','ring-indigo-600','bg-indigo-50','text-indigo-700');
    }
    buttons.forEach(btn=>{
      btn.addEventListener('click', ()=>{
        const filter = btn.getAttribute('data-filter');
        setActive(btn);
        cards.forEach(card=>{
          const cid = card.getAttribute('data-category-id');
          if(filter === 'all' || filter === cid){
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      });
    });
  });
</script>
@endpush
@endsection