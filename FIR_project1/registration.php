<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'Registration';
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn)
{
	die ("Not Connected...".mysqli_connect_error());
}
echo "Connection Successfully....";
echo "</br>";

$sql = "CREATE database Registration";
if(mysqli_query($conn, $sql))
{
	echo "Databse Created...";
}
else{
echo "Database Is Not Created...";
}
echo "</br>";

$sql = "create table userDetails(id INT AUTO INCREMENT,user_name VARCHAR(20) NOT NULL, email VARCHAR(20) NOT NULL, password VARCHAR(20) NOT NULL )";
if(mysqli_query($conn, $sql))
{
	echo "Table Created..";
}
else
{
	echo "Table Not Created...";
}
echo "</br>";


$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO Employee(user_name,email, password) VALUES('$namename', $email, $password)";
if(mysqli_query($conn, $sql))
{
	echo "Data Inserted...";
}
else
{
	echo "Data Not Inserted...";
} 


?>