@extends('layout.page.layout')
@section('title', 'Beranda')

@push('styles')
<style>
    .hero-banner {
        background-size: cover;
        background-position: center
    }
</style>
@endpush

@section('content')
<section class="hero-banner w-full">
    <div class="h-full w-full bg-black/40">

        @php
        $videoId = ui_value('banner','yt_embed_id');
        $baseUrl = 'https://www.youtube.com/embed/' . $videoId;
        $params = 'autoplay=1&mute=1&loop=1&controls=0&color=white&modestbranding=1&rel=0&playsinline=1&enablejsapi=1';
        $finalSrc = $baseUrl . '?' . $params . '&playlist=' . $videoId;
        @endphp

        <!--Start Slider One Single-->
        <div class="yt-embed-holder h-100" style="padding: 0px">
            <iframe width="100%" height="100%" src="{{ $finalSrc }}" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

    </div>
</section>
@push('styles')
<style>
    .yt-embed-holder {
        width: 100%;
        overflow: hidden;
        aspect-ratio: 16/9;
        pointer-events: none;
    }

    .yt-embed-holder iframe {
        width: 300%;
        height: 100%;
        margin-left: -100%;
    }
</style>
@endpush

<section id="about-us" class="py-20 bg-gradient-to-br from-white via-gray-50 to-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">
            <!-- Teks di kiri -->
            <div class="order-1 md:order-1">
                <h2 class="text-3xl font-black tracking-wider uppercase text-gray-900"
                    style="font-family:'Merriweather', serif;">{{ ui_value('about','title') }}</h2>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    {{ ui_value('about','description') }}
                </p>
            </div>
            <!-- Gambar di kanan -->
            <div class="order-2 md:order-2">
                <img src="{{ asset('storage/'.ui_value('about','image')) }}"
                    class="w-full rounded-xl object-cover shadow-lg" alt="Tentang Kami">
            </div>
        </div>
    </div>
</section>


<section id="quick-links" class="py-16 bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4">
            @foreach($majors as $major)
            <div class="rounded-xl bg-gray-800 p-6 text-white shadow-lg">
                <div class="mb-2 flex items-center gap-3">
                    <img src="{{ asset('storage/'.$major->image) }}" class="h-10 w-10 rounded object-cover"
                        alt="Icon Link 1">
                    <h3 class="text-lg font-semibold">{{ $major->title }}</h3>
                </div>
                <p class="text-sm text-gray-300">{{ $major->description }}</p>
            </div>
            @endforeach

        </div>
    </div>
</section>

<section id="gallery" class="py-16 bg-gradient-to-br from-sky-50 via-white to-indigo-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Galeri Sekolah</h2>
                <p class="mt-2 text-sm text-gray-600">Dokumentasi kegiatan terbaru dan unggulan</p>
            </div>
        </div>

        <div class="relative">
            <div class="gallery-swiper swiper">
                <div class="swiper-wrapper">
                    @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <div class="grid gap-6 md:grid-cols-5">
                            @if(isset($item->fotos[0]) && isset($item->fotos[0]->file))
                            <img src="{{ asset('storage/'.$item->fotos[0]->file) }}"
                                class="md:col-span-3 h-80 w-full rounded-xl object-cover md:h-[28rem] shadow"
                                alt="{{ $item->judul }}">
                            @else
                            <img src="https://placehold.co/1200x800?text=Gambar+Tidak+Ada"
                                class="md:col-span-3 h-80 w-full rounded-xl object-cover md:h-[28rem] shadow"
                                alt="Gambar Tidak Ada">
                            @endif
                            <div class="md:col-span-2 flex items-center">
                                <div class="w-full rounded-xl border bg-white/80 p-6 shadow backdrop-blur">
                                    <h3 class="text-2xl font-semibold text-gray-900">{{ $item->judul }}</h3>
                                    <p class="mt-3 text-gray-700">{!! Str::limit($item->isi, 160) !!}</p>
                                    <div class="mt-4">
                                        <a href="{{ route('detail.show', $item->id) }}"
                                            class="inline-flex items-center gap-2 rounded-md border border-indigo-600 px-4 py-2 text-indigo-700 hover:bg-indigo-50">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="gallery-pagination mt-6"></div>
            </div>

            <div class="gallery-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 hidden md:block">
                <button
                    class="rounded-full bg-white/80 backdrop-blur p-3 shadow-lg ring-1 ring-gray-200 hover:bg-white">◀</button>
            </div>
            <div class="gallery-next absolute right-0 top-1/2 -translate-y-1/2 z-10 hidden md:block">
                <button
                    class="rounded-full bg-white/80 backdrop-blur p-3 shadow-lg ring-1 ring-gray-200 hover:bg-white">▶</button>
            </div>
        </div>
    </div>
</section>

