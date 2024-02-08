<?php
global $conn;
include "DB.php";

echo '<title>Liste des commandes</title>
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
     <h1>Liste des commandes</h1>
     
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
    <th>Marque</th>
    <th>Modèle</th>
    <th>Prix</th>
    <th>ID utilisateur</th>
    <th>Quantité</th>
    <th>Date de commande</th>
    <th>Action</th>
</tr>';

$sql = "SELECT * FROM orders ORDER BY product_name ASC";
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["product_brand"] . "</td>";
    echo "<td>" . $row["product_name"] . "</td>";
    echo "<td>" . $row["product_price"] . "</td>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . $row["quantity"] . "</td>";
    echo "<td>" . $row["order_date"] . "</td>";
    echo '<td>
            <form method="POST" action="">
                <input type="hidden" name="delete" value="' . $row["id"] .'">
                <input type="submit" value="Supprimer">
            </form>
        </td>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_id = $_POST["delete"];
    $delete_sql = "DELETE FROM orders WHERE id = '$delete_id'";
    $delete_sql_result = $conn->query($delete_sql);
}