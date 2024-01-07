@extends('layouts.template')

@section('content')
    <h3 class="display-10">Tambah Data Surat</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dataSurat.home') }}">Data Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Surat</li>
        </ol>
    </nav>

    <form action="{{ route('dataSurat.store') }}" method="post" class="card p-5">
        @csrf

        @include('partials.alerts')

        <div class="mb-3 row">
            <label for="letter_perihal" class="col-sm-2 col-form-label">Perihal</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="letter_perihal" name="letter_perihal">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat:</label>
            <div class="col-sm-10">
                <x-select :options="$letter" name="letter_type_id" id="klasifikasi" label="name_type" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="letter_perihal" class="col-sm-2 col-form-label">Isi Surat</label>
            <div class="col-sm-10">
                <textarea name="content" class="form-control"></textarea>
            </div>
        </div>

        <x-table :items="$user" :fields="['name', 'id']" />

        <div class="mb-3">
            <x-file-input label="Lampiran" id="formFile" name="attachment" />
        </div>

        <div class="mb-3">
            <x-select :options="$user" name="notulis" id="klasifikasi" label="name" />
        </div>

        <x-submit-button label="Tambah" />
    </form>
@endsection
