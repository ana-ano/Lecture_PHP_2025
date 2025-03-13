<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>მანქანების სია</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>მანქანების სია</h2>

<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Color</th>
        <th>Mileage</th>
        <th>Status</th>
    </tr>
    <?php
    $cars = array(
        array("Make"=>"Toyota", "Model"=>"Corolla", "Color"=>"White", "Mileage"=>24000, "Status"=>"Sold"),
        array("Make"=>"Toyota", "Model"=>"Camry", "Color"=>"Black", "Mileage"=>56000, "Status"=>"Available"),
        array("Make"=>"Honda", "Model"=>"Accord", "Color"=>"White", "Mileage"=>15000, "Status"=>"Sold")
    );

    $count = count($cars); 

    for ($i = 0; $i < $count; $i++) {
        echo "<tr>";
        echo "<td>{$cars[$i]['Make']}</td>";
        echo "<td>{$cars[$i]['Model']}</td>";
        echo "<td>{$cars[$i]['Color']}</td>";
        echo "<td>{$cars[$i]['Mileage']}</td>";
        echo "<td>{$cars[$i]['Status']}</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
