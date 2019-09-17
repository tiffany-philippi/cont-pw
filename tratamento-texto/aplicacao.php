<?php
// navega entre diretórios:
// chdir("..\\");
// chdir(".\\arq");

$caminho = getcwd();

$arquivo = "paises.txt";
$arq_array = array();
$arq = fopen($caminho . "\\" . $arquivo, "r");

// var_dump($arq_array);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Tratamento</title>
  <style>
    .container {
      background-color: #f3f3f3;
      border-radius: 13px;
      width: 80%;
      margin: 0 auto;
      padding: 15px;
      display: flex;
      justify-content: center;
    }
    .content {
      background-color: #fff;
      border: 1px solid #afafaf;
      border-radius: 6px;
      padding: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="content">
      <?php 
        while(!feof($arq)) {
            $linha = fgets($arq) . "<br>";
            array_push($arq_array, explode(chr(9), $linha));
        }
        fclose($arq);
        echo "<pre>";
        print_r($arq_array);
        echo "</pre>";
      ?>    
    </div>
  </div>
</body>
</html>
