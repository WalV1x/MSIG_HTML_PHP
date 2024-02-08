<?php
include "db.php";
?>

<?php
global $conn;

$converter = @$_GET["Converter"];

include "db.php";
?>

<link href="../css/style_index.css" rel="stylesheet">

<nav>
    <ul>
        <li><a href="series.php">Les séries disponibles</a></li>
        <li><a href="movies.php">Les films disponibles</a></li>
        <li><a href="actor.html">Recherche par acteurs</a></li>
        <li><a href="orders.php">Commande</a></li>
</nav>



<title>Commande</title>

<link href="../css/style.css" rel="stylesheet">

<h1>Commande</h1>

<table>
    <tr>
        <th>title</th>
        <th>director</th>
        <th>release year</th>
        <th>duration</th>
        <th>stock</th>
        <th>image</th>
        <th>action</th>
    </tr>
    <?php

    $sql = "SELECT * FROM movie";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["director"] . "</td>";
        echo "<td>" . $row["release_year"] . "</td>";
        echo "<td>" . $row["duration"] . "</td>";
        echo "<td>" . $row["stock"] . "</td>";
        echo "<td><img src='/3. WEB/TEST/src/img/{$row["image"]}' alt='image inconnue'></td>";
        echo '<td>
            <form method="POST" action="orders_actions.php">
                <input type="hidden" name="idToOrder" value="' . $row["id"] .'">
                <input type="submit" value="Commander">
            </form>
        </td>';

    }

    $conn->close();
    ?>