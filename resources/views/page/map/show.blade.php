@extends('layout.page.layout')
@section('title', ($map->title ?? 'Peta Sekolah'))

@push('styles')
<style>
  .rich-content{max-width:1000px;margin:0 auto;color:#1f2937}
  .rich-content h1 {
    font-size: 2rem;
    line-height: 1.25;
    margin: 1rem 0;
    font-weight: 700
  }

  .rich-content h2 {
    font-size: 1.75rem;
    line-height: 1.3;
    margin: 1rem 0;
    font-weight: 700
  }

  .rich-content h3 {
    font-size: 1.5rem;
    line-height: 1.35;
    margin: .75rem 0;
    font-weight: 600
  }

  .rich-content h4 {
    font-size: 1.25rem;
    line-height: 1.4;
    margin: .75rem 0;
    font-weight: 600
  }

  .rich-content h5 {
    font-size: 1.125rem;
    line-height: 1.45;
    margin: .5rem 0;
    font-weight: 600
  }

  .rich-content h6 {
    font-size: 1rem;
    line-height: 1.5;
    margin: .5rem 0;
    font-weight: 600
  }

  .rich-content p {
    margin: .75rem 0
  }

  .rich-content ul {
    list-style: disc;
    padding-left: 1.25rem;
    margin: .75rem 0
  }

  .rich-content ol {
    list-style: decimal;
    padding-left: 1.25rem;
    margin: .75rem 0
  }

  .rich-content li {
    margin: .25rem 0
  }

  .rich-content blockquote {
    border-left: 4px solid #6366f1;
    background: #f8fafc;
    padding: .75rem 1rem;
    margin: 1rem 0;
    color: #374151
  }

  .rich-content code {
    background: #f3f4f6;
    padding: .125rem .375rem;
    border-radius: .25rem;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
  }

  .rich-content pre {
    background: #0f172a;
    color: #e5e7eb;
    padding: 1rem;
    border-radius: .5rem;
    overflow: auto;
    margin: 1rem 0
  }

  .rich-content pre code {
    background: transparent;
    padding: 0
  }

  .rich-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0
  }

  .rich-content th,
  .rich-content td {
    border: 1px solid #e5e7eb;
    padding: .5rem;
    text-align: left
  }

  .rich-content thead th {
    background: #f3f4f6;
    font-weight: 600
  }

  .rich-content img {
    max-width: 100%;
    height: auto;
    border-radius: .5rem
  }

  .rich-content figure {
    margin: 1rem 0;
    text-align: center
  }

  .rich-content figcaption {
    font-size: .875rem;
    color: #6b7280;
    margin-top: .5rem
  }

  .banner-wrap {
    background: linear-gradient(135deg, #eef2ff, #ffffff);
    padding: 3rem 1rem;
    margin-bottom: 2rem
  }

  .banner-inner {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 1.5rem
  }

  .banner-title {
    font-family: 'Merriweather', serif;
    color: #0b1d51;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .04em;
    font-size: 1.75rem
  }

  .banner-sub {
    color: #6b7280;
    font-size: .95rem
  }
</style>
@endpush

@section('content')
<section class="banner-wrap">
  <div class="banner-inner">
    <div>
      <div class="banner-title">{{ $maps->judul ?? 'Peta Sekolah' }}</div>

    </div>
  </div>
</section>

<section class="px-4 sm:px-6 lg:px-8">
  <article class="rich-content">
    <div class="banner-sub">{!! $maps->isi ?? 'Overview area kampus dan fasilitas utama' !!}</div>
  </article>

  <div>
    @if(!empty($maps->gallery))
    @foreach ($maps->gallery as $album)
    <div class="mb-8">
      <h3 class="text-xl font-semibold mb-4">{{ $album->nama ?? 'Album' }}</h3>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @if(!empty($album->fotos))
        @foreach (collect($album->fotos)->take(3) as $image)
        <button type="button" class="group rounded-lg overflow-hidden shadow hover:shadow-xl transition"
          onclick="openImageModal(this)" data-image="{{ asset('storage/'.$image->file) }}" aria-label="Lihat gambar">
          <div class="relative">
            <img src="{{ asset('storage/'.$image->file) }}" alt="{{ $image->judul ?? 'Foto' }}"
              class="w-full h-64 object-cover" />
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
          </div>
          <!-- Tambahan judul di bawah gambar -->
          <div class="p-2 bg-white text-center text-sm font-medium text-gray-700">
            {{ $image->judul ?? 'Foto' }}
          </div>
        </button>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
    @endif
  </div>
</section>
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4">
  <div class="relative max-w-4xl w-full">
    <button type="button" class="absolute -top-3 -right-3 rounded-full bg-white p-2 shadow" onclick="closeImageModal()"
      aria-label="Tutup">
      ✕
    </button>
    <img id="modalImage" src="" alt="Preview" class="max-h-[80vh] w-full rounded shadow object-contain bg-white" />
  </div>
  <button type="button" class="absolute inset-0 -z-10" onclick="closeImageModal()" aria-label="Tutup"></button>
</div>
@push('scripts')
<script>
  function openImageModal(el){
    const src = el.getAttribute('data-image');
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');
    if(src && modal && img){
      img.src = src;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  }
  function closeImageModal(){
    const modal = document.getElementById('imageModal');
    if(modal){
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      const img = document.getElementById('modalImage');
      if(img){ img.src = ''; }
    }
  }
</script>
@endpush
@endsection