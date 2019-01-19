<?php

require_once ("config.php");

/*$list = Usuario::getList();
echo json_encode($list);*/

/*$p = Usuario::search("h");
echo json_encode($p);*/

$user = new Usuario();

$user->login("samuel","12345");

echo $user;
?>