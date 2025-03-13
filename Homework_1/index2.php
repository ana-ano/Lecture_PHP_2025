<?php
session_start();

// სესიის შემოწმება და შექმნა
if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [];
}

// POST მეთოდის დამუშავება
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST["name"]));
    $surname = htmlspecialchars(trim($_POST["surname"]));
    $course = htmlspecialchars(trim($_POST["course"]));
    $semester = htmlspecialchars(trim($_POST["semester"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $grade = htmlspecialchars(trim($_POST["grade"]));
    $lecturer_name = htmlspecialchars(trim($_POST["lecturer_name"]));
    $lecturer_surname = htmlspecialchars(trim($_POST["lecturer_surname"]));
    $dean_name = htmlspecialchars(trim($_POST["dean_name"]));
    $dean_surname = htmlspecialchars(trim($_POST["dean_surname"]));

    // შეფასება და მონაცემების დამატება სესიაში
    if (!empty($name) && !empty($surname) && !empty($course) && !empty($semester) && !empty($subject) && !empty($grade) && !empty($lecturer_name) && !empty($lecturer_surname) && !empty($dean_name) && !empty($dean_surname)) {
        // შემოწმება, რომ ნიშანი იყოს 0-დან 100-მდე
        if ($grade >= 0 && $grade <= 100) {
            // შეფასების ცხრილი
            $evaluation = '';
            if ($grade >= 90) {
                $evaluation = 'A - ფრიადი';
            } elseif ($grade >= 80) {
                $evaluation = 'B - ძალიან კარგი';
            } elseif ($grade >= 70) {
                $evaluation = 'C - კარგი';
            } elseif ($grade >= 60) {
                $evaluation = 'D - დასაშვები';
            } else {
                $evaluation = 'F - უარყოფითი';
            }

            $_SESSION["students"][] = [
                "name" => $name,
                "surname" => $surname,
                "course" => $course,
                "semester" => $semester,
                "subject" => $subject,
                "grade" => $grade,
                "evaluation" => $evaluation,
                "lecturer_name" => $lecturer_name,
                "lecturer_surname" => $lecturer_surname,
                "dean_name" => $dean_name,
                "dean_surname" => $dean_surname
            ];
        } else {
            echo "<p style='color: red;'>🔴 ნიშანი უნდა იყოს 0-დან 100-მდე!</p>";
        }
    } else {
        echo "<p style='color: red;'>🔴 ყველა ველი უნდა იყოს შევსებული!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ნიშნების უწყისი</title>
    <link rel="stylesheet" href="styles.css"> <!-- CSS ფაილის დამატება -->
</head>
<body>

<div class="container">
    <h2>🔖 სტუდენტების ნიშნების უწყისი</h2>

    <form method="POST">
        <label>📌 სახელი:</label>
        <input type="text" name="name" required>

        <label>📌 გვარი:</label>
        <input type="text" name="surname" required>

        <label>📌 კურსი:</label>
        <select name="course" required>
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
        </select>

        <label>📌 სემესტრი:</label>
        <select name="semester" required>
            <option value="I">I</option>
            <option value="II">II</option>
        </select>

        <label>📌 სასწავლო კურსი:</label>
        <input type="text" name="subject" required>

        <label>📌 მიღებული ნიშანი:</label>
        <input type="number" name="grade" min="0" max="100" required>

        <label>📌 ლექტორის სახელი:</label>
        <input type="text" name="lecturer_name" required>

        <label>📌 ლექტორის გვარი:</label>
        <input type="text" name="lecturer_surname" required>

        <label>📌 დეკანის სახელი:</label>
        <input type="text" name="dean_name" required>

        <label>📌 დეკანის გვარი:</label>
        <input type="text" name="dean_surname" required>

        <button type="submit">➕ დამატება</button>
    </form>

    <?php if (!empty($_SESSION["students"])): ?>
        <table>
            <tr>
                <th>სახელი</th>
                <th>გვარი</th>
                <th>კურსი</th>
                <th>სემესტრი</th>
                <th>სასწავლო კურსი</th>
                <th>მიღებული ნიშანი</th>
                <th>შეფასება</th>
                <th>ლექტორის სახელი</th>
                <th>ლექტორის გვარი</th>
                <th>დეკანის სახელი</th>
                <th>დეკანის გვარი</th>
            </tr>
            <?php foreach ($_SESSION["students"] as $student): ?>
                <tr>
                    <td><?php echo $student["name"]; ?></td>
                    <td><?php echo $student["surname"]; ?></td>
                    <td><?php echo $student["course"]; ?></td>
                    <td><?php echo $student["semester"]; ?></td>
                    <td><?php echo $student["subject"]; ?></td>
                    <td><?php echo $student["grade"]; ?></td>
                    <td><?php echo $student["evaluation"]; ?></td>
                    <td><?php echo $student["lecturer_name"]; ?></td>
                    <td><?php echo $student["lecturer_surname"]; ?></td>
                    <td><?php echo $student["dean_name"]; ?></td>
                    <td><?php echo $student["dean_surname"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<form action="index3.php" method="get">
        <button type="submit">გადადი მესამე გვერდზე</button>
    </form>
</body>
</html>