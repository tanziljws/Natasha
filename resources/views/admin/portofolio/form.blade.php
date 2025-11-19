@extends('layout.admin.layout')

@php
$routeBase = 'admin.portofolio';
$model = isset($portofolio) ? $portofolio : null;

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

                    <!-- Example fields kosong -->
                    <x-admin.form-input label="Title" name="title" type="text" 
                        value="{{ $model->title ?? '' }}" placeholder="Enter title" />

                           <x-admin.form-input label="Image" name="image" type="file" 
                        value="{{ $model->image ?? '' }}" placeholder="Upload image" />

                    <x-admin.form-input label="Bidang Pekerjaan" name="bidang_pekerjaan" type="text"
                        value="{{ $model->bidang_pekerjaan ?? '' }}" placeholder="Enter bidang pekerjaan" />

                    <x-admin.form-input label="Sub Bidang Pekerjaan" name="sub_bidang_pekerjaan" type="text"
                        value="{{ $model->sub_bidang_pekerjaan ?? '' }}" placeholder="Enter sub bidang pekerjaan" />

                    <x-admin.form-input label="Location" name="location" type="text"
                        value="{{ $model->location ?? '' }}" placeholder="Enter location" />

                    <x-admin.form-input label="Client Name" name="client_name" type="text"
                        value="{{ $model->client_name ?? '' }}" placeholder="Enter client name" />

                    <x-admin.form-input label="Client Address" name="client_address" type="textarea"
                        value="{{ $model->client_address ?? '' }}" placeholder="Enter client address" />

                    <x-admin.form-input label="Contract No & Date" name="contract_no_date" type="text"
                        value="{{ $model->contract_no_date ?? '' }}" placeholder="Enter contract no & date" />

                    <x-admin.form-input label="Contact Value" name="contact_value" type="number"
                        value="{{ $model->contact_value ?? '' }}" placeholder="Enter contact value" />

                    <x-admin.form-input label="End Date by Contact" name="end_date_by_contact" type="text"
                        value="{{ $model->end_date_by_contact ?? '' }}" placeholder="Enter end date by contact" />

                    <x-admin.form-input label="End Date by BA Lap Akhir" name="end_date_by_ba_lap_akhir" type="text"
                        value="{{ $model->end_date_by_ba_lap_akhir ?? '' }}" placeholder="Enter end date by BA lap akhir" />

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
