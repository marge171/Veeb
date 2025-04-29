<?php

// Andmebaasi ühenduse faili
include_once "connection.php";

// Kontroll, kas kasutaja ID on saadetud URL-i kaudu
$id = $_GET['id'];

// SQL-käsk kasutaja kustutamiseks
$sql = "DELETE FROM `kasutajad` WHERE Id = $id";
$result = mysqli_query($conn, $sql);

// Kontroll, kas kustutamine õnnestus
if ($result) {
    header("Location: ../admin.php?deletesuccessful!");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
