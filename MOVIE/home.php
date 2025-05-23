<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome | Movie Portal</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="container">
      <div class="logo">MovieHub</div>
      <nav class="nav-links">
        <a href="#about">About</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="admin/dashboard.php" style="color: red; font-weight: bold;">ადმინი</a>
        <?php endif; ?>

        <a href="login.php">login</a>
<a href="admin_login.php">admin</a>

      </nav>
    </div>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-left">
        <h1>Discover Movies You Love</h1>
        <p>Welcome to the ultimate movie portal. Find reviews, trailers, and your favorites in one place.</p>
      </div>
      <div class="movie-carousel-container">
        <div class="movie-carousel">
          <img src="movie1.jpg" alt="Movie 1">
          <img src="movie2.jpg" alt="Movie 2">
          <img src="movie3.jpg" alt="Movie 3">
          <img src="movie4.jpg" alt="Movie 4">
          <img src="movie5.jpg" alt="Movie 5">
          <img src="movie1.jpg" alt="Movie 1">
          <img src="movie2.jpg" alt="Movie 2">
          <img src="movie3.jpg" alt="Movie 3">
          <img src="movie4.jpg" alt="Movie 4">
          <img src="movie5.jpg" alt="Movie 5">
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about" class="about-section">
    <div class="about-content">
      <div class="text-container">
        <h2>About Us</h2>
        <p>We are deeply passionate about the world of cinema. Our platform is more than just a place to find movies — it's a vibrant community where film lovers can come together to explore, review, and engage in meaningful discussions about the latest releases, timeless classics, and hidden gems. Whether you're a casual viewer or a devoted cinephile, you'll find a welcoming space here to share your thoughts and discover new favorites..</p>
      </div>
    </div>
  </section>

  <!-- NEWS SECTION -->
  <section id="news" class="news-section">
    <h2>Latest News</h2>
    <div class="news-item">
      <h4>Movie Title Premieres Today</h4>
      <p>🎬 Movie Title Premieres Today
The wait is finally over! One of the most highly anticipated films of the year makes its grand debut in theaters today. Critics and fans alike have been buzzing with excitement, and now it's your chance to see what the hype is all about. Check out our in-depth review, behind-the-scenes insights, and community reactions to find out if this blockbuster lives up to the expectations.</p>
    </div>
    <!-- დაამატე მეტი სიახლეები -->
  </section>

  <!-- FOOTER -->
  <footer class="footer" id="contact">
    <h2>Contact Us</h2>
    <div class="contact-info">
      <div class="contact-item">
        <h4>Email</h4>
        <p><a href="mailto:support@moviehub.com">support@moviehub.com</a></p>
      </div>
      <div class="contact-item">
        <h4>Phone</h4>
        <p>+995 599 123 456</p>
      </div>
    </div>
    <div class="copyright">
      &copy; 2025 MovieHub. All rights reserved.
    </div>
  </footer>

</body>
</html>

