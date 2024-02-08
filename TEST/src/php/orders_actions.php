<?php
global $conn;
?>

<title>Achat d'un DVD</title>
<link href="../css/style_order_actions.css" rel="stylesheet">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["idToOrder"])) {
    $idToOrder = $_POST["idToOrder"];
}

    include("db.php");

    $sql = "SELECT stock FROM movie WHERE id = $idToOrder";
    $result = $conn->query($sql);

if ($result == false) {
    die("Une erreur est survenue lors de l'exécution de la requête: " . $conn->error);
} else {
    $row = $result->fetch_assoc();
    if ($row['stock'] > 0) { ?>
        <main class="container">
            <form action="orders_action_end.php" method="post">

                <label for="fname">Prénom</label>
                <input type="text" id="fname" name="fname" placeholder="Votre prénom" required>

                <label for="lname">Nom de famille</label>
                <input type="text" id="lname" name="lname" placeholder="Votre nom de famille" required>

                <label for="street">Rue</label>
                <input type="text" id="street" name="street" placeholder="Votre rue" required>

                <label for="zip">Code postal</label>
                <input type="text" id="zip" name="zip" placeholder="Votre code postal" required>

                <label for="city">Ville</label>
                <input type="text" id="city" name="city" placeholder="Votre ville" required>

                <input type="submit" value="Envoyer">
                <input type="hidden" id="idToOrder" name="idToOrder" value="<?= $idToOrder ?>">
            </form>
        </main>


    <?php } else {
        echo "<h1 class='red'>Le stock est insuffisant pour passer la commande.</h1>";
        echo "<p>Vous pouvez désormais revenir au menu des commandes.</p>";
        echo '<button onclick="window.location.href=\'orders.php\'">Retour au menu</button>';
    }
}
}
?>
</body>
</html>