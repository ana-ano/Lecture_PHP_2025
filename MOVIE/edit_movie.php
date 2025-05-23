<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

require 'config.php';

if (!isset($_GET['id'])) {
    header('Location: admin_reviews.php');
    exit;
}

$movie_id = (int)$_GET['id'];

// ფილმის დეტალების წამოღება
$stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$stmt->close();

if (!$movie) {
    echo "ფილმი ვერ მოიძებნა.";
    exit;
}

// განახლება
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (!empty($title)) {
        $stmt = $conn->prepare("UPDATE movies SET title = ?, description = ? WHERE movie_id = ?");
        $stmt->bind_param("ssi", $title, $description, $movie_id);
        $stmt->execute();
        $stmt->close();
        header('Location: admin_reviews.php');
        exit;
    } else {
        echo "სათაური აუცილებელია!";
    }
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>ფილმის რედაქტირება</title>
</head>
<body>
<h2>ფილმის რედაქტირება</h2>
<a href="admin_reviews.php">← უკან დაბრუნება</a>
<form method="post">
    <label>სათაური:<br>
        <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required>
    </label><br><br>
    <label>აღწერა:<br>
        <textarea name="description" rows="5" cols="40"><?= htmlspecialchars($movie['description']) ?></textarea>
    </label><br><br>
    <button type="submit">შენახვა</button>
</form>
</body>
</html>
