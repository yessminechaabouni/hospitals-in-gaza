<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "gaza"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
echo "<h1>Hospital Information</h1>";

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["Hospital_information"] . "</h3>";
        echo "<p>" . $row["FIELD2"] . " - " . $row["FIELD3"] . "</p>";
        echo "<p>Governorate: " . $row["FIELD4"] . "</p>";
        echo "<p>Number of Beds: " . $row["FIELD7"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

?>
