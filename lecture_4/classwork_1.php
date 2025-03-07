<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="form_1" method="post"> 
        <div>
        <?php
function sum($a, $b, $c) { 
    $a = isset($a) ? (int)$a : 0;
    $b = isset($b) ? (int)$b : 0;
    $c = isset($c) ? (int)$c : 0;
    return $a + $b + $c;
}

function multiply($a, $b, $c) {
    $a = isset($a) ? (int)$a : 1;
    $b = isset($b) ? (int)$b : 1;
    $c = isset($c) ? (int)$c : 1;
    return $a * $b * $c;
}

if (isset($_POST['sum'])) { 
    $sumResult = sum($_POST['n1'], $_POST['n2'], $_POST['n3']);
    echo "<h3>sum = $sumResult</h3>";
}

if (isset($_POST['multiply'])) {
    $multiplyResult = multiply($_POST['n1'], $_POST['n2'], $_POST['n3']);
    echo "<h3>product = $multiplyResult</h3>";
}
?>

        </div>

        <input type="number" placeholder="number1" name="n1"><br><br>
        <input type="number" placeholder="number2" name="n2"><br><br>
        <input type="number" placeholder="number3" name="n3"><br><br>

        <button type="submit" name="sum">Calculate Sum</button>
        <button type="submit" name="multiply">Calculate Product</button>
    </form>
</body>
</html>


