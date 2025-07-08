<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat';
        padding: 20px;

    }

    .cont {
        width: 80vw;
        margin: 0 auto
    }

    .container {
        box-sizing: border-box;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .container a {
        text-align: center;
        text-decoration: none;
        color: black;
        padding: 1em;
        border-radius: 15px;
        box-shadow: 0 5px 10px 0 rgba(255, 132, 132, 0.5);
    }

    .container a div>h1 {
        font-size: clamp(20px, 1vw, 2.5rem);
    }

    .map {
        border: 1px solid gray;
        height: 50vh;
        overflow: hidden;
        margin: 20px auto;
    }

    @media (max-width: 768px) {
        .container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .container {
            grid-template-columns: 1fr;
        }
    }
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visitor View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css">
</head>

<body>
    <div class="cont">
        <h1 style="text-align: center;">Urdaneta City Cultural Heritage Mapping</h1>
        <div class="container">
            <a href="{{ route('snr') }}">
                <div>
                    <img src="{{ asset('mapping-icons/forest 1.png') }}" alt="">
                    <h1>Significant Natural Resources</h1>
                </div>
            </a>

            <a href="{{ route('immovable') }}">
                <div>
                    <img src="{{ asset('mapping-icons/property 1.png') }}" alt="">
                    <h1>Tangible-Immovable Cultural Heritages</h1>
                </div>
            </a>

            <a href="{{ route('movable') }}">
                <div>
                    <img src="{{ asset('mapping-icons/artifacts (2) 1.png') }}" alt="">
                    <h1>Tangible-Movable Cultural Heritage</h1>
                </div>
            </a>

            <a href="{{ route('intangible') }}">
                <div>
                    <img src="{{ asset('mapping-icons/pray 1.png') }}" alt="">
                    <h1>Intangible Cultural Heritage</h1>
                </div>
            </a>

            <a href="{{ route('significant.personalities') }}">
                <div>
                    <img src="{{ asset('mapping-icons/old-people 1.png') }}" alt="">
                    <h1>Significant Personalities</h1>
                </div>
            </a>

            <a href="{{ route('cultural') }}">
                <div>
                    <img src="{{ asset('mapping-icons/museum 1.png') }}" alt="">
                    <h1>Cultural Institutions</h1>
                </div>
            </a>
        </div>

        <div id="map" class="map"></div>
    </div>
</body>

</html>

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the map
        const map = L.map('map').setView([15.9765, 120.5709], 15);

        // Define the bounds for Urdaneta, Pangasinan
        const bounds = L.latLngBounds(
            [15.9600, 120.5400], // Southwest corner (lower bound)
            [15.9900, 120.6000] // Northeast corner (upper bound)
        );

        // Set map's view to the defined bounds and restrict panning and zooming outside the area
        // map.setMaxBounds(bounds);
        map.setMinZoom(10); // Optional: Set minimum zoom level to prevent zooming out too much

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Combine all the model data into a single array
        const markers = [
            ...@json($heritages),
            ...@json($tangible_immovable),
            ...@json($significant_personalities),
            ...@json($tangible_movable),
            ...@json($intangible),
            ...@json($cultural_institutions)
        ];

        markers.forEach(marker => {
            let lat = marker.lat;
            let lng = marker.lng;
            let location = marker.location;
            let address = marker.address;

            // If lat and lng are missing, fall back to location or address
            if (!lat || !lng) {
                if (location) {
                    // Geocode location if available
                    geocodeAddress(location, function(lat, lng) {
                        if (lat && lng) {
                            addMarker(lat, lng, marker);
                        }
                    });
                } else if (address) {
                    // If location is also missing, fallback to address geocoding
                    geocodeAddress(address, function(lat, lng) {
                        if (lat && lng) {
                            addMarker(lat, lng, marker);
                        }
                    });
                }
            } else {
                // If lat and lng exist, use them directly
                addMarker(lat, lng, marker);
            }
        });

        // Function to add marker to the map
        function addMarker(lat, lng, marker) {
            const markerColor = getMarkerColor(marker.cultural_heritage_category);

            const customIcon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${markerColor}.png`,
                iconSize: [25, 41], // Default icon size
                iconAnchor: [12, 41], // Anchor point for the icon
                popupAnchor: [1, -34], // Popup position
                shadowSize: [41, 41],
                shadowAnchor: [12, 41],
            });

            // Add a slight offset if there's already a marker at this location
            const offset = Math.random() * 0.0005 - 0.00050; // Small offset within a range
            const adjustedLat = lat + offset;
            const adjustedLng = lng + offset;

            L.marker([adjustedLat, adjustedLng], {
                    icon: customIcon,
                })
                .addTo(map)
                .bindPopup(
                    `<b>${marker.name}</b><br>${marker.location || marker.address}<br><i>Category: ${marker.cultural_heritage_category}</i>`
                );
        }

        function geocodeAddress(address, callback) {
            const fullAddress = address + ' Urdaneta';
            const geocodeUrl =
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}&addressdetails=1&limit=1`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lon = parseFloat(data[0].lon);
                        callback(lat, lon);
                    } else {
                        callback(null, null);
                    }
                })
                .catch(error => {
                    console.error('Geocoding error:', error);
                    callback(null, null);
                });
        }

        function getMarkerColor(category) {
            switch (category) {
                case 'Significant Natural Resources':
                    return 'blue';
                case 'Tangible-Immovable Cultural Heritage':
                    return 'green';
                case 'Tangible Movable Culture':
                    return 'red';
                case 'Intangible Culture Heritage':
                    return 'violet';
                case 'Significant Personalities':
                    return 'yellow';
                case 'Cultural Institutions':
                    return 'orange';
                default:
                    return 'gray';
            }
        }

        setTimeout(() => {
            map.invalidateSize(true);
        }, 300);
    });
</script>
