<?php
session_start();
require 'connection.php'; // Ühendus andmebaasiga

// Kui vorm on saadetud
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['password']; // Uus parool

    // Otsime kasutajat, et kontrollida, kas e-posti aadress on olemas
    $stmt = $conn->prepare("SELECT id FROM kasutajad WHERE email = ?");
    $stmt->bind_param("s", $email); // Bindime e-posti aadressi
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Kui kasutaja leiti, uuendame parooli
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Krüpteerime uue parooli
        $update_stmt = $conn->prepare("UPDATE kasutajad SET pwd = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $hashed_password, $email); // Bindime parooli ja e-posti aadressi
        $update_stmt->execute();

        // Kuvame edulehe
        echo "<p>Teie parool on edukalt lähtestatud!</p>";
        echo '<a href="login.php">Mine tagasi sisselogimise lehele</a>';
    } else {
        // Kui kasutajat ei leita
        echo "<p>Kasutajat ei leitud!</p>";
        echo '<a href="forgotpassword.php">Proovi uuesti</a>';
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Unustasid parooli?</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
	<section class="forgot-password-container">
    <h2>Parooli lähtestamine</h2>
    <form action="forgotpassword.php" method="post">
        <label for="email">Sisesta oma e-posti aadress:</label>
        <input type="email" id="email" name="email" required>

        <label for="newpassword">Sisesta uus parool:</label>
        <input type="password" id="newpassword" name="newpassword" required>

        <button type="submit">Lähtesta parool</button>
		<p><a href="login.php">Mine tagasi sisselogimise lehele</a></p>
    </form>
	</section>
</body>
</html>