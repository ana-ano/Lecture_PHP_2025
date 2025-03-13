<?php
session_start();

$num1 = rand(10, 99);
$num2 = rand(10, 99);

$operations = ['+', '-'];
$operation = $operations[array_rand($operations)];

$correct_answer = ($operation == '+') ? ($num1 + $num2) : ($num1 - $num2);

$_SESSION['correct_answer'] = $correct_answer;
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>დამცავი კოდი</title>
</head>
<body>
    <h3>გამოითვალეთ: <?php echo "$num1 $operation $num2 = ?"; ?></h3>

    <form method="POST">
        <input type="number" name="user_answer" required>
        <input type="submit" value="შემოწმება">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_answer = $_POST['user_answer'];
        if ($user_answer == $_SESSION['correct_answer']) {
            echo "<p style='color:green;'>სწორია!</p>";
        } else {
            echo "<p style='color:red;'>არასწორია!</p>";
        }
    }
    ?>
</body>
</html>

