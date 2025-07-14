<?php

//Write to text file
//$serialize_post_data = serialize($_REQUEST);
$file = fopen("test.txt","w");
//echo fwrite($file,$serialize_post_data);
echo fwrite($file,'Test');
fclose($file);

?>