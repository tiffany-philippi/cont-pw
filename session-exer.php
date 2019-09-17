<?php
session_start();

if(!isset($_SESSION)) {
  session_start();
}

$_SESSION['nameUser'] = 'tiffany_philippi';
$_SESSION['passUser'] = '1q2w3e4r';
$_SESSION['email'] = 'tiffany@email.com';

echo "<br>";
foreach($_SESSION as $key => $valor){
  echo "{$key} - {$valor}<br>";
}

echo "<a href='session-get.php'>Retomar sessão</a>";

?>
