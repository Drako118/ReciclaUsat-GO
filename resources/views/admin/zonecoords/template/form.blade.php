<div class="form-row">
    <input type="hidden" name="zone_id" value="{{ $zone->id }}">
    <div class="form-group col-6">
        {!! Form::label('latitude', 'Latitud') !!}
        {!! Form::text('latitude', optional($lastCoord)->lat, [
            'class' => 'form-control',
            'placeholder' => 'Latitud',
            'readonly',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('longitude', 'Longitud') !!}
        {!! Form::text('longitude', optional($lastCoord)->lng, [
            'class' => 'form-control',
            'placeholder' => 'Longitud',
            'readonly',
            'required',
        ]) !!}
    </div>
</div>
<div id="map" style="height: 400px; width=100%; border:1px solid black"></div>
<br>
<script>
    var latInput = document.getElementById('latitude');
    var lonInput = document.getElementById('longitude');

    function initMap() {

        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lonInput.value);

        if (isNaN(lat) || isNaN(lng)) {
            // Obtener ubicación actual si los campos están vacíos o no contienen valores numéricos válidos
            navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                latInput.value = lat;
                lonInput.value = lng;
                displayMap(lat, lng);
            });
        } else {
            // Utilizar las coordenadas de los campos de entrada
            displayMap(lat, lng);
        }
    }

    function displayMap(lat, lng) {
        var mapOptions = {
            center: {
                lat: lat,
                lng: lng
            },
            zoom: 18
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng
            },
            map: map,
            title: "Coordenada",
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            var latlng = event.latLng;
            latInput.value = latlng.lat();
            lonInput.value = latlng.lng();
        });

        var perimeterCoords = @json($coords);
        // Crea un objeto de polígono con los puntos del perímetro
        var perimeterPolygon = new google.maps.Polygon({
            paths: perimeterCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        });

        perimeterPolygon.setMap(map);

        var bounds = new google.maps.LatLngBounds();

        // Obtener los límites (bounds) del polígono
        perimeterPolygon.getPath().forEach(function(coord) {
            bounds.extend(coord);
        });

        // Obtener el centro de los límites (bounds)
        var centro = bounds.getCenter();

        // Mover el mapa para centrarse en el centro del perímetro
        map.panTo(centro);




    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer>
</script>
