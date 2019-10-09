@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Codigo QR para tu estacionamiento </h3>
</div>
<div class="card-body">
  <p class="card-text">
  <h4>  Instrucciones </h4>
  </p>
    <ol>
    <li>Imprime el código QR </li>
    <li>Colocalo en un lugar visible </li>
    </ol>
  {!! QrCode::size(500)->generate($parking); !!}
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection