@extends('layouts.main')
@section('content')
<div class="container">
    <div id="chart"></div>
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
