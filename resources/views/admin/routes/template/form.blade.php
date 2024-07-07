<div class="row">
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese el nombre de la ruta',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('latitude', 'Latitud Inicio') !!}
            {!! Form::text('latitude', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese la latitud de inicio',
                'required',
                'id' => 'latitude'
            ]) !!}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('longitude', 'Longitud Inicio') !!}
            {!! Form::text('longitude', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese la longitud de inicio',
                'required',
                'id' => 'longitude'
            ]) !!}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('latitude_end', 'Latitud Fin') !!}
            {!! Form::text('latitude_end', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese la latitud de fin',
                'required',
                'id' => 'latitude_end'
            ]) !!}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('longitude_end', 'Longitud Fin') !!}
            {!! Form::text('longitude_end', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese la longitud de fin',
                'required',
                'id' => 'longitude_end'
            ]) !!}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('status', 'Estado') !!}
            {!! Form::select('status', [1 => 'Activo', 0 => 'Inactivo'], null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
</div>

<div id="map" style="height: 400px; width: 100%; border:1px solid black"></div>
<br>
<script>
    var latInput = document.getElementById('latitude');
    var lonInput = document.getElementById('longitude');
    var latEndInput = document.getElementById('latitude_end');
    var lonEndInput = document.getElementById('longitude_end');
    var map, markerStart, markerEnd;

    function initMap() {
        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lonInput.value);
        var latEnd = parseFloat(latEndInput.value);
        var lngEnd = parseFloat(lonEndInput.value);

        if (isNaN(lat) || isNaN(lng) || isNaN(latEnd) || isNaN(lngEnd)) {
            // Obtener ubicación actual si los campos están vacíos o no contienen valores numéricos válidos
            navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                latEnd = position.coords.latitude;
                lngEnd = position.coords.longitude;
                latInput.value = lat;
                lonInput.value = lng;
                latEndInput.value = latEnd;
                lonEndInput.value = lngEnd;
                displayMap(lat, lng, latEnd, lngEnd);
            });
        } else {
            // Utilizar las coordenadas de los campos de entrada
            displayMap(lat, lng, latEnd, lngEnd);
        }
    }

    function displayMap(lat, lng, latEnd, lngEnd) {
        var mapOptions = {
            center: { lat: lat, lng: lng },
            zoom: 18
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        markerStart = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: "Inicio",
            draggable: true
        });

        markerEnd = new google.maps.Marker({
            position: { lat: latEnd, lng: lngEnd },
            map: map,
            title: "Fin",
            draggable: true
        });

        google.maps.event.addListener(markerStart, 'dragend', function(event) {
            var latlng = event.latLng;
            latInput.value = latlng.lat();
            lonInput.value = latlng.lng();
        });

        google.maps.event.addListener(markerEnd, 'dragend', function(event) {
            var latlng = event.latLng;
            latEndInput.value = latlng.lat();
            lonEndInput.value = latlng.lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
