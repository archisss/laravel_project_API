@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Editar Información </h3>
</div>
<div class="card-body">
  <div class="media">
    @if($user->avatar)
      <img src="{{  Cloudder::show($user->avatar) }}" class="align-self-start mr-3">
    @else
      <img src="../../dist/img/defaultprofile.png" class="align-self-start mr-3">
    @endif
    <div class="media-body">
      <form method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
      {!! method_field('patch') !!} 
          <div class="form-group">
              <label for="name">Nombre</label>
              <input type="name" class="form-control" name="name" value="{{ isset($user->name) ? $user->name : old('name') }}">
              {!! $errors->first('name', '<span class="alert-danger">:message</span>') !!}
          </div>
          <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input disabled="disabled" type="email" class="form-control" name="email" value="{{ isset($user->email) ? $user->email : old('email') }}">
              {!! $errors->first('email', '<span class="alert-danger">:message</span>') !!}
          </div>
          <div class="form-group">
              <label for="cellphone">Teléfono Celular</label>
              <input type="cellphone" class="form-control" name="cellphone" value="{{ isset($user->cellphone) ? $user->cellphone : old('cellphone') }}">
              {!! $errors->first('cellphone', '<span class="alert-danger">:message</span>') !!}
          </div>
          <div class="form-group d-flex flex-column">
              <label for="avatar">Imagen de Perfil</label> 
              <!--@if(isset( $user->avatar ))
                  <img src="{{ asset('storage/'.$user->avatar) }}" class="img-thumbnail w-25">
              @endif   -->
              <input type="file" name="avatar">
              {!! $errors->first('avatar', '<span class="alert-danger">:avatar</span>') !!}
          </div>

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