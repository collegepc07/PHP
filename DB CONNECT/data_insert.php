<?php
include("db_con.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$rn=$_POST["roll"];
$fn=$_POST["fname"];
$ln=$_POST["lname"];
$query="INSERT INTO student values('$rn','$fn','$ln')";
if(mysqli_query($conn,$query))
{
echo"
<script> alert('Data has been successfully Inserted')</script>
";
}
}
?>
<html>
<head>
<style>
            body {
                position: relative;
                margin: 100px;
                font-family: cursive;
            }
            .container {
                position: relative;
                margin: 100px;
                height: 250px;
                width: 400px;
                background-color:rgb(255, 255, 255);
                border-radius: 10px;
                box-shadow: 0 9px 14px rgba(8, 7, 7, 0.1);
                padding: 20px;
                text-align: center;
                font-size: 16px;


            }input[type="file"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
            }
            input[type="submit"] {
                background-color:rgb(   255, 255, 255);
                color: #000;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-family: cursive;
                font-size: 16px;
                margin-top: 20px; 
                margin-bottom: 20px;
            }
            </style>
</head>
<body>
<div class="container">
<form action="" method="POST">
Rollno:
<input type="text" name="roll" value=""> <br><br>
FName:
<input type="text" name="fname" value=""><br><br>
LName:
<input type="text" name="lname" value=""><br><br>
<input type="submit" name="submit" value="Submit">
</form>
</div>
</body>
</html>