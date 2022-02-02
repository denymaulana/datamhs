<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

// 'id' 'nilainya kosong'
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: login.php");
exit;

?>