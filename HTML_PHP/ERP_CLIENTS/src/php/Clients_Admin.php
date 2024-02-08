<?php
global $conn;

$converter = @$_GET["Converter"];

include "DB.php";

echo '<title>Liste des Clients</title>
<style>
        table {
            font-family: Arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f4f4f4;
        }
        
        h1 {
        text-align: center;
        font-family: Arial, sans-serif;
        }
        
        td {
        background-color: #F4F1F1;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #FF6733;
        }
        
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        }
        
        h1 {
            margin-top: 40px;
            margin-bottom: 40px;
            font-weight: bold;
        }
        
        nav {
        background-color: #333;
        padding: 10px;
        margin-bottom: 50px;
        }
        
        
        ul li {
        display: inline;
        margin-right: 50px;
        }
        
        a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        }
    </style>
<body>
     <h1>Liste des clients</h1>
     
     <nav>
        <ul>
            <li><a href="Clients_Admin.php">Gestion des clients</a></li>
            <li><a href="Products_Admin.php">Gestion des produits</a></li>
            <li><a href="Order_Admin.php">Gestion des commandes</a></li>
            <li><a href="Login.html">Se connecter</a> </li>
        <ul>
    </nav>
</form>
<table>
<tr>    
    <th>ID</th>
    <th>Prénom</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Identifiant</th>
    <th>Action</th>
</tr>';


$sql = "SELECT * FROM clients ORDER BY last_name";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["first_name"] . "</td>";
    echo "<td>" . $row["last_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["login"] . "</td>";
    echo '<td>
            <form method="POST" action="">
                <input type="hidden" name="delete" value="' . $row["id"] . '">
                <input type="submit" value="Supprimer">
            </form>
        </td>';
    echo "</tr>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_id = $_POST["delete"];
    $delete_sql = "DELETE FROM clients WHERE id = '$delete_id'";
    $result = $conn->query($delete_sql);
}

$conn->close();
?>