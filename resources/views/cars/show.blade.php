@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Tus Automoviles </h3>
</div>
<div class="card-body">
  <p class="card-text">
    
      @if(count($cars)==0)
        <tr>
          <th>Aún no tienes automoviles dados de alta en tu aplicación <br/><br/>
              Visita la app para agregarlos</th>
        </tr>
      @else
      @foreach($cars as $car)
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Año</th>
          <th scope="col">Matricula</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">{{ $car->marca }}</th>
          <td>{{ $car->model }}</td>
          <td>{{ $car->year }}</td>
          <td>{{ $car->registrationnumber }}</td>
        </tr>
      @endforeach 
      @endif
      </tbody>
    </table> 
  </p>
 

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection