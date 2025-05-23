<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

require 'config.php'; // აქ ხდება $conn გამოყენება

// წაშლა
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
    SELECT r.review_id, r.user_id, r.movie_id, r.rating, r.comment, r.created_at,
           u.username, m.title
    FROM reviews r
    LEFT JOIN users u ON r.user_id = u.user_id
    LEFT JOIN movies m ON r.movie_id = m.movie_id
    ORDER BY r.created_at DESC
";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>შეფასებების მართვა</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
<h2>შეფასებების მართვა</h2>
<a href="admin_dashboard.php">დეშბორდი</a> | <a href="admin_logout.php">გასვლა</a>

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
            <td><?= $review['created_at'] ?></td>
            <td>
                <a href="?delete=<?= $review['review_id'] ?>" onclick="return confirm('ნამდვილად წაშალო შეფასება?')">წაშლა</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
