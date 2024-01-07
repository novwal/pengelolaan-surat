@extends('layouts.template')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dataSurat.home') }}">Daftar Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Rapat</li>
        </ol>
    </nav>

    <div class="card mb-5">
        <div class="card-body">
            <div id="button-wrap">
                <a href="{{ route('dataSurat.home') }}" class="btn-back">Kembali</a>
                <a href="{{ route('export.download', $surat['id']) }}" class="btn-print">Cetak (.pdf)</a>
            </div>

            <div class="form">
                <h1>SMK WIKRAMA BOGOR</h1>

                <div class="box">
                    <div class="department">
                        <p>Teknologi Informasi dan Komunikasi</p>
                        <p>Bisnis dan Manajemen</p>
                        <p>Pariwisata</p>
                    </div>

                    <div class="information">
                        <p>Jl. Raya Wangun Kel. Sindangsari Bogor</p>
                        <p>Telp:  (031)99787059</p>
                        <p>E-mail: prohumasi@smkwikrama.sch.id</p>
                        <p>Website: www.smkmikrama.sch.id</p>
                    </div>
                </div>
                <hr>

                <div class="date">
                    {{ $surat->created_at->format('d-m-Y') }}
                </div>

                <div class="box">
                    <div class="information2">
                        <p>No : 260062/0002/SMK Wikrama/2023</p>
                        <p>Hal : {{ $surat->letter_perihal }}</p>
                    </div>

                    <div class="department2">
                        <p>Kepada</p>
                        <p>Yth. Bapak/Ibu Terlampir</p>
                        <p>Tempat</p>
                    </div>
                </div>

                <div class="content">
                    {{ $surat->content }}
                </div>

                <div class="user">
                    <p>Bapak/ibu yang Menghadiri: </p>
                    <ol>
                        <li>{{ implode(', ', array_column($surat->recipients, 'name')) }}</li>
                    </ol>
                </div>

                <div class="respect">
                    <p>Hormat Kami</p>
                    <p>Kepala SMK Wikrama Bogor</p>
                </div>

                <div class="signature">
                    (........................)
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="h5 mb-3">Hasil Rapat: {{ $surat->letter_perihal }}</div>

                <input type="text" class="form-control w-25 mb-3" value="" name="letter_id">

                <div class="h6">Peserta Yang Hadir</div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Nama</th>
                    </tr>
                    <tr>
                        <td>{{ implode(', ', array_column($result->presence_recipients, 'name')) }}</td>
                    </tr>
                </table>

                <div class="h6">Ringkasan:</div>
                <div class="mb-3">
                    <textarea class="form-control" name="notes">{{ $result->notes }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
