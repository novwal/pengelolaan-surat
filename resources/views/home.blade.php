@extends('layouts.template')

@section('content')
@if (Session::get('success'))
    <div class="alert alert-success w-25 p-3 mt-0 mb-0" role="alert">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
<div class="jumbotron py-4 px-5">
    <h1 class="display-4">
        Selamat Datang, {{ Auth::user()->name }}!
    </h1>
    <hr class="my-4">
     <p>Aplikasi ini digunakan hanya oleh pegawai, staff dan guru. Digunakan untuk mengelola Surat.</p>
    @php
        $userData = Auth::user();
    @endphp

    @if ($userData->role == "staff")
        @php
            $cards = [
                ['title' => 'Surat Keluar', 'model' => App\Models\Letter::class],
                ['title' => 'Klasifikasi Surat', 'model' => App\Models\Letter_type::class],
                ['title' => 'Staff Tata Usaha', 'model' => App\Models\User::class, 'condition' => ['role' => 'staff']],
                ['title' => 'Guru', 'model' => App\Models\User::class, 'condition' => ['role' => 'guru']],
            ];
        @endphp

        <div class="row">
            @foreach ($cards as $card)
                <div class="col-sm-6 mb-2 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $card['title'] }}</h5>
                            <p class="card-text">{{ count($card['condition'] ? $card['model']::where($card['condition'])->get() : $card['model']::all()) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($userData->role == 'guru')
        <div class="row">
            <div class="col-sm-6 mb-2 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Surat Masuk</h5>
                        <p class="card-text">{{ count(App\Models\Letter::all()) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