<section id="agenda-informasi" class="py-20 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h2 class="text-3xl font-black tracking-wider uppercase text-white"
                style="font-family:'Merriweather', serif;">Agenda & Informasi</h2>
            <p class="mt-2 text-sm text-slate-300">Rangkuman kegiatan dan kabar terbaru sekolah</p>
        </div>
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <div id="agenda" class="rounded-xl border border-white/20 bg-white/90 p-6 shadow backdrop-blur">
                <h3 class="mb-6 text-2xl font-semibold text-gray-900">Agenda Sekolah</h3>
                <div class="relative">
                    <div class="border-l-2 border-indigo-600 pl-6 space-y-6">
                        @forelse(($agenda ?? []) as $ag)
                        <div class="relative cursor-pointer">
                            <div class="flex items-start justify-between">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $ag->judul }}</h4>
                            </div>
                            <p class="mt-2 text-gray-700">{!! Str::limit($ag->isi, 110) !!}</p>
                            <a href="{{ route('detail.show', $ag->id) }}" class="absolute inset-0" aria-label="Lihat detail agenda"></a>
                        </div>
                        @empty
                        <div class="text-gray-600">Belum ada agenda.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div id="informasi" class="rounded-xl border border-white/20 bg-white/90 p-6 shadow backdrop-blur">
                <h3 class="mb-6 text-2xl font-semibold text-gray-900">Informasi Terkini</h3>
                <div class="grid grid-cols-1 gap-6">
                    @forelse(($informasi ?? []) as $info)
                    @php
                        $gal = \App\Models\Galery::with('fotos')->where('post_id', $info->id)->first();
                        $img = ($gal && isset($gal->fotos[0])) ? asset('storage/'.$gal->fotos[0]->file) : 'https://placehold.co/400x280?text=Gambar';
                    @endphp
                    <article class="group relative cursor-pointer overflow-hidden rounded-xl border bg-white shadow">
                        <div class="flex items-start gap-4">
                            <img src="{{ $img }}" class="h-24 w-36 rounded-lg object-cover shadow" alt="{{ $info->judul }}">
                            <div class="flex-1 p-1">
                                <h4 class="text-lg font-medium text-gray-900">{{ $info->judul }}</h4>
                                <p class="mt-1 text-gray-700">{!! Str::limit($info->isi, 90) !!}</p>
                            </div>
                        </div>
                        <a href="{{ route('detail.show', $info->id) }}" class="absolute inset-0" aria-label="Lihat detail informasi"></a>
                    </article>
                    @empty
                    <div class="text-gray-600">Belum ada informasi.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>





<section id="peta" class="py-20 bg-gradient-to-br from-indigo-50 via-white to-sky-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-wider uppercase"
                    style="font-family:'Merriweather', serif; color:#0b1d51;">Peta Sekolah</h2>
                <p class="mt-2 text-sm text-gray-600">Orientasi area kampus dan fasilitas utama</p>
            </div>
        </div>
        <div class="relative">
            <div class="map-swiper swiper">
                <div class="swiper-wrapper">
                    @foreach ($maps as $item)
                    <div class="swiper-slide">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div class="md:col-span-1 flex items-center">
                                <div class="w-full rounded-xl border bg-white/80 p-6 shadow backdrop-blur">
                                    <h3 class="text-2xl font-semibold text-gray-900">{{ $item->judul }}</h3>
                                    <p class="mt-3 text-gray-700">{!! nl2br(Str::limit($item->isi, 160)) !!}</p>
                                    <div class="mt-4">
                                        <a href="{{ route('detail.show', $item->id) }}"
                                            class="inline-flex items-center gap-2 rounded-md border border-indigo-600 px-4 py-2 text-indigo-700 hover:bg-indigo-50">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-2">

                                @if(isset($item->gallery[0]) && isset($item->gallery[0]->fotos[0]) &&
                                isset($item->gallery[0]->fotos[0]->file[0]))
                                <img src="{{ asset('storage/'.$item->gallery[0]->fotos[0]->file) }}"
                                    class="h-80 w-full rounded-xl object-cover md:h-[28rem] shadow" alt="Gedung Utama">
                                @else
                                <img src="https://placehold.co/1200x800?text=Gambar+Tidak+Ada"
                                    class="h-80 w-full rounded-xl object-cover md:h-[28rem] shadow"
                                    alt="Gambar Tidak Ada">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="map-pagination mt-6"></div>
            </div>
            <div class="map-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 hidden md:block">
                <button
                    class="rounded-full bg-white/80 backdrop-blur p-3 shadow-lg ring-1 ring-gray-200 hover:bg-white">◀</button>
            </div>
            <div class="map-next absolute right-0 top-1/2 -translate-y-1/2 z-10 hidden md:block">
                <button
                    class="rounded-full bg-white/80 backdrop-blur p-3 shadow-lg ring-1 ring-gray-200 hover:bg-white">▶</button>
            </div>
        </div>
    </div>
</section>

@endsection