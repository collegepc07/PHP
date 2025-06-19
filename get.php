<?php 
if(isset($_GET['Fname']) && isset($_GET['Lname']) && isset($_GET['email']) && isset($_GET['password'])){
    $Fname = $_GET['Fname'];
    $Lname = $_GET['Lname'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    echo "Hello " . $Fname . " " . $Lname . "<br>";
    echo "Your email is " . $email . "<br>";
    echo "Your password is " . $password;
}
?>