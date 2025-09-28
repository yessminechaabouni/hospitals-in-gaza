<!DOCTYPE html>

<html lang="en">
<head>
    <title>Find Nearby Hospitals</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="map" style="height: 400px; margin-top: 20px; border-radius: 10px;"></div>

<!-- Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    // Initialise the card
    var map = L.map('map').setView([31.5, 34.47], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lon = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lon]).addTo(map)
            .bindPopup("Your selected position")
            .openPopup();

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lon;
    });
</script>

<body>

    <h2>Enter Your Location</h2>


    <form method="POST" action="find_hospitals.php">
        <label>Latitude: </label>
        <input type="text" name="latitude" id="latitude" required><br>
        <label>Longitude: </label>
        <input type="text" name="longitude" id="longitude" required><br>
        <label>Type:
            <select name="type">
                <option value="">All</option>
                <option value="General">General</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Rehabilitation">Rehabilitation</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Ophthalmology">Ophthalmology</option>
                <option value="Oncology">Oncology</option>
            </select>
        </label>
        <button type="submit">Submit</button>
    </form>




</body>
</html>
