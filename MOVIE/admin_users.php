<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

require 'config.php'; // აქ $conn არის mysqli

// წაშლა
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_users.php');
    exit;
}

// დამატება / რედაქტირება
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if ($id) {
        // რედაქტირება
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $username, $email, $role, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // დამატება
        $password_hash = password_hash('password', PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password_hash, $role);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: admin_users.php');
    exit;
}

// რედაქტირებისთვის მომხმარებლის წამოღება
$edit_user = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_user = $result->fetch_assoc();
    $stmt->close();
}

// ყველა მომხმარებლის წამოღება
$users = [];
$result = $conn->query("SELECT * FROM users ORDER BY user_id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

