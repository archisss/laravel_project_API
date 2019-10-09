@extends('webpanel.layout')

@section('content')

    
<div class="card"><!-- PRINCIPAL CARD -->  
<div class="card-header"><!-- card-body -->
  <h3 class="card-title">Editar Cajón</h3>
</div>

    <div class="card-body">
      <form method="POST" action="{{ route('parkings.update', $parkings->id) }}" enctype="multipart/form-data">
          @include('parkings.form')
          @method('PATCH')
          <button type="submit" class="btn btn-primary">Actualizar información</button>
          @csrf
      </form>
    </div>   
  </div> 


    </div><!-- /.card-body -->

</div><!-- /. FINAL PRINCIPAL CARD -->


@endsection