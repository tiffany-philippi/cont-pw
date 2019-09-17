<?php

//setcookie() sempre deve ser o primeiro comando.

setcookie("nome","Joana");
setcookie("cidade","Florianopolis");
setcookie("idade","28");
setcookie("instituicao","senai");

print_r($_COOKIE);
//não pode ser recuperado na mesma página
echo "<br>";
foreach($_COOKIE as $nome => $valor){
echo "{$nome} - {$valor}<br>";
}
?>
