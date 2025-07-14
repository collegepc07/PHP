<?php
$servername="localhost";
$username="root";
$password="";
$dname="inovyra";
$conn=mysqli_connect($servername,$username, $password,$dname);
if($conn)
{ echo"Connection OK";
}else
{
die("Connection Failed because".mysqli_connect_error());
}
?>