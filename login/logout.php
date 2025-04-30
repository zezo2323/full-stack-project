<?php

session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()])){
    setcookie('session_token', '',time() - 42000,'/');

}

session_destroy();

header("Location: ../Login1.html");
exit;
?>
