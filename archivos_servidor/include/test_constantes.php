<?php
require('../constantes.php');
$email = "test@micasa.com";
$domain = array_pop(explode('@', $email));

echo $domain;