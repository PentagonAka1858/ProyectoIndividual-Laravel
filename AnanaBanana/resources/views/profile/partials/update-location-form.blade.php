<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ubication') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Mark your ubication. Your coordinates and direction will be saved.') }}
        </p>
    </header>

    @if (session('success'))
        <p class="mt-2 font-medium text-sm text-green-600">{{ session('success') }}</p>
    @endif

    <form method="post" action="{{ route('profile.location') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <input type="hidden" name="latitud" id="latitud" value="{{ old('latitud', $user->latitud) }}">
        <input type="hidden" name="longitud" id="longitud" value="{{ old('longitud', $user->longitud) }}">

        <div>
            <x-input-label for="direccion" :value="__('Direction')" />
            <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full"
                :value="old('direccion', $user->direccion)" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
        </div>

        <div id="map" style="height: 400px; width: 100%; border-radius: 8px;"></div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save location') }}</x-primary-button>
        </div>
    </form>
</section>

<script>
    let map, marker;

    function initMap() {
        const defaultLocation = {
            lat: {{ $user->latitud ?? 36.5930 }},
            lng: {{ $user->longitud ?? -6.2400 }}
        };

        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 13,
        });

        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
        });

        // If user already has a location, show it
        @if($user->latitud && $user->longitud)
            updateFields({{ $user->latitud }}, {{ $user->longitud }});
        @endif

        // Update on marker drag
        marker.addListener('dragend', function (e) {
            updateFields(e.latLng.lat(), e.latLng.lng());
        });

        // Update on map click
        map.addListener('click', function (e) {
            marker.setPosition(e.latLng);
            updateFields(e.latLng.lat(), e.latLng.lng());
        });
    }

    function updateFields(lat, lng) {
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;

        const geocoder = new google.maps.Geocoder();
        const latlng = new google.maps.LatLng(lat, lng);
        
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    document.getElementById('direccion').value = results[0].formatted_address;
                }
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_key') }}&callback=initMap" async defer></script>
