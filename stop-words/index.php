<?php
//pega o diretório atual:
$diretorio = getcwd();

//variáveis de stop words
$stopWords = "stop-words.txt";
$arq_words = file($diretorio . "\\" . $stopWords, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES | FILE_TEXT);
$qtd_palavras = 0;

echo "Arquivo stop words: " . "<br>Caminho: " . $diretorio . "<br>Arquivo: " . $stopWords;

//variáveis de emoções
$leitura = "emocoes.txt";
$arq_leitura = fopen($diretorio . "\\" . $leitura, "r");
$array_emocoes = array();
$count = 0;
$count_retiradas = 0;
$lista_retiradas = "";
$stg_positiva = "";
$stg_negativa = "";
$cont_positiva = 0;
$cont_negativa = 0;

//variáveis de valencia
$valencia = "valencia.txt";
$arq_valencia = file($diretorio . "\\" . $valencia, FILE_TEXT | FILE_SKIP_EMPTY_LINES);

while (!feof($arq_leitura)) {
  $linha = fgets($arq_leitura);
  array_push($array_emocoes, explode(' ', $linha));
}

foreach($array_emocoes as $key1 => $frase) {
  foreach($frase as $key => $palavra) {
    if(array_search($palavra, $arq_words)) {
      unset($array_emocoes[$key1][$key]);
      $count_retiradas++;
      $lista_retiradas .= $palavra . ", ";
    }
  }
}

echo "<br> com " . count($arq_valencia) . " palavras de emoção."; 

$array_valencia = array();

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
print_r($array_emocoes);
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
      //    array_push($array_emocoes, explode(chr(9), $linha));
      //    foreach ($array_emocoes as $key => $value) {
      //      echo $value;
      //    }
      // }
      // fclose($arq);
      // echo "<pre>";
      // print_r($array_emocoes);
      // echo "</pre>";
      ?>    
    </div>
  </div>
</body>
</html> -->