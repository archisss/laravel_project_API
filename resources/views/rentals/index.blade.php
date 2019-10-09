@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Historial de rentas </h3>
</div>
<div class="card-body">
  <p class="card-text">
    
      @if(count($rentals)==0)
        <tr>
          <th>No existen rentas para mostrar</th>
        </tr>
      @else
      
      <p class="text-danger">Tiene un saldo pendiente por: <b>{{ $saldo }} pesos.</b></p><br/>
      
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">Dirección del Estacionamiento</th>
          <th scope="col">Costo</th>
          <th scope="col">Impuesto</th>
          <th scope="col">Total</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      @foreach($rentals as $rental)
      <tbody>
        <tr>
          <td scope="row">{{ $rental->date }}</td>
          <td>{{ $rental->address }}</td>
          <td>{{ $rental->cost }}</td>
          <td>{{ $rental->fee }}</td>
          <td>{{ $rental->total }}</td>
          @switch($rental->rental_status)
            @case('waiting')
              <td>Estacionamiento en espera de usuario</td>
              @break
            @case('busy')
              <td>El estacionamiento esta en uso</td>
              @break
            @case('timing')
              <td>Calculando costos de servicio</td>
              @break
            @case('cancel')
              <td>La renta ha sido cancelada</td>
              @break
            @case('charging')
              <td>En proceso de cobranza</td>
              @break
            @case('closed')
              <td>La renta finalizo y se cobro con éxito</td>
              @break
            @default
              <td>No disponible</td>
          @endswitch
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