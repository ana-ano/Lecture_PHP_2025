<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

require 'config.php';

// შეფასების წაშლა
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_reviews.php');
    exit;
}

// შეფასებების სია
$reviews = [];
$sql = "
    SELECT r.review_id, r.user_id, r.movie_id, r.rating, r.comment, r.review_date,
           u.username, m.title
    FROM reviews r
    LEFT JOIN users u ON r.user_id = u.user_id
    LEFT JOIN movies m ON r.movie_id = m.movie_id
    ORDER BY r.review_date DESC
";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

// ფილმების სია
$movies = [];
$sql_movies = "SELECT * FROM movies ORDER BY movie_id DESC"; // იმიტომ რომ created_at არ არსებობს
$result_movies = $conn->query($sql_movies);
if ($result_movies) {
    while ($row = $result_movies->fetch_assoc()) {
        $movies[] = $row;
    }
}

// ფილმის წაშლა
if (isset($_GET['delete_movie'])) {
    $id = (int)$_GET['delete_movie'];
    $stmt = $conn->prepare("DELETE FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_reviews.php');
    exit;
}

// ფილმის დამატება
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_movie'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO movies (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
        $stmt->execute();
        $stmt->close();
        header('Location: admin_reviews.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>ადმინის პანელი - შეფასებები და ფილმები</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
<h2>შეფასებების მართვა</h2>
 <a href="admin_logout.php">გასვლა</a>

<h3>შეფასებების სია</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th><th>მომხმარებელი</th><th>ფილმი</th><th>რეიტინგი</th><th>კომენტარი</th><th>თარიღი</th><th>მოქმედება</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reviews as $review): ?>
        <tr>
            <td><?= $review['review_id'] ?></td>
            <td><?= htmlspecialchars($review['username']) ?></td>
            <td><?= htmlspecialchars($review['title']) ?></td>
            <td><?= $review['rating'] ?></td>
            <td><?= htmlspecialchars($review['comment']) ?></td>
            <td><?= $review['review_date'] ?></td>
            <td>
                <a href="?delete=<?= $review['review_id'] ?>" onclick="return confirm('ნამდვილად წაშალო შეფასება?')">წაშლა</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>
<h2>🎬 ფილმების მართვა</h2>

<h3>ფილმის დამატება</h3>
<form method="post">
    <input type="text" name="title" placeholder="სათაური" required>
    <input type="text" name="description" placeholder="აღწერა">
    <button type="submit" name="add_movie">დამატება</button>
</form>

<h3>ფილმების სია</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th><th>სათაური</th><th>აღწერა</th><th>მოქმედება</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($movies as $movie): ?>
        <tr>
            <td><?= $movie['movie_id'] ?></td>
            <td><?= htmlspecialchars($movie['title']) ?></td>
            <td><?= htmlspecialchars($movie['description']) ?></td>
            <td>
                <a href="edit_movie.php?id=<?= $movie['movie_id'] ?>">რედაქტირება</a> |
                <a href="?delete_movie=<?= $movie['movie_id'] ?>" onclick="return confirm('წავშალოთ ფილმი?')">წაშლა</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
