<?php
require_once '../app/Model/Usuario.php';

$email = 'nicolas@nicolas.com';
$usuario = Usuario::findByEmail($email);

echo "<pre>";
var_dump($usuario);
echo "</pre>";
