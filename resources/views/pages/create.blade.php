@extends('layouts.main')
@section('content')
    
<div class="text-center">
    <div class="container" style="width: 500px">
        <div class="card">
            <div class="card-header">
                <h4>Kalkulator Bank Sampah</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('setor.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="sampah" class="col-md-4 col-form-label text-md-end" >Jenis Sampah</label>
                        <div class="col-md-6">
                            <input id="Sampah" type="text" class="form-control" value="{{ $data->name }}" name="name" required readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga" class="col-md-4 col-form-label text-md-end" >Harga satuan</label>
                        <div class="col-md-6">
                            <input id="harga" type="text" class="form-control" value="Rp {{ number_format($data->harga, 0, ',', '.') }}" name="harga" required readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah" class="col-md-4 col-form-label text-md-end">Berat Sampah (KG)</label>
                        <div class="col-md-6">
                            <input id="jumlah" type="number" min="0.1" step="0.1" class="form-control" name="berat" required oninput="validateInput(this); calculateTotal(this)">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Total" class="col-md-4 col-form-label text-md-end">Berat Sampah (KG)</label>
                        <div class="col-md-6">
                            <input id="total" type="text" class="form-control" name="jumlah" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Setor</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function calculateTotal(input) {
        var harga = parseFloat(document.getElementById('harga').value.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
        var jumlah = parseFloat(input.value);
        var total = harga * jumlah;

        if (!isNaN(total)) {
            document.getElementById('total').value = 'Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        } else {
            document.getElementById('total').value = '';
        }
    }
    function validateInput(input) {
    const value = parseFloat(input.value);
    if (isNaN(value) || value < 0.1) {
        input.setCustomValidity("Harap masukkan angka positif atau desimal positif, misalnya 0.1.");
    } else {
        input.setCustomValidity(""); // Reset custom validity jika valid
    }
}

</script>
    
@endsection