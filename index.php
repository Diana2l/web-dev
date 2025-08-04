<?php
include 'dbConnect.php';
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/footer.php';


$product_count = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$order_count = $conn->query("SELECT COUNT(*) as count FROM orders WHERE status = 'pending'")->fetch_assoc()['count'];
$supplier_count = $conn->query("SELECT COUNT(*) as count FROM suppliers")->fetch_assoc()['count'];
$low_stock_count = $conn->query("SELECT COUNT(*) as count FROM products WHERE quantity < 10")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inventory Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #2c3e50;
      --accent: #3498db;
      --bg: #f4f6f8;
      --card-bg: #fff;
    }

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
    }

    header {
      background-color: var(--primary);
      color: white;
      padding: 16px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 600;
    }

    .container {
      padding: 32px;
    }

    h1 {
      color: var(--primary);
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .card {
      background-color: var(--card-bg);
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: 0.2s ease-in-out;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card h3 {
      margin: 0 0 10px;
      color: var(--accent);
    }

    .card p {
      font-size: 14px;
      color: #555;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #aaa;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <header>
    <div><strong>InventoryPro</strong></div>
    <nav>
      <a href="#">Dashboard</a>
      <a href="#">Products</a>
      <a href="#">About</a>
      <a href="#">Orders</a>
      <a href="#">Logout</a>
    </nav>
  </header>

  <div class="container">
    <h1>Welcome, Admin</h1>
    <p>Overview of your inventory system:</p>

    <div class="cards">
      <div class="card">
        <h3><?= $product_count ?></h3>
        <p>Products in Stock</p>
      </div>
      <div class="card">
        <h3><?= $order_count ?></h3>
        <p>Pending Orders</p>
      </div>
      <div class="card">
        <h3><?= $supplier_count ?></h3>
        <p>Suppliers</p>
      </div>
      <div class="card">
        <h3><?= $low_stock_count ?></h3>
        <p>Low Stock Alerts</p>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 InventoryPro. All rights reserved.
  </footer>
</body>
</html>
