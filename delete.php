
<?php

session_start();

$m=new MongoClient();
$db=$m->project;
$collection=$db->user_info;
$collection->remove(array("Username"=>$_SESSION['Username']));

header('Location:Login.php');

?>