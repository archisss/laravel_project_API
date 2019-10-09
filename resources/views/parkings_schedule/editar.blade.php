@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Establecer horarios para el día {{ $parking[0]->day}} </h3>
</div>
<div class="card-body">
  <p class="card-text">
    <form method="POST" action="{{ route('parking_schedule.update', $parking[0]->parking_id) }}">
        @method('PATCH')
        <div class="form-group">
            <h3>
                <label for="day">{{ $parking[0]->day}}</label>
            </h3>
        </div>
        <input type="hidden" id="day_to_update" name="day_to_update" value="{{ $parking[0]->id }}">
        <input type="hidden" id="father" name="father" value="{{ $parking[0]->parking_id }}">
        <input type="hidden" id="day" name="day" value="{{ $parking[0]->day }}">
        <div class="form-group row">
        <label for="{{$parking[0]->day.'start'}}" class="col-2 col-form-label">Hora de inicio</label>
        <div class="col-10">
            <input class="form-control" type="time" value="{{$parking[0]->start_time}}" id="{{$parking[0]->day.'start'}}" name="{{$parking[0]->day.'start'}}">
        </div>
        </div>
        <div class="form-group row">
        <label for="{{$parking[0]->day.'end'}}" class="col-2 col-form-label">Horario de cierre</label>
        <div class="col-10">
            <input class="form-control" type="time" value="{{$parking[0]->end_time}}" id="{{$parking[0]->day.'end'}}" name="{{$parking[0]->day.'end'}}">
        </div>
        </div>
        <div class="form-group d-flex flex-column">
            <label for="active">Rentar el estacionamiento este día </label>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="active" value="1" {{ $parking[0]->active=='Disponible' ?  'checked' : '' }} >
            <label class="form-check-label" for="active">
                Si
            </label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="active" value="0" {{ $parking[0]->active=='No Disponible' ?  'checked' : '' }}>
            <label class="form-check-label" for="active">
                No
            </label>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Día</button>
        @csrf
    </form>

  </p>
 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection

{{$parking[0]->day}}
