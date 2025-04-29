<?php

?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinu autoleht</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<!-- Navigatsioonimenüü -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Autoleht</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Avaleht</a></li>
            <li class="nav-item"><a class="nav-link" href="autoleht.php">Autod</a></li>

            <?php if (isset($_SESSION['u_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="autoleht.php">Minu konto</a></li>
                <li class="nav-item">
                    <form action="logout.php" method="POST" class="form-inline">
                        <button class="btn btn-danger btn-sm" type="submit" name="submit">Logi välja</button>
                    </form>
                </li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="signupform.php">Registreeru</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Logi sisse</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['u_isadmin']) && $_SESSION['u_isadmin'] == 1): ?>
                <li class="nav-item"><a class="nav-link text-warning" href="admin.php">Admin</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
