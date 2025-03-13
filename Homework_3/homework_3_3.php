<?php
session_start(); 

if (!isset($_SESSION['security_code'])) {
    $_SESSION['security_code'] = rand(10000, 99999);
}

function checkSecurityCode($inputCode) {
    if (!is_numeric($inputCode) || strlen($inputCode) != 5) {
        echo "შეცდომა: უნდა იყოს 5 ციფრი!"; // Error: It must be 5 digits!
        return;
    }
    
    if ($inputCode == $_SESSION['security_code']) {
        echo "კოდი სწორია!"; // The code is correct!
    } else {
        echo "არასწორი კოდი!"; // Incorrect code!
    }
}
?>

<h3>შეიყვანეთ დამცავი კოდი:</h3> <!-- Enter security code: -->
<form method="POST">
    <input type="text" name="user_code" required>
    <input type="submit" value="შემოწმება"> <!-- Check -->
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    checkSecurityCode($_POST['user_code']);
}
?>
