<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $X = isset($_POST['X']) ? intval($_POST['X']) : 0;
    
    $array = [];
    for ($i = 0; $i < 12; $i++) {
        $array[] = rand(10, 100);
    }

    $lessCount = 0;
    $greaterCount = 0;

    foreach ($array as $num) {
        if ($num < $X) {
            $lessCount++;
        } elseif ($num > $X) {
            $greaterCount++;
        }
    }

    echo "შეტანილი რიცხვი X: $X<br>";
    echo "მასივი: " . implode(", ", $array) . "<br>";
    echo "X-ზე ნაკლები ელემენტების რაოდენობა: $lessCount<br>";
    echo "X-ზე მეტი ელემენტების რაოდენობა: $greaterCount<br>";
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label >
            x რიცხვი: <input type="number" name ="X">required
        </label>
        <button type="submit"> დათვლა</button>
    </form>
</body>
</html>