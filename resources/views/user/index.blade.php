@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Información</h3>
</div>
<div class="card-body">
  <div class="media">
    @if($user->avatar)
    
      
      <img src="{{ Cloudder::show($user->avatar) }}" class="align-self-start mr-3">
    @else
      <img src="../../dist/img/defaultprofile.png" class="align-self-start mr-3">
    @endif
    <div class="media-body">
      <h5 class="mt-0"></h5>
      <p><b>Nombre:</b> {{ $user->name }}</p>
      <p><b>Correo Electrónico:</b> {{ $user->email }}</p>
      <p><b>Teléfono:</b> {{ $user->cellphone }}</p>
      <!--<p><b>Tipo de Usuario:</b> {{ $user->typeOf }}</p>-->
      <a  class="btn btn-primary" href=" {{ url('user/'.$user->id.'/edit') }}">Editar Información</a>
      <a  class="btn btn-primary" href=" {{ url('user/'.$user->id.'/documentos') }}">Subir documentos validación</a>
    </div>
    
  </div>          
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection