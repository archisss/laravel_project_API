@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Establecer horarios del Estacionamiento </h3>
</div>
<div class="card-body">
  <p class="card-text">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Día</th>
          <th scope="col">Disponible desde</th>
          <th scope="col">Disponible Hasta</th>
          <th scope="col">Estado</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach($parkingSchedules as $parkingSchedule)
        <tr>
          <th scope="row">{{ $parkingSchedule->day }}</th>
          <td>{{ $parkingSchedule->start_time }}</td>
          <td>{{ $parkingSchedule->end_time }}</td>
          <td>{{ $parkingSchedule->active }}</td>
          <td><a class="btn btn-primary" href="{{ url('parking_schedule/'.$parkingSchedule->parking_id.'/'.$parkingSchedule->id.'/editar' ) }}">Cambiar Horarios</a></td>
        </tr>
      @endforeach 
      </tbody>
    </table> 
  </p>
 

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection