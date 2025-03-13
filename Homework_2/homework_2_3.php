<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6x5 მატრიცა</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>6x5 მატრიცა (ელემენტები = ინდექსების ჯამი)</h2>

<table>
    <?php
    $rows = 6; 
    $cols = 5; 

    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $value = $i + $j; 
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
