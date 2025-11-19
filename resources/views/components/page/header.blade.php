<header class="sticky top-0 z-50 bg-white/80 backdrop-blur">
  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-20 items-center justify-between">
      <div class="flex items-center gap-4">
        <a href="{{ route('home.index') }}" class="flex items-center gap-4">
          <span class="inline-flex h-12 w-12 items-center justify-center rounded-full ring-2 ring-indigo-900/30">
            <img src="{{ asset('storage/'.ui_value('web-setting','logo')) }}" alt="logo" class="h-10 w-10">
          </span>
          <span class="text-2xl font-black tra  cking-wider uppercase" style="font-family:'Merriweather', serif; color:#0b1d51;">{{ ui_value('web-setting','title') }}</span>
        </a>
      </div>
      <div class="hidden md:flex items-center gap-1">
        <a href="{{ route('home.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-800 hover:text-indigo-900 rounded transition relative group">
          <span>Home</span>
          <span class="absolute left-1/2 top-full block h-0.5 w-0 bg-indigo-900 transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
        </a>
        <div class="relative group">
          <button type="button" id="desktopProfileBtn" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-gray-800 hover:text-indigo-900 rounded transition" aria-haspopup="true" aria-expanded="false">
            <span>Profile</span>
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z"/></svg>
          </button>
          <span class="absolute left-0 right-0 top-full block h-2"></span>
          <div id="desktopProfileMenu" class="absolute right-0 top-full w-64 rounded-md border bg-white shadow-2xl hidden group-hover:block">
            <div class="grid grid-cols-1">
                @php
                    $hProfile = App\Models\Profiles::get();
                @endphp
                @foreach ($hProfile as $item)
                <a href="{{ route('about.show', $item->id) }}" class="px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">{{ $item->judul }}</a>
                @endforeach
            
            </div>
          </div>
        </div>
        <a href="{{ route('gallery.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-800 hover:text-indigo-900 rounded transition relative group"><span>Gallery</span><span class="absolute left-1/2 top-full block h-0.5 w-0 bg-indigo-900 transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
        <a href="{{ route('informasi.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-800 hover:text-indigo-900 rounded transition relative group"><span>Agenda & Informasi</span><span class="absolute left-1/2 top-full block h-0.5 w-0 bg-indigo-900 transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
        <a href="{{ route('map.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-800 hover:text-indigo-900 rounded transition relative group"><span>Peta Sekolah</span><span class="absolute left-1/2 top-full block h-0.5 w-0 bg-indigo-900 transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
      </div>
      <div class="md:hidden">
        <button id="mobileMenuBtn" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
  </nav>
  <div id="mobileMenu" class="md:hidden hidden border-t bg-white/95">
    <div class="space-y-1 px-4 py-3">
      <a href="{{ route('home.index') }}" class="block rounded px-3 py-2 text-gray-700 hover:bg-gray-100">Home</a>
      <div>
        <button type="button" id="mobileProfileBtn" class="flex w-full items-center justify-between rounded px-3 py-2 text-gray-700 hover:bg-gray-100">
          <span>Profile</span>
          <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z"/></svg>
        </button>
        <div id="mobileProfileMenu" class="hidden space-y-1 pl-3">
             @foreach ($hProfile as $item)
                <a href="{{ route('about.show', $item->id) }}" class="px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">{{ $item->judul }}</a>
                @endforeach
        </div>
      </div>
      <a href="{{ route('gallery.index') }}" class="block rounded px-3 py-2 text-gray-700 hover:bg-gray-100">Gallery</a>
    
      <a href="{{ route('informasi.index') }}" class="block rounded px-3 py-2 text-gray-700 hover:bg-gray-100">Informasi & Agenda</a>
      <a href="{{ route('map.index') }}" class="block rounded px-3 py-2 text-gray-700 hover:bg-gray-100">Peta Sekolah</a>
    </div>
  </div>
 </header>
 <script>
   document.addEventListener('DOMContentLoaded', function () {
     const btn = document.getElementById('mobileMenuBtn');
     const menu = document.getElementById('mobileMenu');
     const mBtn = document.getElementById('mobileProfileBtn');
     const mMenu = document.getElementById('mobileProfileMenu');
      const dBtn = document.getElementById('desktopProfileBtn');
      const dMenu = document.getElementById('desktopProfileMenu');
      if (btn && menu) { btn.addEventListener('click', () => { menu.classList.toggle('hidden'); }); }
      if (mBtn && mMenu) { mBtn.addEventListener('click', () => { mMenu.classList.toggle('hidden'); }); }
      if (dBtn && dMenu) { dBtn.addEventListener('click', (e) => { e.preventDefault(); dMenu.classList.toggle('hidden'); }); }
   });
 </script>