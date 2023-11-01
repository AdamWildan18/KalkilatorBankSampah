@extends('layouts.master')
@section('content')
    <div class="container mt-2">
        <h1>Data Daftar Sampah</h1>
        <div class="d-flex justify-content-end">
            <a href="/tambah-data" class="btn btn-primary">Tambah data</a>
        </div>
        @foreach ($data as $item)
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Sampah</th>
                    <th>Harga Perkilogaram</th>
                    <th>Deskripsi</th>
                    <th>foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->formattedHarga }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td><img src="{{ $item->foto }}" alt=""></td>
                    <td>
                        <a href="/edit-data/{{ $item->id }}" class="badge">
                            <button><i class="bi bi-pencil-square"></i></button>
                        </a>
                        <form action="/hapus-data/{{ $item->id }}" method="POST" class="badge">
                            @method('delete')
                            @csrf
                            <button><i class="bi bi-trash3"></i></button>
                        </form>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
@endsection
