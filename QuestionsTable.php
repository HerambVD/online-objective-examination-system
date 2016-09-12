<?php
$servername="localhost";
$username="root";
$password="";
$dbname="OnlineExam";
$conn= mysqli_connect($servername,$username,$password,$dbname);
if (!$conn)
{
die("Connection Failed". mysqli_connect_error());
}
$sql= "CREATE TABLE Questions (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Subject VARCHAR(30) NOT NULL, Question VARCHAR(100) NOT NULL, optiona VARCHAR(30) NOT NULL, optionb VARCHAR(30) NOT NULL, optionc VARCHAR(30) NOT NULL, optiond VARCHAR(30) NOT NULL, answer VARCHAR(30) NOT NULL)";
if (mysqli_query($conn,$sql))
{
    echo "Table Questions Created Successfully";
}
else
{
    echo "Table Creating Error".mysqli_error($conn);
}
?>