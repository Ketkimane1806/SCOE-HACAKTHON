<!DOCTYPE html>
<html>

<head>
    <title>Geolocation</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>

</head>

<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>

        var map = L.map('map').setView([19.0330, 73.0297], 11); // Set view to Navi Mumbai
        mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'Leaflet &copy; ' + mapLink + ', contribution',
            maxZoom: 18
        }).addTo(map);

        var taxiIcon = L.icon({
            iconUrl: 'img/taxi.png',
            iconSize: [70, 70]
        })

        var marker = L.marker([19.0330, 73.0297], { icon: taxiIcon }).addTo(map); // Add marker for Navi Mumbai

        map.on('click', function (e) {
            console.log(e)
            var newMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
            L.Routing.control({
                waypoints: [
                    L.latLng(19.0330, 73.0297), // Navi Mumbai
                    L.latLng(19.0759, 72.8774) // Mumbai Hospital
                ]
            }).on('routesfound', function (e) {
                var routes = e.routes;
                console.log(routes);

                e.routes[0].coordinates.forEach(function (coord, index) {
                    setTimeout(function () {
                        marker.setLatLng([coord.lat, coord.lng]);
                    }, 100 * index)
                })

            }).addTo(map);
        });


    </script>


</body>

</html>