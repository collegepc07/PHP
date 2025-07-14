<?php
include("db_con.php");
$sql="CREATE TABLE `Student`
( `Rollno` INT(8) NOT NULL AUTO_INCREMENT ,
`FName` VARCHAR(15) NOT NULL ,
`LName` VARCHAR(10) NOT NULL ,
PRIMARY KEY (`Rollno`))";
$result=mysqli_query($conn, $sql);
if ($result) {
 echo "Table created successfully";
} else {
 echo "Error creating table because:::--- " . mysqli_error($conn);
}
?>