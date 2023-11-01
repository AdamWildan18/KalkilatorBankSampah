@extends('layouts.master')
@section('content')
<div class="container embed-responsive">
    <div id="chart"></div>
</div>
<hr>

<div class="table table-responsive">
    <h2>Data Sampah Yang Sudah Terkumpul</h2>
    <table class="table ">
        <thead>
            <tr>
                <td>No</td>
                <td>Jenis Sampah</td>
                <td>Harga Satuan</td>
                <td>Jumlah Sampah</td>
                <td>Total Harga</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataall as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->berat }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Tren Jumlah Per Kategori'
        },
        xAxis: {
            categories: @json($categories)
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            }
        },
        series: [{
            name: 'Jumlah',
            data: @json($jumlah)
        }]
    });
</script>
@endsection
