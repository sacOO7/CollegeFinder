<?php
$m=new MongoClient();
$db=$m->project;
$collection=$db->user_info;
try
{
    $document=array("Username"=>$_POST["Username"],"Password"=>$_POST["Password"],"Email"=>$_POST["Email"]);
    $collection->insert($document);
    header("Location: http://localhost:1234/Login.php");
}
catch(Exception $e)
{
    $nameErr="Username already taken";
    var_dump($e->getMessage());
}

?>