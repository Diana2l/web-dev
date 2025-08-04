<?php
include 'dbConnect.php';


if (isset($_GET['complete'])) {
  $orderId = intval($_GET['complete']);
  $conn->query("UPDATE orders SET status = 'completed' WHERE id = $orderId");
  header("Location: orders.php");
  exit;
}

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Orders - Inventory Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      padding: 20px;
    }

    h1 {
      color: #2c3e50;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
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
      background-color: #f1f1f1;
    }

    .complete-btn {
      background-color: #27ae60;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
    }

    .status-pending {
      color: #d35400;
      font-weight: bold;
    }

    .status-completed {
      color: #2ecc71;
      font-weight: bold;
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
  </style>
</head>
<body>
  <div class="nav">
    <a href="index.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="orders.php">📋 Orders</a>
  </div>

  <h1>Orders</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Order Name</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td class="<?= $row['status'] == 'pending' ? 'status-pending' : 'status-completed' ?>">
            <?= ucfirst($row['status']) ?>
          </td>
          <td>
            <?php if ($row['status'] == 'pending'): ?>
              <a href="orders.php?complete=<?= $row['id'] ?>" class="complete-btn">Mark as Completed</a>
            <?php else: ?>
              ✅
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
