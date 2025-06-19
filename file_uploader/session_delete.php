<?php
session_start();
session_unset();      
session_destroy();    
echo "Session is destroyed";
?>
<html>
    <head>
        <title>Session Destroyer</title>
    </head>
    <!-- <body>
        <h1>Session is destroyed</h1>
    </body> -->
</html>
