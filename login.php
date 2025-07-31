<?php
require 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #43e97b, #38f9d7);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background: #43e97b;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    input[type="submit"]:hover {
      background: #38f9d7;
    }
    .message {
      color: red;
      text-align: center;
    }
    .switch {
      text-align: center;
      margin-top: 10px;
    }
    .switch a {
      color: #43e97b;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
</body>