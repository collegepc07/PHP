<?php
setcookie("user", "sujan", time() - 3600, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_COOKIE['user'])) {
        echo "User cookie is set.<br>";
    } else {
        echo "User cookie is not set.<br>";
    }
    ?>
</body>
</html>