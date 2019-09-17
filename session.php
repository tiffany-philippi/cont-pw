<?php
session_start();
var_dump($_SESSION);
//Verifica se a sessão está inicializada.
if(!isset($_SESSION)) {
  session_start();
  echo "Sessão criada<br>";
} else {
  echo session_status();
  // 2 - ativo
  // 1 - não criada
  // 0 - desativo
}
//ou:
// if(session_start() !== PHP_SESSION_ACTIVE) {
//  session_start();
// }

$_SESSION['nameUser'] = 'tiffany_philippi';
$_SESSION['passUser'] = '1q2w3e4r';

echo "<br>";
foreach($_SESSION as $key => $valor){
echo "{$key} - {$valor}<br>";
}

echo "<a href='session-exer.php'>Avançar</a>";
?>
