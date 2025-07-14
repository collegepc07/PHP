<!-- search_form.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Search Student</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
        }
    </style>
</head>
<body>

<h2>Search Student</h2>

<form method="POST" action="">
    Enter Roll No: <input type="text" name="roll"> <br><br>
    Enter First Name: <input type="text" name="Fname"> <br><br>
    Enter Last Name: <input type="text" name="Lname"> <br><br>
    <input type="submit" value="Search">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_con.php");

    $conditions = [];
    $roll = mysqli_real_escape_string($conn, $_POST['roll']);
    $fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['Lname']);

    if (!empty($roll)) {
        $conditions[] = "Rollno = '$roll'";
    }
    if (!empty($fname)) {
        $conditions[] = "FName LIKE '%$fname%'";
    }
    if (!empty($lname)) {
        $conditions[] = "LName LIKE '%$lname%'";
    }

    if (count($conditions) > 0) {
        $where = implode(" AND ", $conditions);
        $query = "SELECT * FROM student WHERE $where";
        $data = mysqli_query($conn, $query);

        if (mysqli_num_rows($data) > 0) {
            echo "<table>
                    <tr>
                        <th>Rollno</th>
                        <th>FName</th>
                        <th>LName</th>
                    </tr>";
            while ($result = mysqli_fetch_assoc($data)) {
                echo "<tr>
                        <td>{$result['Rollno']}</td>
                        <td>{$result['FName']}</td>
                        <td>{$result['LName']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No student found with the given information.</p>";
        }
    } else {
        echo "<p>Please enter at least one search field.</p>";
    }
}
?>

</body>
</html>
