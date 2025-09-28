<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Nearby Hospitals</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f8fa;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        #map {
            height: 500px;
            margin-top: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<header>
    <h1>🏥 Nearby Hospitals</h1>
    <p>Quickly find healthcare facilities around you</p>
</header>

<?php
if (!isset($_POST["latitude"]) || !isset($_POST["longitude"])) {
    die("Error: Coordinates not provided.");
}

$user_lat = $_POST["latitude"];
$user_lon = $_POST["longitude"];
$type = isset($_POST['type']) ? $_POST['type'] : '';

$conn = new mysqli("localhost", "root", "", "gaza");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT 
        Hospital_information,
        latitude,
        longitude,
        FIELD9,
        FIELD7 AS number_of_beds,
        FIELD8 AS bed_capacity,
        (
            6371 * ACOS(
                COS(RADIANS($user_lat)) * COS(RADIANS(latitude)) *
                COS(RADIANS(longitude) - RADIANS($user_lon)) +
                SIN(RADIANS($user_lat)) * SIN(RADIANS(latitude))
            )
        ) AS distance
    FROM mytable
";

if (!empty($type)) {
    $sql .= " WHERE FIELD9 LIKE '%$type%'";
}

$sql .= " ORDER BY distance ASC";

$result = $conn->query($sql);
$hospitals = [];

if ($result && $result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $hospitals[] = $row;
        echo "<li>
                <strong>" . htmlspecialchars($row["Hospital_information"]) . "</strong><br>
                Distance: " . round($row["distance"], 2) . " km<br>
                🛏️ Number of beds: " . htmlspecialchars($row["number_of_beds"]) . "<br>
                🏥 Capacity: " . htmlspecialchars($row["bed_capacity"]) . "
              </li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hospitals found.</p>";
}

$conn->close();
?>

<!-- Map -->
<div id="map"></div>
<h2>Hospital Beds Chart 🏥</h2>
<canvas id="bedsChart" width="400" height="200"></canvas>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    const hospitals = <?= json_encode($hospitals) ?>;
    const userLat = <?= json_encode($user_lat) ?>;
    const userLon = <?= json_encode($user_lon) ?>;

    const map = L.map('map').setView([userLat, userLon], 13);

 
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

 
    L.marker([userLat, userLon]).addTo(map)
        .bindPopup("📍 You are here")
        .openPopup();

    // Hospitals markers
    hospitals.forEach(hospital => {
        L.marker([hospital.latitude, hospital.longitude]).addTo(map)
            .bindPopup(`
                <strong>${hospital.Hospital_information}</strong><br>
                📏 ${parseFloat(hospital.distance).toFixed(2)} km away<br>
                🛏️ Beds: ${hospital.number_of_beds}<br>
                🏥 Capacity: ${hospital.bed_capacity}
            `);
    });
    //Hospital markers
    hospitals.forEach(hospital => {
        L.marker([hospital.latitude, hospital.longitude]).addTo(map)
            .bindPopup(`<strong>${hospital.Hospital_information}</strong><br>${parseFloat(hospital.distance).toFixed(2)} km away`);
    });
</script>



<script src="chart.js"></script>
</body>
</html>

