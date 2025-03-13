<?php
session_start();

if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"]) && isset($_GET["salary"])) {
    $name = htmlspecialchars($_GET["name"]);
    $surname = htmlspecialchars($_GET["surname"]);
    $position = htmlspecialchars($_GET["position"]);
    $salary = floatval($_GET["salary"]);
    $taxPercent = floatval($_GET["tax"]);

    $taxAmount = ($salary * $taxPercent) / 100;
    $netSalary = $salary - $taxAmount;

    // მონაცემების შენახვა სესიაში
    $_SESSION["users"][] = [
        "name" => $name,
        "surname" => $surname,
        "position" => $position,
        "salary" => $salary,
        "taxPercent" => $taxPercent,
        "taxAmount" => $taxAmount,
        "netSalary" => $netSalary
    ];
}
?>

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>სახელფასო უწყისი</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h2>სახელფასო უწყისი</h2>
    <form method="GET">
        <label>სახელი: <input type="text" name="name" required></label>
        <label>გვარი: <input type="text" name="surname" required></label>
        <label>თანამდებობა: <input type="text" name="position" required></label>
        <label>ხელფასი (₾): <input type="number" name="salary" required></label>
        <label>საშემოსავლოს %:
            <select name="tax">
                <option value="20">20%</option>
                <option value="15">15%</option>
                <option value="10">10%</option>
                <option value="5">5%</option>
            </select>
        </label>
        <button type="submit">გამოთვლა</button>
    </form>

    <?php if (!empty($_SESSION["users"])): ?>
        <table>
            <tr>
                <th>სახელი</th>
                <th>გვარი</th>
                <th>თანამდებობა</th>
                <th>ხელფასი (₾)</th>
                <th>საშემოსავლო (% - ₾)</th>
                <th>დარიცხული ხელფასი (₾)</th>
            </tr>
            <?php foreach ($_SESSION["users"] as $user): ?>
                <tr>
                    <td><?php echo $user["name"]; ?></td>
                    <td><?php echo $user["surname"]; ?></td>
                    <td><?php echo $user["position"]; ?></td>
                    <td><?php echo number_format($user["salary"], 2); ?> ₾</td>
                    <td><?php echo $user["taxPercent"]; ?>% (<?php echo number_format($user["taxAmount"], 2); ?> ₾)</td>
                    <td><?php echo number_format($user["netSalary"], 2); ?> ₾</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <form action="index2.php" method="get">
        <button type="submit">გადადი მეორე გვერდზე</button>
    </form>

</body>
</html>