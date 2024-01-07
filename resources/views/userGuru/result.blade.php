@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="h3 mb-4">Hasil Rapat</div>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dataSurat.home') }}">Data Surat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Hasil Rapat</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('result.store') }}" method="POST">
                    @csrf
                    <div class="h5 mb-3">Hasil Rapat : {{ $letters->letter_perihal }}</div>

                    <div class="mb-3">
                        <label for="letter_id" class="form-label">ID Surat</label>
                        <input type="text" class="form-control w-25" value="{{ $letters->id }}" name="letter_id" readonly>
                    </div>

                    <div class="h6">Peserta Yang Hadir</div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="flexCheckChecked" name="presence_recipients[]">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="h6">Ringkasan:</div>
                    <div class="mb-3">
                        <textarea class="form-control" name="notes"></textarea>
                    </div>

                    <button type="submit" class="btn btn-info text-white">Tambah Hasil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
