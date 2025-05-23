<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$search = $_GET['q'] ?? '';
$movies = null;

if (!empty($search)) {
    $search_param = "%{$search}%";
    $stmt = $conn->prepare("SELECT * FROM movies WHERE title LIKE ? LIMIT 50");
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $movies = $stmt->get_result();
} else {
    $movies = $conn->query("SELECT * FROM movies LIMIT 50");
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8" />
    <title>პროფილი - ფილმების პორტალი</title>
    <style>
        body {
            background-color: #111;
            color: #eee;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header.main-header {
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #222;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #f39c12;
        }
        nav a {
            margin-right: 15px;
            color: #eee;
            text-decoration: none;
            font-weight: 600;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .user-info a {
            color: #f55;
            text-decoration: none;
            margin-left: 10px;
            font-weight: 600;
        }
        .movie-slider {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        .movie-card {
            width: 22%;
            background-color: #222;
            padding: 15px 15px 30px;
            border-radius: 10px;
            position: relative;
            transition: transform 0.3s ease;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.8);
        }
        .movie-card img {
            width: 100%;
            border-radius: 8px;
            display: block;
            margin-bottom: 10px;
        }
        .movie-card h3 {
            color: #fff;
            text-align: center;
            margin: 10px 0 15px;
            font-size: 18px;
        }
        .movie-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px #f39c12;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .movie-card:hover .buttons {
            opacity: 1;
        }
        .buttons a {
            flex: 1;
            text-align: center;
            padding: 8px 0;
            background-color: #f39c12;
            color: #000;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }
        .buttons a:hover {
            background-color: #e67e22;
        }
        .search-form {
            text-align: center;
            margin-top: 20px;
        }
        .search-form input {
            padding: 8px 12px;
            width: 300px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            outline: none;
        }
        .search-form button {
            padding: 8px 16px;
            border-radius: 5px;
            background-color: #f39c12;
            color: #000;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            margin-left: 5px;
            transition: background-color 0.3s ease;
        }
        .search-form button:hover {
            background-color: #e67e22;
        }

        /* Responsive for smaller screens */
        @media (max-width: 900px) {
            .movie-card {
                width: 45%;
            }
        }
        @media (max-width: 600px) {
            .movie-card {
                width: 90%;
            }
            .search-form input {
                width: 70%;
            }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="logo">🎬 Movies</div>
    <nav>
        <a href="profile.php">Home</a>
        <a href="favorites.php">My Favorites</a>
    </nav>
    <div class="user-info">👤 <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?> | <a href="logout.php">Logout</a></div>
</header>

<section class="popular">
    <h2 style="text-align:center;">Popular Movies</h2>

    <form method="GET" class="search-form" action="profile.php">
        <input type="text" name="q" placeholder="Search by title..." value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>" />
        <button type="submit">Search</button>
    </form>

    <div class="movie-slider">
        <?php if ($movies->num_rows === 0): ?>
            <p style="color:#aaa; text-align:center; width:100%;">No movies found.</p>
        <?php else: ?>
            <?php while ($movie = $movies->fetch_assoc()): ?>
                <div class="movie-card" tabindex="0">
                    <!-- თუ გაქვს სურათი, ჩასვი აქ: <img src="path_to_image.jpg" alt="<?= htmlspecialchars($movie['title']) ?>"> -->
                    <h3><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <div class="buttons">
                        <a href="watch.php?id=<?= (int)$movie['movie_id'] ?>">🎬 Watch</a>
                        <a href="add_to_favorites.php?id=<?= (int)$movie['movie_id'] ?>">❤️ Add to Favorites</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

</body>
</html>




