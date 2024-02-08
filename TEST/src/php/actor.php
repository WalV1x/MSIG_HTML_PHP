<?php
global $conn;
include "db.php";

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $query = "
SELECT * FROM movie 
WHERE cast LIKE '%$searchTerm%'";

    $sth = $conn->query($query);

    include "header.php";

    echo ' <title>Liste des Films</title>
 
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
        <th>stock</th>
    </tr>';

    foreach ($sth as $row) {
        echo "<tr>";
        echo "<td>" . $row["show_id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["director"] . "</td>";
        echo "<td>" . $row["cast"] . "</td>";
        echo "<td>" . $row["release_year"] . "</td>";
        echo "<td>" . $row["duration"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td><img src='/3. WEB/TEST/src/img/{$row["image"]}' alt='image inconnue'></td>";
        echo "<td>" . $row["stock"] . "</td>";
        echo "</tr>";
    }
}
$db = null;
?>