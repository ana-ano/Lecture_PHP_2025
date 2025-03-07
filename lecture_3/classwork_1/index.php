<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Form</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $answers = $_POST["answers"];

    echo "<h2>Student: $first_name $last_name</h2>";
    echo "<h3>Answers Submitted:</h3>";
    echo "<ul>";
    
    $questions = [
        "What is HTML?",
        "What is React?",
        "What is PHP?",
        "What is CSS?",
        "What is Angular?",
        "What is JS?"
    ];

    for ($i = 0; $i < count($questions); $i++) {
        echo "<li><strong>{$questions[$i]}</strong>: {$answers[$i]}</li>";
    }

    echo "</ul>";
} else {
?>

    <form action="" method="post">
        <table>
            <tr>
                <th>Questions</th>
                <th>Answers</th>
                <th>Max Point</th>
            </tr>
        
            <?php
                $questions = [
                    "What is HTML?" => 8,
                    "What is React?" => 9,
                    "What is PHP?" => 10,
                    "What is CSS?" => 10,
                    "What is Angular?" => 10,
                    "What is JS?" => 8
                ];
                
                foreach ($questions as $question => $points) {
                    echo "<tr>";
                    echo "<td>$question</td>";
                    echo "<td><input type='text' name='answers[]' required></td>";
                    echo "<td>$points</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <br>
        Student: <input type="text" name="first_name" placeholder="name" required>
        <input type="text" name="last_name" placeholder="lastname" required>
        <button type="submit">Send</button>
    </form>

<?php
}
?>

</body>
</html>