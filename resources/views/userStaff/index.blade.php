@extends('layouts.template')

@section('content')
    <h3 class="display-10">
        Data Staff Tata Usaha
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Staff Tata Usaha</li>
        </ol>
    </nav>
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('userStaff.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($users as $item)
                    @if ($item['role'] == 'staff')
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['role'] }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('userStaff.edit', $item->id)}}" class="btn btn-primary me-3">Edit</a>
                                <form action="{{ route('userStaff.delete', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        {{-- <div class="d-flex justify-content-end"> --}}
            {{-- jjika data ada atau > 0 --}}
            {{-- @if ( $users->count()) --}}
            {{-- munculkan tampilann pagination --}}
                {{-- {{ $users->links() }}
            @endif
        </div> --}}
    </div>
@endsection