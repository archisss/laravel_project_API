@extends('webpanel.layout')

@section('content')

    
<div class="card"><!-- PRINCIPAL CARD -->  
<div class="card-header"><!-- card-body -->
  <h3 class="card-title">Agregar Nuevo Estacionamiento</h3>
</div>

    <div class="card-body">
      <form method="POST" action="{{ route('parkings.store') }}" enctype="multipart/form-data">
          @include('parkings.form')
          <button type="submit" class="btn btn-primary">Agregar Cajón</button>
          @csrf
      </form>
    </div>   
  </div> 


    </div><!-- /.card-body -->

</div><!-- /. FINAL PRINCIPAL CARD -->


@endsection