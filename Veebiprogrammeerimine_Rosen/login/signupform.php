<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Registeerimine</title>
</head>

<body>
    
    <section class="signupform" action="signup.php" method="POST">
        <div>
            <h2 class="signup-title">Registreeri kasutajaks</h2>
            <br>
            <form class="signup-form" action="signup.php" method="POST">
                <label for="firstname"><b>Eesnimi</b></label>
                <input class="field" type="text" name="firstname" placeholder="Sisestage palun oma eesnimi"><br><br>

                <label for="lastname"><b>Perekonnanimi</b></label>
                <input class="field" type="text" name="lastname" placeholder="Sisestage palun oma perekonnanimi"><br><br>

                <label for="email"><b>E-mail</b></label>
                <input class="field" type="text" name="email" placeholder="Sisestage palun oma e-mail"><br><br>

                <label for="username"><b>Kasutajanimi</b></label>
                <input class="field" type="text" name="username" placeholder="Sisestage palun kasutajanimi"><br><br>

                <label for="newpwd"><b>Parool</b></label>
                <input class="field" type="password" name="password" placeholder="Looge parool"><br><br>

                <button type="submit" name="submit">Registreeru!</button>
            </form>
        </div>
    </section>

    <div class="back">
        <a href="index.php">Mine tagasi esilehele</a>
    </div>
    
<?php
    include_once 'includes/footer.php';
?>
