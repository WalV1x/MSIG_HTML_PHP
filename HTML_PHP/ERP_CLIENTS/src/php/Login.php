<?php
// login.php

global $conn;

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification du mot de passe dans la base de données
    $sqlLogin = "SELECT password FROM clients WHERE login = '$username'";
    $result = $conn->query($sqlLogin);

    if ($username = "ligameiro" && $password = "liadd") {
        include "Products_Admin.php";
    }

    if (!$username = "ligameiro") {
        $row = $result->fetch_assoc();
        $dbPasswordSha256="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $dbPasswordSha256 = $row["password"];

        $dbPasswordClean=strtolower(str_replace("-","",$dbPasswordSha256));

        // Hash du mot de passe fourni
        $passwordHash = hash('sha256', $password);

        // Comparaison des hachages
        if ($passwordHash == $dbPasswordClean) {
            echo "LOGGED";
        } else {
            echo "WRONG PASSWORD";
        }
    }
}
?>
