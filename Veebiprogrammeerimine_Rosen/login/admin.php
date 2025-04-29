<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Kodutöö</title>
</head>

<body>

    <form action="includes/logout.php" method="POST">                
        <button type="submit" name="submit" class="logout">Logi välja</button>
    </form>

    <div class="back">
        <a href="index.php?login">Mine tagasi</a>
    </div>

    <div class="container">
    
        <?php
            include_once 'includes/connection.php';

            $query = "SELECT * FROM kasutajad ORDER by name";
            $result = mysqli_query($conn, "SELECT * FROM kasutajad");

            echo '<div class="allusers">';
            echo '<h2>*  Kõik kasutajad: </h2>';
            echo '<table class="userid">';
            echo '<tr>
                    <th>Eesnimi</th>
                    <th>Perekonnanimi</th>
                    <th>Email</th>
                    <th>Kasutajanimi</th>
                    <th>Admin = 1</th>
                    <th>Kustuta</th>
                </tr>';
            while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['last']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['uid']."</td>";
                echo "<td>".$row['isadmin']."</td>";
                echo '<td><a class="Delete" href="includes/deleteuser.php?id='.$row['Id'].'">Kustuta</a></td>';
                echo '</tr>';
            }
            echo "</table>";
            echo '</div>';
        ?>

        <section class="newuser">
            <div>
                <h2>Lisa uus kasutaja</h2>
                <br>
                <form action="includes/newuser.php" method="POST">
                    <label for="firstname"><b>Eesnimi</b></label>
                    <input class="field" type="text" name="firstname" placeholder="Eesnimi"><br><br>

                    <label for="lastname"><b>Perekonnanimi</b></label>
                    <input class="field" type="text" name="lastname" placeholder="Perekonnanimi"><br><br>

                    <label for="email"><b>E-mail</b></label>
                    <input class="field" type="text" name="email" placeholder="E-mail"><br><br>

                    <label for="username"><b>Kasutajanimi</b></label>
                    <input class="field" type="text" name="useridid" placeholder="Kasutajanimi"><br><br>

                    <label for="pwd"><b>Parool</b></label>
                    <input class="field" type="password" name="password" placeholder="Parool"><br><br>

                    <label for="admin"><b>Admin</b></label><input type="checkbox" name="isadmin">

                    <button class ="addnewuser" type="submit" name="submit">Lisa kasutaja!</button>
                </form>
            </div>
        </section>

    </div>

</body>

<?php
    include_once 'includes/footer.php';
?>
