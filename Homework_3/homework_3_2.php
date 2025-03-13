<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Table Generator</title>
</head>
<body>

<form method="POST">
    M (სტრიქონები): <input type="number" name="m" required><br>
    N (სვეტები): <input type="number" name="n" required><br>
    a (მინ. რიცხვი): <input type="number" name="a" required><br>
    b (მაქს. რიცხვი): <input type="number" name="b" required><br>
    <input type="submit" value="გენერაცია">
</form>

<?php
function generateCustomTable($m, $n, $a, $b) {
    if (!is_numeric($m) || !is_numeric($n) || !is_numeric($a) || !is_numeric($b)) {
        echo "შეცდომა: შეიყვანეთ მხოლოდ რიცხვები!";
        return;
    }
    
    $m = intval($m);
    $n = intval($n);
    $a = intval($a);
    $b = intval($b);

    if ($m <= 0 || $n <= 0 || $a > $b) {
        echo "შეცდომა: შეიყვანეთ სწორი მონაცემები!";
        return;
    }

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    for ($i = 0; $i < $m; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $randomNumber = rand($a, $b);
            echo "<td>$randomNumber</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    generateCustomTable($_POST['m'], $_POST['n'], $_POST['a'], $_POST['b']);
}
?>

</body>
</html>

