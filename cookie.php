<?php
setcookie('username', 'Ram', time() + 3600, "/");
?>

<html>
<body>
    <?php
    if (isset($_COOKIE['username'])) {
        echo "Username: " . $_COOKIE['username'] . "<br>";
    } else {
        echo "Username cookie is not set.<br>";
    }
?>
</body>
</html>