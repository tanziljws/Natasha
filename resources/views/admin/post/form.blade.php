@extends('layout.admin.layout')

@php
$routeBase = 'admin.post';
$model = isset($post) ? $post : null;

$title = $model ? 'Change' : 'Create';
$subTitle = $title;
@endphp

@section('title', $title)

@section('content')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card mt-24">
            <div class="card-body p-24">
                <form id="form"
                    action="{{ $model ? route($routeBase  . '.update', $model->id) : route($routeBase . '.store') }}"
                    method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-20">

                    @csrf
                    @if($model)
                        @method('PUT')
                    @endif

                    <x-admin.form-input label="Judul" name="judul" type="text" 
                        value="{{ $model->judul ?? '' }}" placeholder="Masukkan judul" />

                    <x-admin.form-input label="Kategori" name="kategori_id" type="select"
                        :options="$categories ?? []" value="{{ $model->kategori_id ?? '' }}" />

                    <x-admin.form-input label="Isi" name="isi" type="ckeditor"
                        value="{{ $model->isi ?? '' }}" placeholder="Masukkan konten" />


                    <x-admin.form-input label="Status" name="status" type="radio"
                        :options="[1 => 'Aktif', 0 => 'Nonaktif']" value="{{ $model->status ?? 0 }}" />

                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <a href="{{ route($routeBase . '.index') }}"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">Back</a>
                        <button id="submit" type="submit"
                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                            {{ $title }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
