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
        <div>
            <?php
                function sum($a, $b, $c){
                    return $a + $b + $c;
                }

                function product($a, $b, $c){
                    return $a * $b * ($c === null ? 1 : $c);  
                }

                function check_data($d, $default = null){
                    return empty($d) ? $default : $d;
                }

                if(isset($_POST['sum'])){
                    $n1 = check_data($_POST['n1']);
                    $n2 = check_data($_POST['n2']);
                    $n3 = check_data($_POST['n3']);
                    echo "<h3>Sum = " . sum($n1, $n2, $n3) . "</h3>";
                }

                if(isset($_POST['product'])){
                    $n1 = check_data($_POST['n1']);
                    $n2 = check_data($_POST['n2']);
                    $n3 = check_data($_POST['n3']);
                    echo "<h3>Product = " . product($n1, $n2, $n3) . "</h3>";
                }
            ?>
        </div>
        <input type="number" placeholder="number1" name="n1">
        <br><br>
        <input type="number" placeholder="number2" name="n2">
        <br><br>
        <input type="number" placeholder="number3" name="n3">
        <br><br>
        <button name="sum">ჯამი</button>
        <button name="product">ნამრავლი</button>
    </form>
</body>
</html>



