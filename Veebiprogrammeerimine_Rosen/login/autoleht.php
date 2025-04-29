<?php
session_start();

// Kontrollime, kas kasutaja on sisselogitud
if (!isset($_SESSION['u_id'])) {
    header("Location: login.php"); // Kui ei ole sisselogitud, suuname logimislehele
    exit();
}

include_once 'includes/header.php';
include_once 'connection.php'; // Andmebaasi ühendus

$user_id = $_SESSION['u_id']; // Sisseloginud kasutaja ID

// Päring kõigi kasutaja autode leidmiseks
$query = "SELECT * FROM autod WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoleht</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="car-gallery">
        <h2>Autod</h2>
        <div class="car-container">
            <div class="car">
                <img src="images/audi.jpg" alt="Audi">
                <h3>Audi</h3>
                <p>Audi on Saksamaa autotootja, mis on tuntud oma luksuslike ja sportlike sõidukite poolest.</p>
            </div>
            <div class="car">
                <img src="images/bmw.jpg" alt="BMW">
                <h3>BMW</h3>
                <p>BMW on Saksa autotootja, mis keskendub dünaamilistele sõiduelamustele ja innovatsioonile.</p>
            </div>
            <div class="car">
                <img src="images/toyota.jpg" alt="Toyota">
                <h3>Toyota</h3>
                <p>Toyota on Jaapani autotootja, tuntud oma usaldusväärsete ja kütusesäästlike autode poolest.</p>
            </div>
        </div>
    </section>

    <section class="add-car">
        <h2>Lisa oma auto</h2>
        <form action="add_car.php" method="POST" enctype="multipart/form-data">
            <label for="car_name">Nimetus:</label>
			<input type="text" id="car_name" name="car_name" placeholder="Sisesta auto nimi"><br><br>

			<label for="car_description">Kirjeldus:</label>
			<textarea id="car_description" name="car_description" placeholder="Sisesta auto kirjeldus"></textarea><br><br>

			<label for="car_image">Lisa pilt oma autost:</label>
			<input type="file" id="car_image" name="car_image"><br><br>

            <button type="submit">Lisa auto</button>
        </form>
    </section>

<?php
    include_once 'includes/footer.php';
?>
</body>
</html>
