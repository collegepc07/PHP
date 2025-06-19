<?php
session_start();
$_SESSION['username'] = 'Ram';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Setter</title>
</head>
<body>
    <?php
    echo "Session variable 'username' is set to: " . $_SESSION['username'] . "<br>";
    ?>
</body>
</html>