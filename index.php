<?php

require_once ("config.php");

$sam = new Usuario();

$sam->loadById(1);

echo $sam;

?>