@extends('webpanel.layout')

@section('content')

<!-- Default box -->      
<div class="card">
<div class="card-header">
  <h3 class="card-title">Mis Cajones</h3>

  <a href="{{ url('parkings/create') }}" class="nav-link">
        <i class="nav-icon fa fa-plus fa-lg"></i>       
        Agregar Cajón        
    </a>
</div>   
    <div class="card-body"> 
    <div class="row">
    @foreach ($user->parkings as $parking)
    <div class="col-sm-4">
        <div class="card">
        @if($parking->pic_front or $parking->pic_inside or $parking->pic_both)
            <!--<img src="{{ asset('storage/'.$parking->pic_front) }}" class="card-img-top">-->
            <div id="carouselParkings" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                @if($parking->pic_front)
                <div class="carousel-item active" data-interval="2000">
                <img src="{{  Cloudder::show($parking->pic_front) }}" class="card-img-top">
                </div>
                @endif
                @if($parking->pic_inside)
                <div class="carousel-item" data-interval="2000">
                <img src="{{ Cloudder::show($parking->pic_inside) }}" class="card-img-top">
                </div>
                @endif
                @if($parking->pic_both)
                <div class="carousel-item" data-interval="2000">
                <img src="{{ Cloudder::show($parking->pic_both) }}" class="card-img-top">
                </div>
                @endif
            </div> 
        </div>
        @else
            <img src="http://localhost:8000/dist/img/parking_1.png" class="card-img-top"> 
        @endif
        
        <div class="card-body">
            <h5 class="card-title"></h5>
            <a style="display: inline" href="{{ url('parkings/'.$parking->id.'/edit') }}" class="nav-link ">
                <i class="nav-icon fa fa-pencil"></i> <!-- Editar Información -->         
            </a>
           <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ route('parkings.destroy', $parking->id) }}"><i class="fa fa-trash"></i></a>-->
            
            <!---->
            <form style="display: inline" method="POST" action="{{ route('parkings.destroy', $parking->id) }}">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button class="btn btn-xs" type="submit" onclick="return confirm('¿Seguro desea eliminar este Cajón de Estacionamiento?')">
                <i class=" fa fa-trash text-primary"></i>   
                <img src="{{ asset('/dist/img/remove.png') }}" alt="remove">    
                </button>
            </form>
            <a target="_blank" style="display: inline" href="{{ url('parkings/pdfqrcode/'.$parking->id) }}" class="nav-link ">
                <i class="nav-icon fa fa-download"></i> <!-- QR code  -->         
            </a>
            <p class="card-text">
                <p><b>Dirección:</b> {{ $parking->address }}</p>
                <p><b>Código postal:</b> {{ $parking->zipcode }}</p>
                <p><b>Tamaño del estacionamiento:</b> {{ $parking->size }}</p>
                <p><b>Tiene puerta:</b> {{ $parking->hasgate }}</p>
                <p><b>Costo x cada 15 min:</b> $ {{ $parking->cost }} pesos</p>
            </p>
            <a href="{{ url('parking_schedule/'.$parking->id ) }}" class="btn btn-primary">Horarios de Estacionamiento</a>
            <form style="display: inline" method="POST" action="{{ route('parkings.destroy', $parking->id) }}">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <!--<button class="btn btn-danger btn-xs" type="submit">Eliminar Estacionamiento</button>-->
            </form>
        </div>
        </div>
    </div>
    @endforeach
    </div>


</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection

@push('body')
    <div id="carouselParkings" class="carousel slide" data-ride="carousel">
@endpush

@section('page-script')
<script type="text/javascript">
	
    console.log('script');

</script>
@stop
