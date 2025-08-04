<?php
include 'dbConnect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    if ($name !== '') {
        $stmt = $conn->prepare("INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $name, $price, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: products.php");
    exit;
}


$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Inventory System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 20px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        form {
            background: #ffffff;
            padding: 16px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
            max-width: 400px;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #2ecc71;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="nav">
    <a href="index.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="orders.php">📋 Orders</a>
</div>

<h1>Manage Products</h1>

<form method="POST">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required>

    <label for="price">Price (KES):</label>
    <input type="number" step="0.01" name="price" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required>

    <button type="submit">Add Product</button>
</form>

<table>
    <thead>
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Price (KES)</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= number_format($row['price'], 2) ?></td>
            <td><?= $row['quantity'] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
