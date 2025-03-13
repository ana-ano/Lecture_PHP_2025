<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10x10 Random Number Table</title>
</head>
<body>

    <?php
    function generateTable10x10() {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        for ($i = 0; $i < 10; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 10; $j++) {
                $randomNumber = rand(10, 99);
                echo "<td>$randomNumber</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    generateTable10x10();
    ?>

</body>
</html>

