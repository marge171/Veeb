<?php
session_start();

// Kontrollime, kas kasutaja on sisselogitud
if (!isset($_SESSION['u_id'])) {
    header("Location: login.php"); // Kui ei ole sisselogitud, suuname logimislehele
    exit();
}

include_once 'connection.php'; // Ühendus andmebaasiga

// Kui vorm on saadetud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Auto nimi ja kirjeldus
    $car_name = htmlspecialchars($_POST['car_name'], ENT_QUOTES, 'UTF-8');
    $car_description = htmlspecialchars($_POST['car_description'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['u_id'];  // Kasutaja ID, et siduda auto kasutajaga

    // Faili üleslaadimine
    if (isset($_FILES["car_image"])) {
        $target_dir = "images/"; // Failide salvestamise kaust
        $target_file = $target_dir . basename($_FILES["car_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Faili tüüp ja suurus
        $uploadOk = 1;
        if ($_FILES["car_image"]["size"] > 5000000) {
            echo "Fail on liiga suur.";
            $uploadOk = 0;
        }

        // Faili tüüp (lubatud ainult JPG, JPEG, PNG ja GIF)
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Ainult JPG, JPEG, PNG ja GIF failid on lubatud.";
            $uploadOk = 0;
        }

        // Kui kõik korras, siis laeme faili üles
        if ($uploadOk == 0) {
            echo "Faili ei saa laadida.";
        } else {
            if (move_uploaded_file($_FILES["car_image"]["tmp_name"], $target_file)) {
                // Pildi suuruse määramine (max suurus 300x300px)
                $max_width = 300;
                $max_height = 300;

                // Pildi laadimine ja suuruse muutmine
                list($width, $height) = getimagesize($target_file);
                $ratio = min($max_width / $width, $max_height / $height);
                $new_width = floor($width * $ratio);
                $new_height = floor($height * $ratio);

                // Loodakse uus pilt
                $image_p = imagecreatetruecolor($new_width, $new_height);

                // Pildi tüüp (siin näiteks JPG)
                if ($imageFileType == "jpeg" || $imageFileType == "jpg") {
                    $source = imagecreatefromjpeg($target_file);
                } elseif ($imageFileType == "png") {
                    $source = imagecreatefrompng($target_file);
                } elseif ($imageFileType == "gif") {
                    $source = imagecreatefromgif($target_file);
                }

                // Pildi suuruse muutmine
                imagecopyresampled($image_p, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                // Salvestame muudetud pildi
                if ($imageFileType == "jpeg" || $imageFileType == "jpg") {
                    imagejpeg($image_p, $target_file, 100);
                } elseif ($imageFileType == "png") {
                    imagepng($image_p, $target_file, 9);
                } elseif ($imageFileType == "gif") {
                    imagegif($image_p, $target_file);
                }

                // Kui pilt on edukalt üles laetud ja töödeldud, siis salvestame andmed andmebaasi
                $stmt = $conn->prepare("INSERT INTO autod (car_name, car_description, car_image, user_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $car_name, $car_description, $target_file, $user_id);
                $stmt->execute();

                echo "Auto on edukalt lisatud!";
                header("Location: autoleht.php"); // Suunab tagasi autolehele
                exit();
            } else {
                echo "Faili laadimine ebaõnnestus.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisa auto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Lisa oma auto</h2>
        <form action="add_car.php" method="POST" enctype="multipart/form-data">
            <label for="car_name">Auto nimi:</label>
            <input type="text" name="car_name" id="car_name" required><br><br>

            <label for="car_description">Auto kirjeldus:</label>
            <textarea name="car_description" id="car_description" required></textarea><br><br>

            <label for="car_image">Auto pilt:</label>
            <input type="file" name="car_image" id="car_image" required><br><br>

            <button type="submit" name="submit">Lisa auto</button>
        </form>
    </section>
</body>
</html>
