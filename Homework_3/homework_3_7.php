<?php
function vector($a, $b, $M) {
    $result = [];
    for ($i = 0; $i < $M; $i++) { 
        $result[] = rand($a, $b);
    }
    return $result;
}

if (isset($_POST['button'])){
    if (!empty($_POST['M']) && !empty($_POST['a']) && !empty($_POST['b'])){
        $M = $_POST['M'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $vector = vector($a, $b, $M);
        
        echo "Generated vector: " . implode(",", $vector);
    }
    else {
        echo "Please input all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.7</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        form input {
            margin: 5px;
            padding: 8px;
            font-size: 14px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <form method="post">
        <label for="M">Enter M:</label>
        <input type="number" name="M" id="M" placeholder="M" required>
        <br>
        <label for="a">Enter a:</label>
        <input type="number" name="a" id="a" placeholder="a" required>
        <br>
        <label for="b">Enter b:</label>
        <input type="number" name="b" id="b" placeholder="b" required>
        <br>
        <button name="button">Generate Vector</button>
    </form>

    <div class="message">
        <?php
        if (isset($vector)) {
            echo "Generated vector: " . implode(", ", $vector);
        }
        ?>
    </div>

</body>
</html>
