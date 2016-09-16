<?php

session_start();

$_SESSION['City']=$_POST["region"];
$_SESSION['Caste']=$_POST["caste"];
$_SESSION['Course']=$_POST["course"];
$_SESSION['Round']=$_POST["round"];
$_SESSION['Rank']=$_POST["rank"];

if(isset($_POST["search"]))
{
	header("Location: http://localhost:1234/Result.php");
}
?>