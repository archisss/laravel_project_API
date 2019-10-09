@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Lista de Usuarios</h3>
</div>
<div class="card-body">
    <table class="table table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Tipo de Usuario</th>
            <th scope="col">Teléfono Celular</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>
                <a href=" {{ route('user.edit',$user->id) }} ">
                {{ $user->name }}
                </a>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->typeOf }}</td>
            <td>{{ $user->cellphone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection