<?php 
     function f1(){
        echo " <h1>Hello</h1>";
        echo " <h1>Hello Laravel</h1>";
     }

     function f2(){
        return "<h1>Hello</h1>";
        echo " <h1>Hello</h1>";
     }
     function f3 ($a,$b,$c=9){
        echo $a+$b+$c;
     }

     //f3(3,4,8);
    
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>ფორმა</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
    <form method="post">
        <label>number1:</label>
        <input type="text" name="number1"><br><br>

        <label>number2:</label>
        <input type="text" name="number2"><br><br>

        <label>number3:</label>
        <input type="text" name="number3"><br><br>

        <button type="submit" name="calculate">გამოთვლა</button>
        <button type="reset">გასუფთავება</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        function sumNumbers($a, $b, $c = 0) {
            return $a + $b + $c;
        }

        $num1 = $_POST['number1'];
        $num2 = $_POST['number2'];
        $num3 = $_POST['number3'];

        if (is_numeric($num1) && is_numeric($num2) && is_numeric($num3)) {
            $result = sumNumbers($num1, $num2, $num3);
            echo "<p>რიცხვების ჯამი: $result</p>";
        } else {
            echo "<p>გთხოვთ, შეიყვანოთ მხოლოდ რიცხვები!</p>";
        }
    }
    ?>
</body>
</html>


