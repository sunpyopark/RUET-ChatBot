<?php

$host="subserve-chatbot-mysql";
$user="root";
$pass="password";
$db="chat";

$con=mysqli_connect($host,$user,$pass,$db);

if(!$con)
{
	print("Not Connected<br>".mysql_error());

}
else
{
	//echo("Connected");
}






?>
