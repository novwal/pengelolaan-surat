@extends('layouts.template')

@section('content')
    <form action="{{ route('KlasifikasiSurat.update', $letterType->id) }}" method="post" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="letter_code" name="letter_code" value="{{ $letterType->letter_code }}" disabled>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name_type" name="name_type" value="{{ $letterType->name_type }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah data</button>
    </form>
@endsection
