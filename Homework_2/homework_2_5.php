<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP ფორმის ვალიდაცია</title>
</head>
<body>

<?php
$name = $email = $website = $comment = $gender = "";
$nameErr = $emailErr = $genderErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "სახელი აუცილებელია";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "ელ.ფოსტა აუცილებელია";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "არასწორი ელ.ფოსტა";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (!empty($_POST["website"])) {
        $website = htmlspecialchars($_POST["website"]);
    }

    if (!empty($_POST["comment"])) {
        $comment = htmlspecialchars($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "სქესის არჩევა აუცილებელია";
    } else {
        $gender = htmlspecialchars($_POST["gender"]);
    }
}
?>

<h2>PHP ფორმის ვალიდაცია</h2>
<p><span style="color: red;">* აუცილებელი ველი</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    სახელი: <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color: red;">* <?php echo $nameErr;?></span>
    <br><br>

    ელ.ფოსტა: <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color: red;">* <?php echo $emailErr;?></span>
    <br><br>

    ვებსაიტი: <input type="text" name="website" value="<?php echo $website; ?>">
    <br><br>

    კომენტარი: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    <br><br>

    სქესი:
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked";?>> ქალი
    <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked";?>> კაცი
    <input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked";?>> სხვა
    <span style="color: red;">* <?php echo $genderErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="გაგზავნა">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($genderErr)) {
    echo "<h3>შეტანილი მონაცემები:</h3>";
    echo "სახელი: $name <br>";
    echo "ელ.ფოსტა: $email <br>";
    echo "ვებსაიტი: $website <br>";
    echo "კომენტარი: $comment <br>";
    echo "სქესი: $gender <br>";
}
?>

</body>
</html>
