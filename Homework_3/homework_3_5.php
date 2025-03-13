<?php
function countDigits($number) {
    if (!is_numeric($number)) {
        return "შეიყვანეთ მხოლოდ რიცხვი!";
    }
    
    $number = abs(intval($number)); 
    return strlen((string) $number);
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>რიცხვის ნიშანობა</title>
</head>
<body>
    <h3>შეიყვანეთ რიცხვი და გაიგეთ რამდენ ნიშნაა</h3>

    <form method="POST">
        <input type="text" name="input_number" required>
        <input type="submit" value="გაარკვიე">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_number = $_POST['input_number'];
        echo "<p>რიცხვი არის " . countDigits($input_number) . " ნიშნა.</p>";
    }
    ?>
</body>
</html>
