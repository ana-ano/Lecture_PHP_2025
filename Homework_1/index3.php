<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswers = 0;

    // ტესტის შეკითხვები
    if (isset($_POST['question1']) && $_POST['question1'] == 'C') {
        $correctAnswers++;
    }
    if (isset($_POST['question2']) && $_POST['question2'] == 'B') {
        $correctAnswers++;
    }
    if (isset($_POST['question3']) && $_POST['question3'] == 'C') {
        $correctAnswers++;
    }

    // ღია კითხვები
    if (isset($_POST['question4']) && strtolower(trim($_POST['question4'])) == '1991 წელს საქართველოს დამოუკიდებლობა აღდგა') {
        $correctAnswers++;
    }
    if (isset($_POST['question5']) && strtolower(trim($_POST['question5'])) == 'შხარა') {
        $correctAnswers++;
    }

    echo "<p>სწორი პასუხების რაოდენობა: " . $correctAnswers . "/5</p>";
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>სტუდენტის შემოწმება</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>სტუდენტის შემოწმება</h2>

<form method="POST">
    <!-- 1. ტესტი -->
    <div class="question">
        <label>1. რომელია საქართველოს დედაქალაქი?</label>
        <input type="radio" name="question1" value="A"> ქუთაისი<br>
        <input type="radio" name="question1" value="B"> ბათუმი<br>
        <input type="radio" name="question1" value="C"> თბილისი<br>
        <input type="radio" name="question1" value="D"> გორი
    </div>

    <!-- 2. ტესტი -->
    <div class="question">
        <label>2. რომელ წელს იყო დიდგორის ბრძოლა?</label>
        <input type="radio" name="question2" value="A"> 1204<br>
        <input type="radio" name="question2" value="B"> 1121<br>
        <input type="radio" name="question2" value="C"> 1215<br>
        <input type="radio" name="question2" value="D"> 1189
    </div>

    <!-- 3. ტესტი -->
    <div class="question">
        <label>3. ვინ დაწერა "დიდოსტატის მარჯვენა"?</label>
        <input type="radio" name="question3" value="A"> ილია ჭავჭავაძე<br>
        <input type="radio" name="question3" value="B"> აკაკი წერეთელი<br>
        <input type="radio" name="question3" value="C"> კონსტანტინე გამსახურდია<br>
        <input type="radio" name="question3" value="D"> გიორგი ლეონიძე
    </div>

    <!-- 4. ღია კითხვა -->
    <div class="question">
        <label>4. რა მოხდა 1991 წელს საქართველოში? (ღია კითხვა)</label>
        <input type="text" name="question4">
    </div>

    <!-- 5. ღია კითხვა -->
    <div class="question">
        <label>5. რომელია საქართველოს უმაღლესი მწვერვალი? (ღია კითხვა)</label>
        <input type="text" name="question5">
    </div>

    <button type="submit">შეფასება</button>
</form>

</body>
</html>

