@extends('layouts.main')
@section('content')
<div class="row" data-masonry='{"percentPosition": true }'>
    @foreach ($data as $item) 
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src="{{ asset($item->foto) }}" class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false" alt="">
        <div class="card-body">
          <h5 class="card-title">Sampah {{ $item->name }}</h5>
          <p class="card-text">{{ $item->deskripsi }}</p>
        </div>
        <div class="card-footer text-body-secondary">
          <a href="{{ route('setor.create', ['name' => $item->name]) }}" type="button" class="btn btn-primary">Setor</a>
        </div>
      </div>
    </div>
    @endforeach
</div>

@endsection