<?php
include "db.php";
?>

<?php
global $conn;

$converter = @$_GET["Converter"];

include "db.php";
?>

<title>Liste des Films</title>

<link href="../css/style_index.css" rel="stylesheet">

<nav>
    <ul>
        <li><a href="series.php">Les séries disponibles</a></li>
        <li><a href="movies.php">Les films disponibles</a></li>
        <li><a href="actor.html">Recherche par acteurs</a></li>
        <li><a href="orders.php">Commande</a></li>
</nav>

<title>Liste des Films</title>

<link href="../css/style.css" rel="stylesheet">

<h1>Liste des Films</h1>

<table>
    <tr>
        <th>show id</th>
        <th>title</th>
        <th>director</th>
        <th>cast</th>
        <th>release year</th>
        <th>duration</th>
        <th>description</th>
        <th>image</th>
    </tr>
    <?php

    $sql = "SELECT * FROM movie WHERE type = 'movie'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["show_id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["director"] . "</td>";
        echo "<td>" . $row["cast"] . "</td>";
        echo "<td>" . $row["release_year"] . "</td>";
        echo "<td>" . $row["duration"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td><img src='/3. WEB/TEST/src/img/{$row["image"]}' alt='image inconnue'></td>";
        echo "</tr>";
    }

    $conn->close();
    ?>

