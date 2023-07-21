<?php
$name = readline('Enter password: ');
$passmd5 = md5($name);
print("md5 password: " .$passmd5 . "\n");
?>