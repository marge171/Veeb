<?php
// Andmebaasi ühendus
$servername = 'localhost'; // Serveri nimi
$username = 'root'; // Andmebaasi kasutajanimi
$password = ''; // Andmebaasi parool (tühi kui pole määratud)
$dbname = 'autoleht'; // Andmebaasi nimi

// Ühenduse loomine andmebaasiga
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontroll, kas ühendus õnnestus
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}
?>