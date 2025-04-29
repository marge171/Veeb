<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = trim($_POST['password']);

    // Kasutaja otsing andmebaasist
    $stmt = $conn->prepare("SELECT * FROM kasutajad WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Kontrollige parooli
        if ($_POST['password'] === $user['password']) { 
            $_SESSION['u_id'] = $user['id']; // Sessiooni seadistamine
            header("Location: autoleht.php"); // Suunab autolehele
        } else {
            echo "Vale parool!";
        }
    } else {
        echo "Kasutajat ei leitud!";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisselogimine</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <section class="login-section">
        <h2>Sisselogimine</h2>
        <form action="login.php" method="POST">
            <label for="email">E-post:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Parool:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Logi sisse</button>
			<p style="margin-top: 10px;">
    <a href="forgotpassword.php" class="forgot-link">Unustasid parooli?</a>
</p>
			<div class="register-container">
        <p>Ei ole veel kasutajat?</p>
        <a href="signupform.php" class="register-link">Registreeri siin</a>
    </div>
			 <a href="index.php" class="back-to-home">Tagasi avalehele</a>
 
        </form>

        <?php
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'emptyfields':
                    echo "<p class='error'>Kõik väljad on kohustuslikud!</p>";
                    break;
                case 'wrongpassword':
                    echo "<p class='error'>Vale parool!</p>";
                    break;
                case 'nouserfound':
                    echo "<p class='error'>Kasutajat ei leitud!</p>";
                    break;
                case 'sqlerror':
                    echo "<p class='error'>Andmebaasi viga, palun proovige hiljem!</p>";
                    break;
                default:
                    echo "<p class='error'>Tundmatu viga.</p>";
            }
        }
        ?>
    </section>
</body>
</html>