<?php
include("db_con.php");

$query = "SELECT * FROM `student`";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Data</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Student List</h2>

<table>
    <tr>
        <th>Rollno</th>
        <th>FName</th>
        <th>LName</th>
    </tr>

    <?php
    while ($result = mysqli_fetch_assoc($data)) {
        echo "<tr>";
        echo "<td>" . $result["Rollno"] . "</td>";
        echo "<td>" . $result["FName"] . "</td>";
        echo "<td>" . $result["LName"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
