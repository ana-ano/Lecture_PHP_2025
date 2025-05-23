<?php
$host = "localhost";
$dbname = "movies_db";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("მონაცემთა ბაზასთან მიერთება ვერ მოხერხდა: " . $conn->connect_error);
}
?>
