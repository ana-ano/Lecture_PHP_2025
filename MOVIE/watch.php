<?php
session_start();
require 'config.php';

// მომხმარებელი უნდა იყოს შესული
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ფილმის ID-ს მიღება და ვალიდაცია
$movie_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($movie_id <= 0) {
    die("Invalid movie ID.");
}

// ფილმის ინფორმაციის მიღება ბაზიდან, genre_name-ს ჩათვლით
$stmt = $conn->prepare("
    SELECT m.*, g.genre_name AS genre
    FROM movies m
    LEFT JOIN genres g ON m.genre_id = g.genre_id
    WHERE m.movie_id = ?
");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

if (!$movie) {
    die("Movie not found.");
}

// --- შეფასების და კომენტარის დამატების ლოგიკა ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment = trim($_POST['comment'] ?? '');

    // ვალიდაცია
    if ($rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare("INSERT INTO reviews (user_id, movie_id, rating, comment, review_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iiis", $user_id, $movie_id, $rating, $comment);
        $stmt->execute();
        header("Location: watch.php?id=" . $movie_id);
        exit;
    } else {
        $error = "Please provide a valid rating (1-5).";
    }
}

// შეფასებების ჩატვირთვა
$stmt = $conn->prepare("SELECT r.rating, r.comment, r.review_date, u.username 
                        FROM reviews r
                        JOIN users u ON r.user_id = u.user_id
                        WHERE r.movie_id = ?
                        ORDER BY r.review_date DESC");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$reviews_result = $stmt->get_result();

// საშუალო შეფასების გამოთვლა
$stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM reviews WHERE movie_id = ?");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$stmt->bind_result($avg_rating);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8') ?> - ფილმის ნახვა</title>
    <style>
        body { background-color: #111; color: #eee; font-family: Arial, sans-serif; padding: 20px; max-width: 900px; margin: auto; }
        a { color: crimson; text-decoration: none; }
        a:hover { text-decoration: underline; }
        h1, h2 { text-align: center; }
        .movie-info { background-color: #222; padding: 20px; border-radius: 10px; margin: 30px 0; }
        .movie-info p { margin: 10px 0; }
        .youtube-link { text-align: center; margin-bottom: 30px; }
        .reviews { margin-top: 40px; }
        .review { border-bottom: 1px solid #333; padding: 15px 0; }
        .review .username { font-weight: bold; }
        .review .date { font-size: 0.8em; color: #aaa; }
        .review .rating { color: gold; font-weight: bold; }
        form.review-form { background-color: #222; padding: 20px; border-radius: 10px; margin-top: 40px; }
        form.review-form label { display: block; margin-top: 10px; }
        form.review-form input[type=number], form.review-form textarea { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: none; font-size: 16px; }
        form.review-form button { margin-top: 15px; background-color: crimson; color: white; border: none; padding: 10px 15px; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .error { color: #f55; font-weight: bold; margin-top: 10px; }
        .back-link { display: block; text-align: center; margin-top: 40px; }
        .avg-rating { text-align: center; font-size: 1.2em; margin-top: 10px; color: gold; }
    </style>
</head>
<body>

<h1><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8') ?></h1>

<div class="movie-info">
    <p><strong>გამოშვების წელი:</strong> <?= htmlspecialchars($movie['release_year'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>ჟანრი:</strong> <?= htmlspecialchars($movie['genre'] ?? 'უცნობია', ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>აღწერა:</strong><br><?= nl2br(htmlspecialchars($movie['description'], ENT_QUOTES, 'UTF-8')) ?></p>
</div>

<div class="youtube-link">
    <a href="<?= htmlspecialchars($movie['youtube_url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank">🎥 უყურე პირდაპირ YouTube-ზე</a>
</div>

<?php if ($avg_rating): ?>
    <div class="avg-rating">⭐ საშუალო შეფასება: <?= number_format($avg_rating, 1) ?> / 5</div>
<?php else: ?>
    <div class="avg-rating">ჯერჯერობით შეფასებები არ არის</div>
<?php endif; ?>

<section class="reviews">
    <h2>მომხმარებლის შეფასებები და კომენტარები</h2>
    
    <?php if ($reviews_result->num_rows === 0): ?>
        <p style="text-align:center; color:#aaa;">მიმოხილვები არ არის.</p>
    <?php else: ?>
        <?php while ($review = $reviews_result->fetch_assoc()): ?>
            <div class="review">
                <div class="username"><?= htmlspecialchars($review['username'], ENT_QUOTES, 'UTF-8') ?></div>
                <div class="date"><?= date("Y-m-d H:i", strtotime($review['review_date'])) ?></div>
                <div class="rating">⭐ <?= (int)$review['rating'] ?>/5</div>
                <div class="comment"><?= nl2br(htmlspecialchars($review['comment'], ENT_QUOTES, 'UTF-8')) ?></div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<section>
    <h2>შეაფასე ფილმი და დატოვე კომენტარი</h2>
    <form class="review-form" method="POST" action="">
        <label for="rating">შეფასება (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required />
        
        <label for="comment">კომენტარი:</label>
        <textarea id="comment" name="comment" rows="4" placeholder="დატოვე შენი კომენტარი..."></textarea>
        
        <button type="submit">გაგზავნა</button>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </form>
</section>

<a href="profile.php" class="back-link">⬅️ უკან ფილმების სიაში</a>

</body>
</html>



