<?php
require 'config.php';
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $message = "წარმატებით დარეგისტრირდით!";
    } else {
        $message = "შეცდომა: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>რეგისტრაცია</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="form-container">
        <h2>რეგისტრაცია</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="მომხმარებელი" required>
            <input type="email" name="email" placeholder="ელ. ფოსტა" required>
            <input type="password" name="password" placeholder="პაროლი" required>
            <button type="submit">დარეგისტრირება</button>
        </form>
        <p class="message"><?= $message ?></p>
        <p>უკვე გაქვთ ანგარიში? <a href="login.php">შესვლა</a></p>
    </div>
</body>
</html>