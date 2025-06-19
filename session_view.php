<?php
$cookie_name="user";
$cookie_value="Web Technology";
setcookie($cookie_name,$cookie_value,time()+(4800),"/");
?>
<html>
    <head>
        <title>Session Viewer</title>
    </head>
    <body>
        <?php
        if(isset($_COOKIE[$cookie_name])){
            echo $_COOKIE[$cookie_name];

        }
        else{
            echo"Cookie is not set";
        }
        ?>
        </body>
    </html>

<?php
$cookie_name="user";
$cookie_value="Web Technology";
setcookie($cookie_name,$cookie_value,time()+(4800),"/");
?>
<html>
    <body>
        <?php
        if(isset($_COOKIE[$cookie_name])){
            echo $_COOKIE[$cookie_name];

        }
        else{
            echo"Cookie is not set";
        }
        ?>
        </body>
    </html>