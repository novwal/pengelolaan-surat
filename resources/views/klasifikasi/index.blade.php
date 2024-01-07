@extends('layouts.template')

@section('content')
    @include('partials.alert', ['key' => 'deleted'])
    @include('partials.alert', ['key' => 'success'])

    <h3 class="display-10">Data Klasifikasi Surat</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Klasifikasi Surat</li>
        </ol>
    </nav>

    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('KlasifikasiSurat.create') }}" class="btn btn-primary me-2">Tambah Data</a>
            <a href="{{ route('export.export-excel') }}" class="btn btn-info me-2">Export Klasifikasi Surat</a>
        </div>

        <form action="" method="GET" class="form-inline my-2 my-lg-2 d-flex">
            <input class="form-control w-25 h-25 mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="Search">
            &nbsp;<button class="btn btn-outline-primary my-0 my-sm-10" type="submit">Cari data</button>
        </form>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Kode Surat</th>
                    <th>Klasifikasi Surat</th>
                    <th>Surat Tertaut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($letterType as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->letter_code }}</td>
                        <td>{{ $item->name_type }}</td>
                        <td>{{ App\Models\Letter::where('letter_type_id', $item->id)->count() }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{-- route('') --}}" class="btn btn-info me-3">Lihat</a>
                            <a href="{{ route('KlasifikasiSurat.edit', $item->id) }}" class="btn btn-primary me-3">Edit</a>
                            <form action="{{ route('KlasifikasiSurat.delete', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
