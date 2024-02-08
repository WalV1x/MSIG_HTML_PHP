<?php
global $conn;
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idToOrder = $_POST["idToOrder"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $street = $_POST["street"];
    $zip = $_POST["zip"];
    $city = $_POST["city"];


    $sql = "SELECT stock FROM movie WHERE id = $idToOrder";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Une erreur est survenue lors de l'exécution de la requête: " . $conn->error);
    } else {
        $row = $result->fetch_assoc();
        if ($row['stock'] > 0) {

            $newStock = $row['stock'] - 1;


            $updateSQL = "UPDATE movie SET stock = $newStock WHERE id = $idToOrder";
            $updateResult = $conn->query($updateSQL);

            $insertSQL = "INSERT INTO `order` (ordDate, fkFilms, ordFirstName, ordLastName, ordStreet, ordZipCode, ordCity) 
                          VALUES (NOW(), $idToOrder, '$fname', '$lname', '$street', $zip, '$city')";
            $insertResult = $conn->query($insertSQL);

            if ($updateResult === true && $insertResult === true) {
                echo "<h1>Le DVD a été commandé avec succès.</h1>";
                echo "<p>Vous pouvez désormais revenir au menu des commandes.</p>";
            } else {
                echo "Une erreur est survenue dans la commande.";
            }

        } else {
            echo "<h1 class='red'>Le stock est insuffisant pour passer la commande.</h1>";
            echo "<p>Vous pouvez désormais revenir au menu des commandes.</p>";
        }
    }
} else {
    // Handle case where form is not submitted via POST method
    echo "Une erreur est survenue lors de la soumission du formulaire.";
}
?>
<button onclick="window.location.href='orders.php'">Retour au menu</button>
</body>
</html>
