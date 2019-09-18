<?php
//pega o diretório atual:
$diretorio = getcwd();

$stopWords = "stop-words.txt";
$leitura = "leitura.txt";
$valencia = "valencia.txt";
$count = 0;
$count_retiradas = 0;
$lista_retiradas = "";
$stg_positiva = "";
$stg_negativa = "";
$cont_positiva = 0;
$cont_negativa = 0;
$arq_array = array();
$arq_words = file($diretorio . "\\" . $stopWords, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES | FILE_TEXT);
$arq_leitura = fopen($diretorio . "\\" . $leitura, "r");
$arq_valencia = file($diretorio . "\\" . $valencia, FILE_TEXT | FILE_SKIP_EMPTY_LINES);

while (!feof($arq_leitura)) {
  $linha = fgets($arq_leitura);
  array_push($arq_array, explode(' ', $linha));
}

foreach($arq_array as $key1 => $frase) {
  foreach($frase as $key => $palavra) {
    if(array_search($palavra, $arq_words)) {
      unset($arq_array[$key1][$key]);
      $count_retiradas++;
      $lista_retiradas .= $palavra . ", ";
    }
  }
}

echo "\n com " . count($arq_valencia) . " palavras de emoção."; 

foreach ($arq_valencia as $key1 => $frase) {
  foreach ($frase as $key => $palavra) {
    if(array_key_exists($palavra, $arq_valencia)) {
      if($arq_valencia[$palavra]=='+') {
        $cont_positiva++;
        $stg_positiva .= $palavra . ", ";
      } else {
        $cont_negativa++;
        $stg_negativa .= $palavra . ", ";
      }
    }
  }
}
echo "Contas negativas: " . $cont_negativa;
fclose($arq_leitura);
echo "<textarea>";
print_r($arq_array);
echo "</textarea>";

?>


<!-- <!DOCTYPE html>
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
      //  while(!feof($arq)) {
      //    $linha = fgets($arq) . "<br>";
      //    array_push($arq_array, explode(chr(9), $linha));
      //    foreach ($arq_array as $key => $value) {
      //      echo $value;
      //    }
      // }
      // fclose($arq);
      // echo "<pre>";
      // print_r($arq_array);
      // echo "</pre>";
      ?>    
    </div>
  </div>
</body>
</html> -->