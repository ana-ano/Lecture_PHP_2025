<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// საყვარელი ფილმების ჩამოტვირთვა
$stmt = $conn->prepare("
    SELECT m.* FROM movies m
    JOIN favorites f ON m.movie_id = f.movie_id
    WHERE f.user_id = ?
    ORDER BY f.added_date DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8" />
    <title>My Favorites - ფილმების პორტალი</title>
    <style>
        body { background-color: #111; color: #eee; font-family: Arial, sans-serif; padding: 20px; max-width: 900px; margin: auto; }
        h1 { text-align: center; }
        .movie-list { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .movie-card { width: 22%; background-color: #222; padding: 10px; border-radius: 10px; text-align: center; }
        .movie-card a { color: crimson; text-decoration: none; font-weight: bold; display: block; margin: 10px 0; }
        .movie-card a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>My Favorite Movies</h1>

<div class="movie-list">
    <?php if ($result->num_rows === 0): ?>
        <p style="color:#aaa; width:100%; text-align:center;">თქვენ ჯერ არ გაქვთ საყვარელი ფილმები.</p>
    <?php else: ?>
        <?php while ($movie = $result->fetch_assoc()): ?>
            <div class="movie-card">
                <h3><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                <a href="watch.php?id=<?= (int)$movie['movie_id'] ?>">🎬 უყურე</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<a href="profile.php" style="display:block; text-align:center; margin-top: 40px; color: crimson; text-decoration:none;">⬅️ უკან ფილმების სიაში</a>

</body>
</html>
