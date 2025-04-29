<?php
    if (isset($_POST['submit'])) {
        session_start();

        session_unset(); // Kustutame kõik sessiooni muutujad
        session_destroy(); // Lõpetame sessiooni
        
        header("Location: index.php"); // Suuname pealehele
        exit();
    }
?>
