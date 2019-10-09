@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Actualizar información probatoria de su Estacionamiento</h3>
</div>
<div class="card-body">
  <div class="media">
    <div class="media-body">
      <form method="POST" action="{{ route('user.documentos_upload', $user->id) }}" enctype="multipart/form-data">
      @method('PATCH')
        <p>
        Para rentar tus cajones en nuestra plataforma, necesitamos validar tu información así como la legalidad del inmueble en donde se ubican los cajones a rentar. Por favor adjunta los documentos solicitados a continuación.
        </p>
        <br/>
        <div class="form-group d-flex flex-column">
            @if($user->identificacion)
                <img src="{{  Cloudder::show($user->identificacion) }}" class="align-self-start mr-3">
            @endif
                <label for="identificacion">Identificación Oficial (INE, Pasaporte, etc.)</label> 
                <input type="file" name="identificacion">
                {!! $errors->first('identificacion', '<span class="alert-danger">identificacion</span>') !!}
        </div>
        <div class="form-group d-flex flex-column">
            @if($user->identificacion)
                <img src="{{  Cloudder::show($user->docprobatorio) }}" class="align-self-start mr-3">
            @endif
              <label for="docprobatorio">Documento Probatorio del Estacionamiento</label> 
              <input type="file" name="docprobatorio">
              {!! $errors->first('docprobatorio', '<span class="alert-danger">docprobatorio</span>') !!}
        </div>
            <a href="{{ url('/user') }}">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        @csrf
      </form>
    </div>   
  </div>          
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection