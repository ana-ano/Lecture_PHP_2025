<?php
function generateMatrix($M, $N, $a, $b){
    $matrix = [];
    for ($i = 0; $i < $M; $i++) { 
        for ($j = 0; $j < $N; $j++) { 
            $matrix[$i][$j] = rand($a, $b);
        }
    }
    return $matrix;
}

if (isset($_POST['button'])){
    if (empty($_POST['M']) || empty($_POST['N']) || empty($_POST['a']) || empty($_POST['b'])){
        echo "Enter all values";
    }
    else {
        $M = $_POST['M'];
        $N = $_POST['N'];
        $a = $_POST['a'];
        $b = $_POST['b'];

        $matrix = generateMatrix($M, $N, $a, $b);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.8</title>
    <style>
        .tableDesign {
            border-collapse: collapse;
            border: 1px solid black;
            width: 600px;
        }

        .tableDesign tr td {
            border: 1px solid rgb(36, 196, 121);
            background-color: aquamarine;
            width: 100px;
            text-align: center;
            padding: 10px;
        }

        input, button {
            margin: 5px;
            padding: 8px;
            font-size: 14px;
            text-align: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            margin: 20px;
        }
    </style>
</head>
<body>

    <form method="post">
        Input M: <input type="number" name="M" placeholder="M">
        <br>
        Input N: <input type="number" name="N" placeholder="N">
        <br>
        Input a: <input type="number" name="a" placeholder="a">
        <br>
        Input b: <input type="number" name="b" placeholder="b">
        <br>
        <button name="button">Generate Matrix</button>
    </form>

    <?php
    if (!empty($matrix)){
        echo "<h3>Generated matrix:</h3>";
        echo "<table class='tableDesign'>";
        foreach ($matrix as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>

</body>
</html>
