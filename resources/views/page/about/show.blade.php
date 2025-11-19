@extends('layout.page.layout')
@section('title', ($about->title ?? 'Tentang Kami'))

@push('styles')
<style>
.rich-content{max-width:800px;margin:0 auto;color:#1f2937}
.rich-content h1{font-size:2rem;line-height:1.25;margin:1rem 0;font-weight:700}
.rich-content h2{font-size:1.75rem;line-height:1.3;margin:1rem 0;font-weight:700}
.rich-content h3{font-size:1.5rem;line-height:1.35;margin:.75rem 0;font-weight:600}
.rich-content h4{font-size:1.25rem;line-height:1.4;margin:.75rem 0;font-weight:600}
.rich-content h5{font-size:1.125rem;line-height:1.45;margin:.5rem 0;font-weight:600}
.rich-content h6{font-size:1rem;line-height:1.5;margin:.5rem 0;font-weight:600}
.rich-content p{margin:.75rem 0}
.rich-content ul{list-style:disc;padding-left:1.25rem;margin:.75rem 0}
.rich-content ol{list-style:decimal;padding-left:1.25rem;margin:.75rem 0}
.rich-content li{margin:.25rem 0}
.rich-content blockquote{border-left:4px solid #6366f1;background:#f8fafc;padding:.75rem 1rem;margin:1rem 0;color:#374151}
.rich-content code{background:#f3f4f6;padding:.125rem .375rem;border-radius:.25rem;font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}
.rich-content pre{background:#0f172a;color:#e5e7eb;padding:1rem;border-radius:.5rem;overflow:auto;margin:1rem 0}
.rich-content pre code{background:transparent;padding:0}
.rich-content table{width:100%;border-collapse:collapse;margin:1rem 0}
.rich-content th,.rich-content td{border:1px solid #e5e7eb;padding:.5rem;text-align:left}
.rich-content thead th{background:#f3f4f6;font-weight:600}
.rich-content img{max-width:100%;height:auto;border-radius:.5rem}
.rich-content figure{margin:1rem 0;text-align:center}
.rich-content figcaption{font-size:.875rem;color:#6b7280;margin-top:.5rem}
.banner-wrap{background:linear-gradient(135deg,#eef2ff,#ffffff);padding:3rem 1rem;margin-bottom:2rem}
.banner-inner{max-width:1000px;margin:0 auto;display:flex;align-items:center;gap:1.5rem}
.banner-title{font-family:'Merriweather',serif;color:#0b1d51;font-weight:900;text-transform:uppercase;letter-spacing:.04em;font-size:1.75rem}
.banner-sub{color:#6b7280;font-size:.95rem}
</style>
@endpush

@section('content')
<section class="banner-wrap">
  <div class="banner-inner">
    <div>
      <div class="banner-title">{{ $about->judul ?? 'Tentang Kami' }}</div> 
      <div class="banner-sub">Profil, sejarah, visi misi, dan informasi resmi sekolah</div>
    </div>
  </div>
  </section>

<section class="px-4 sm:px-6 lg:px-8">
  <article class="rich-content">
    {!! $about->isi ?? '<h2>Selamat Datang</h2><p>Konten halaman ini disusun menggunakan CKEditor. Anda dapat menambahkan teks, gambar, tabel, kutipan, dan elemen lainnya.</p><h3>Visi</h3><p>Mencetak lulusan berkarakter dan berdaya saing global.</p><h3>Misi</h3><ul><li>Meningkatkan kualitas pembelajaran.</li><li>Mendorong kreativitas siswa.</li><li>Memperkuat kolaborasi dengan masyarakat.</li></ul><blockquote>"Pendidikan adalah paspor menuju masa depan."</blockquote><figure><img src="https://picsum.photos/960/540?random=55" alt="Ilustrasi"><figcaption>Ilustrasi kegiatan sekolah</figcaption></figure><table><thead><tr><th>Program</th><th>Deskripsi</th></tr></thead><tbody><tr><td>Ekstrakurikuler</td><td>Beragam pilihan minat dan bakat.</td></tr><tr><td>Beasiswa</td><td>Dukungan bagi siswa berprestasi.</td></tr></tbody></table><pre><code>code sample\nfunction hello(){\n  return \"world\";\n}\n</code></pre>' !!}
  </article>
</section>
@endsection
