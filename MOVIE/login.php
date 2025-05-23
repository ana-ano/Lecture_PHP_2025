<?php
require 'config.php';
session_start();
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT user_id, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hash);
    $stmt->fetch();

    if ($user_id && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: profile.php");
        exit;
    } else {
        $message = "შეცდომა: არასწორი მონაცემები";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>შესვლა</title>
        <link rel="stylesheet" href="login.css ">

</head>
<body>
    <div class="form-container">
        <h2>შესვლა</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="ელ. ფოსტა" required>
            <input type="password" name="password" placeholder="პაროლი" required>
            <button type="submit">შესვლა</button>
        </form>
        <p class="message"><?= $message ?></p>
        <p>არ გაქვთ ანგარიში? <a href="register.php">დარეგისტრირდით</a></p>
    </div>
</body>
</html>
