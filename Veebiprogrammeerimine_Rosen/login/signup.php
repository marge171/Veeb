<?php
session_start();
include_once 'connection.php'; // Andmebaasi ühendus

// Kui vorm on saadetud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Auto nimi ja kirjeldus
    $firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
    $lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password']; // Parooli korrektne võtmine
    $isadmin = 0; 

    // Sisestamine andmebaasi
	$password = $_POST['password'];
    $stmt = $conn->prepare("INSERT INTO kasutajad (firstname, lastname, email, username, password, isadmin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $username, $password, $isadmin);
    $stmt->execute();

    // Kontrollime, kas andmed on lisatud
    if ($stmt->affected_rows > 0) {
        echo "Kasutaja edukalt registreeritud!";
        header("Location: login.php"); // Suunab logimislehele
        exit();
    } else {
        echo "Registreerimine ebaõnnestus.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreeri kasutajaks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="signupform">
        <div class="signup-title">
            <h2>Registreeri kasutajaks</h2>
        </div>
        <form class="signup-form" action="signup.php" method="POST">
            <label for="firstname">Eesnimi:</label>
            <input type="text" name="firstname" required><br><br>

            <label for="lastname">Perekonnanimi:</label>
            <input type="text" name="lastname" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required><br><br>

            <label for="username">Kasutajanimi:</label>
            <input type="text" name="username" required><br><br>

            <label for="password">Parool:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Registreeri!</button>
        </form>
    </section>
</body>
</html>
