<?php
session_start();

$fixed_email = 'anano.jolokhava@gau.edu.ge';
$fixed_password = 'anano12345';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === $fixed_email && $password === $fixed_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header('Location: admin_reviews.php');
        exit;
    } else {
        $error = "არასწორი მეილი ან პაროლი";
    }
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
<meta charset="UTF-8">
<title>ადმინის შესვლა</title>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: url('login.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-container {
    background-color: rgba(20, 20, 20, 0.85);
    padding: 40px 50px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(30, 144, 255, 0.5);
    width: 350px;
    text-align: center;
}

.form-container h2 {
    margin-bottom: 25px;
    font-weight: 700;
    font-size: 28px;
    color: #1E90FF;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.form-container input[type="email"],
.form-container input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0 20px 0;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
}

.form-container input[type="email"]:focus,
.form-container input[type="password"]:focus {
    box-shadow: 0 0 8px #1E90FF;
    border: 1px solid #1E90FF;
}

.form-container button {
    background-color: #1E90FF;
    border: none;
    color: white;
    padding: 14px 0;
    width: 100%;
    border-radius: 6px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: 600;
    text-transform: uppercase;
}

.form-container button:hover {
    background-color: #1C86EE;
}

.message {
    margin-top: 15px;
    color: #ff6b6b;
    font-weight: 600;
}
</style>
</head>
<body>
<div class="form-container">
    <h2>ადმინის შესვლა</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="მეილი" required><br>
        <input type="password" name="password" placeholder="პაროლი" required><br>
        <button type="submit">შესვლა</button>
        <?php if (!empty($error)) echo "<p class='message'>$error</p>"; ?>
    </form>
</div>
</body>
</html>

