<!--Location:--> <input type="text" id="us2-address" style="display:none" value="Guadalajara, Jalisco, Mexico"/>

<div class="form-group">
    <label for="map">Seleccione su ubicación</label>
    <div id="us2" style="width: 600px; height: 500px;"></div>	    
</div>

<!--Lat:--> <input type="text" id="us2-lat" value="20.675171" style="display:none"/>
<!--Lon:--><input type="text" id="us2-lon" value="-103.347328" style="display:none"/>

<div class="form-group">
    <label for="latitud">Latitud</label>
    <input type="latitud"  class="form-control" name="latitud" id="latitud" value="{{ isset($parkings->latitud) ? $parkings->latitud : old('latitud') }}">
    {!! $errors->first('latitud', '<span class="alert-danger">:message</span>') !!}
</div>

<div class="form-group">
    <label for="longitud">Longitud</label>
    <input type="longitud" class="form-control" name="longitud" value="{{ isset($parkings->longitud) ? $parkings->longitud : old('longitud') }}">
    {!! $errors->first('longitud', '<span class="alert-danger">:message</span>') !!}
</div>

<div class="form-group">
    <label for="address">Dirección</label>
    <input type="address" class="form-control" name="address" value="{{ isset($parkings->address) ? $parkings->address : old('address') }}">
    {!! $errors->first('address', '<span class="alert-danger">:message</span>') !!}
</div>

<div class="form-group">
    <label for="zipcode">Códido Postal</label>
    <input type="zipcode" class="form-control" name="zipcode" value="{{ isset($parkings->zipcode) ? $parkings->zipcode : old('zipcode') }}">
    {!! $errors->first('zipcode', '<span class="alert-danger">:message</span>') !!}
</div>

<div class="form-group d-flex flex-column">
    <label for="size">Tamaño del Estacionamiento</label>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="size" id="size" value="S" checked>
    <label class="form-check-label" for="size">
        Pequeño
    </label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="size" id="size" value="M">
    <label class="form-check-label" for="size">
        Mediano
    </label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="size" id="size" value="L">
    <label class="form-check-label" for="size">
        Grande
    </label>
    </div>
</div>

<div class="form-group d-flex flex-column">
    <label for="hasgate">¿Tiene Puerta Eléctrica o Porton?</label>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="hasgate" id="hasgate" value="1">
    <label class="form-check-label" for="hasgate">
        Si
    </label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="hasgate" id="hasgate" value="0" checked>
    <label class="form-check-label" for="hasgate">
        No
    </label>
    </div>
</div>

<div class="form-group d-flex flex-column">    
    <label for="image_front">Imagen frontal del cajón</label>
    
    @if(isset( $parkings->pic_front ))
        <img src="{{ Cloudder::show($parkings->pic_front) }}" class="img-thumbnail w-25">
        @else
        <img src="{{ asset('/dist/img/est_frontal.jpg') }}" alt="frontal" width="150" height="150">
    @endif
    <input type="file" name="image_front">
    {!! $errors->first('image_front', '<span class="alert-danger">:image_front</span>') !!}
</div>

<div class="form-group d-flex flex-column">
    <label for="image_inside">Imagen del interior del cajón</label>
    @if(isset( $parkings->pic_inside ))
        <img src="{{ Cloudder::show($parkings->pic_inside) }}" class="img-thumbnail w-25">
        @else
        <img src="{{ asset('/dist/img/est_interior.jpg') }}" alt="frontal" width="150" height="150">
    @endif
    <input type="file" name="image_inside">

    {!! $errors->first('image_inside', '<span class="alert-danger">:image_inside</span>') !!}
</div>

<div class="form-group d-flex flex-column">
    <label for="avatar">Imagen de la fachada de la casa/departamento donde se encuentra el cajón</label> 
    @if(isset( $parkings->pic_both ))
        <img src="{{ Cloudder::show($parkings->pic_both) }}" class="img-thumbnail w-25">
        @else
        <img src="{{ asset('/dist/img/est_fachada.jpg') }}" alt="frontal" width="150" height="150">
    @endif   
    <input type="file" name="image_both">
    {!! $errors->first('image_both', '<span class="alert-danger">:image_both</span>') !!}
</div>





@section('script')

<!--<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>-->
<!--<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYDsjRF5FFD3FRJY57931NZKx11xd5xbw&sensor=false&libraries=places"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.min.js"></script>-->

<script type="text/javascript">
	/*
    console.log('MAP');

    $('#us2').locationpicker({
enableAutocomplete: true,
    enableReverseGeocode: true,
  radius: 0,
  inputBinding: {
    latitudeInput: $('#us2-lat'),
    longitudeInput: $('#us2-lon'),
    radiusInput: $('#us2-radius'),
    locationNameInput: $('#us2-address')
  },
  onchanged: function (currentLocation, radius, isMarkerDropped) {
        var addressComponents = $(this).locationpicker('map').location.addressComponents;
    console.log(currentLocation);  //latlon  
    updateControls(addressComponents); //Data
    }
});

function updateControls(addressComponents) {
  console.log(addressComponents);
}
*/
</script>
@stop

@section('page-script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYDsjRF5FFD3FRJY57931NZKx11xd5xbw&libraries=places"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.min.js"></script>
<script type="text/javascript">
	
    $('#us2').locationpicker({
    enableAutocomplete: true,
    enableReverseGeocode: true,
    radius: 0,
    location: {
        latitude: 20.675171,
        longitude: -103.347328
    },
    inputBinding: {
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon'),
        radiusInput: $('#us2-radius'),
        locationNameInput: $('#us2-address')
    },
    onchanged: function (currentLocation, radius, isMarkerDropped) {
    var addressComponents = $(this).locationpicker('map').location.addressComponents;
    console.log(currentLocation);  //latlon  
    updateControls(addressComponents); //Data
    }
});

function updateControls(addressComponents) {
  console.log(addressComponents);
}

$("#us2-lat").change(function(){
    $('input[name=latitud]').val($("#us2-lat").val());
});
$("#us2-lon").change(function(){
    $('input[name=longitud]').val($("#us2-lon").val());
});


</script>
@stop