<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassWork 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table class="table-1">
        <tr>
            <th>Questions</th>
            <th>Answers</th>
            <th>Max Point</th>
        </tr>
        <?php 
        include 'questions.php'; 

        foreach ($question as $q) { ?>
            <tr>
                <td><?php echo $q['question']; ?></td>
                <td><input type="text" name="answer"></td>
                <td><?php echo $q['maxpoint']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>



