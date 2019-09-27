
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwNRGEmkPdOmFhrGXZdKcZZb4YnwxAUdI&libraries=places&callback=initMap2" async defer></script>
    <script>
        //AIzaSyC-SOgIU7H_vEjyyGfDemVWR_gTJVBVq0E
        var map;
function initMap2() {
    // Create the map.
    var pyrmont = {
        lat: 19.0458,
        lng: 72.8893
    };
    if (navigator.geolocation) {
        try {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pyrmont = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
        } catch (err) {
        }
    }
    map = new google.maps.Map(document.getElementById('map1'), {
        center: pyrmont,
        zoom: 17
    });
    // Create the places service.
    var service = new google.maps.places.PlacesService(map);
    // Perform a nearby search.
    service.nearbySearch({
            location: pyrmont,
            radius: 4000,
            type: ['hospital']
        },
        function(results, status, pagination) {
            if (status !== 'OK') return;
            createMarkers(results);
            getNextPage = pagination.hasNextPage && function() {
                pagination.nextPage();
            };
        });
}
function createMarkers(places) {
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };
        var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
        });
        bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
}
    </script>
    <style>
        
body {
  margin: 0;
  padding: 0;
}
#map1 {
  height: 500px;
  margin: 10px auto;
  width: 1000px;
}
    </style>
    </head>
    <div class="card">
        <div class="card-header text-center text-dark" ><h4 class=display-4>{{"Help"}}</h4></div>
       
        <div class="card-body text-dark">
    <div id="map1"></div>
        </div>
    </div>
  