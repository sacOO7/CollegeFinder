<?php
$to = "smitsheth10@yahoo.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: smitsheth10@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt);
?> 