<?php
    // Kontroll, kas submit nupp on klikitud
    if (isset($_POST['submit'])) {
        include_once 'connection.php';

        $name = $_POST['name'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
        $isadmin = isset($_POST['isadmin']) ? 1 : 0;

        // Kontroll, et ei oleks tühjasid välju
        if (empty($name) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            header("Location: ../admin.php?signup=empty!");
            exit();
        } else {
            // Kontroll, et nimi ja perekonnanimi sisaldavad ainult tähti
            if (!preg_match("/^[a-zA-Z]*$/", $name) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../admin.php?signup=invalid!");
                exit();
            } else {
                // Kontroll, et email on korrektne
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../admin.php?signup=invalidemail!");
                    exit();
                } else {
                    // Kontroll, kas kasutajanimi on juba kasutusel
                    $sql = "SELECT * FROM kasutajad WHERE uid=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../admin.php?login=error");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $uid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultcheck = mysqli_stmt_num_rows($stmt);
                        if ($resultcheck > 0) {
                            header("Location: ../admin.php?=usertaken!");
                            exit();
                        } else {
                            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO kasutajad (name, last, email, uid, pwd, isadmin) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt2 = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt2, $sql)) {
                                header("Location: ../admin.php?login=error");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt2, "sssssi", $name, $last, $email, $uid, $hashedpwd, $isadmin);
                                mysqli_stmt_execute($stmt2);
                                header("Location: ../admin.php?signup=success");
                                exit();
                            }
                        }
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt2);
    } else {
        header("Location: ../admin.php");
        exit();
    }
?>
