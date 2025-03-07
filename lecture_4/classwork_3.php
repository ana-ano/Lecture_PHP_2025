<?php
    $error = "";
    if(isset($_POST['email']) && empty($_POST['email'])){
        $error  = "error";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="form-1" action="" method="post">
        <input type="text" placeholder="email" name="email"> - 
            <span class="<?=$error?>">*</span>
        <br><br>
        <input type="text" placeholder="username" name="user"> - *
        <br><br>
        <input type="radio" name="age"> 15-20; <input type="radio" name="age"> 21-30; 
        <input type="radio" name="age"> 30-40; <input type="radio" name="age"> 41-50;
        <br><br>
        <button name="sign_up">Sign Up</button>
        <div>
            <?php
                if(isset($_POST['sign_up'])){
                    $email = $_POST['email'];
                    $user = $_POST['user'];
                    $age = $_POST['age'];
                    echo "<h3>$email $user $age</h3>";
                }
            ?>
        </div>
    </form>
</body>
</html>