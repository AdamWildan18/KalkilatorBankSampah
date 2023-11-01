@extends('layouts.master')
@section('content')
    <div class="container mt-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Tambah Daftar Sampah</h1>
        <form action="/update-data/{{ $id }}" class="form" method="POST" enctype="multipart/form-data"> 
            @csrf
            <table class="table mt-4" id="data-table">
                <tbody>
                    <tr>
                        <th>Jenis Sampah</th>
                        <td>
                            <input type="text" name="name" value="{{ $data->name }}" placeholder="masukan Jenis Sampah" class=" form-control form-control-sm">
                        </td>
                    </tr>
                   
                    <tr>
                        <th>Harga PerKilogram</th>
                        <td>
                            <input type="text" name="harga" value="{{ $data->harga }}" placeholder="Masukan Harga" class=" form-control form-control-sm" oninput="validatePrice(this)">
                        </td>
                    </tr>
                    <tr>
                        
                        <th>Foto</th>
                        <td>
                            <input type="file" name="foto" value="{{ $data->foto }}" placeholder="Masukan Foto" class=" form-control form-control-sm">
                        </td>
                    </tr>
                     <tr>
                        <th>Deskripsi</th>
                        <td>
                            <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi">{{ $data->deskripsi }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>

    <script>
    
        function validatePrice(input) {
            let value = input.value.replace(/[^0-9.]/g, '');
        
            value = formatCurrency(value);
        
            input.value = value;
        }
        
        function formatCurrency(value) {
            const parts = value.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
            return 'Rp ' + parts.join('');
        }
    </script>
    
@endsection
