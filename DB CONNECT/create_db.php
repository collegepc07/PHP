<?php
$servername="localhost";
$username="root";
$password="";
$conn=mysqli_connect ($servername,$username, $password);
$sql="CREATE DATABASE inovyra";
$result=mysqli_query ($conn,$sql);
if($result)
{
echo"Database has been created successfully";
}
else
{
die("Cannot create database because".mysqli_error($conn));
}
?>