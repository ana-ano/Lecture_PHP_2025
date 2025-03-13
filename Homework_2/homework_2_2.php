<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $X = isset($_POST['X']) ? intval($_POST['X']) : 1;

    $matrix = [];
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $matrix[$i][$j] = rand(10, 100);
        }
    }

    echo "<h3>მატრიცა:</h3>";
    echo "<table border='1' cellpadding='5'>";
    foreach ($matrix as $row) {
        echo "<tr>";
        foreach ($row as $num) {
            echo "<td>$num</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<h3>მთავარი დიაგონალის ზემოთ არსებული ელემენტები:</h3>";
    echo "<table border='1' cellpadding='5'>";
    for ($i = 0; $i < 4; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 4; $j++) {
            if ($j > $i) {
                echo "<td>{$matrix[$i][$j]}</td>";
            } else {
                echo "<td> - </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<h3>X-ის ($X) ჯერადი რიცხვები:</h3>";
    echo "<table border='1' cellpadding='5'><tr>";
    foreach ($matrix as $row) {
        foreach ($row as $num) {
            if ($num % $X == 0) {
                echo "<td>$num</td>";
            }
        }
    }
    echo "</tr></table>";

    $sum = 0;
    $product = 1;
    $count = 0;
    $max = PHP_INT_MIN;
    $min = PHP_INT_MAX;

    foreach ($matrix as $row) {
        foreach ($row as $num) {
            $sum += $num;
            $product *= $num;
            $count++;
            if ($num > $max) $max = $num;
            if ($num < $min) $min = $num;
        }
    }
    
    $average = $sum / $count;
    $range = $max - $min;

    echo "<h3>მატრიცის მახასიათებლები:</h3>";
    echo "🔹 ელემენტების ჯამი: $sum<br>";
    echo "🔹 ელემენტების ნამრავლი: $product<br>";
    echo "🔹 საშუალო არითმეტიკული: $average<br>";
    echo "🔹 განი (მაქსიმუმი - მინიმუმი): $range<br>";

    echo "<h3>თითოეული ელემენტის ციფრთა ჯამი:</h3>";
    echo "<table border='1' cellpadding='5'>";
    foreach ($matrix as $row) {
        echo "<tr>";
        foreach ($row as $num) {
            $digitSum = array_sum(str_split($num)); 
            echo "<td>$digitSum</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

<form method="post">
    <label>X რიცხვი: <input type="number" name="X" required></label>
    <button type="submit">დათვლა</button>
</form>
