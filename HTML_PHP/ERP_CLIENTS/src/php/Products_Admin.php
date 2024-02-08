<?php
global $conn;

$converter = @$_GET["Converter"];

include "DB.php";

echo '<title>Liste des Produits</title>
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
     <h1>Liste des produits</h1>
     
     <nav>
        <ul>
            <li><a href="Clients_Admin.php">Gestion des clients</a></li>
            <li><a href="Products_Admin.php">Gestion des produits</a></li>
            <li><a href="Order_Admin.php">Gestion des commandes</a></li>
            <li><a href="Login.html">Se connecter</a> </li>
        <ul>
    </nav>
<table>
<tr>    
    <th>ID</th>
    <th>Marque</th>
    <th>Modèle</th>
    <th>Date de sortie</th>
    <th>Prix</th>
    <th>Url</th>
    <th>Action</th>
    <th>Commande</th>
</tr>';

$sql = "SELECT * FROM products ORDER BY name ASC";
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["brand"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["release_date"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td>" . $row["url"];
    echo '<td>
            <form method="POST" action="">
                <input type="hidden" name="delete" value="' . $row["id"] .'">
                <input type="hidden" name="action" value="delete">
                <input type="submit" value="Supprimer">
            </form>
        </td>';
    echo '<td>
           <form method="POST" action="">
                <input type="hidden" name="add_brand" value="' . $row["brand"] . '">
                <input type="hidden" name="add_name" value="' . $row["name"] . '">
                <input type="hidden" name="add_price" value="' . $row["price"] . '">
                
                <input type="hidden" name="action" value="order">
                <input type="submit" value="Commander">
           </form>';
    echo "</tr>";
}

if (@$_POST["action"] == "delete") {
    $delete_id = $_POST["delete"];
    $delete_sql = "DELETE FROM products WHERE id = $delete_id";
    $delete_result = $conn->query($delete_sql);
}
if (isset($_POST["action"]) && $_POST["action"] == "order") {
    $add_brand = $_POST["add_brand"];
    $add_name = $_POST["add_name"];
    $add_price = $_POST["add_price"];

    $check_order_sql = "SELECT * FROM orders WHERE product_name = '$add_name'
                       AND product_brand = '$add_brand'";
    $check_order_result = $conn->query($check_order_sql);

    if ($check_order_result->num_rows > 0) {
        $update_order_sql = "UPDATE orders 
                SET quantity = quantity + 1, product_price = product_price + $add_price 
                WHERE product_name = '$add_name'";
        $update_order_result = $conn->query($update_order_sql);
    } else {
        $insert_order_sql = "INSERT INTO orders (product_brand, product_name, product_price, user_id, quantity, order_date)
                                VALUES ('$add_brand', '$add_name', $add_price, NULL, 1, NOW())";
        $insert_order_result = $conn->query($insert_order_sql);
    }
}

$conn->close();
?>