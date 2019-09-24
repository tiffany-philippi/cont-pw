<?php
//pega o diretório atual:
$diretorio = getcwd();

//variáveis de leitura
$leitura = "emocoes.txt";
$arq_leitura = fopen($diretorio . "\\" . $leitura, "r");
$array_leitura = array();
$count = 0;
$count_retiradas = 0;
$lista_retiradas = "";
$qtd_palavras = 0;




//variáveis de stop words
$stopWords = "stop-words.txt";
$arq_words = file($diretorio . "\\" . $stopWords, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES | FILE_TEXT);
$palavras_ret = 0;
$lista_retiradas = "";




//variáveis de valencia
$valencia = "valencia.txt";
$arq_valencia = file($diretorio . "\\" . $valencia, FILE_TEXT | FILE_SKIP_EMPTY_LINES);
$array_valencia = array();
$cont_emocoes = 0;
$stg_positiva = "";
$stg_negativa = "";
$cont_positiva = 0;
$cont_negativa = 0;



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
      margin: 5px;
    }

    .leitura {
      width: 70%;
    }

    .align {
      width: 70%;
      text-align: center;
      margin: 0 auto;
      line-height: 1.6;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="content leitura">

      <?php

      echo "<h3>Arquivo de leitura: </h3>" . "<p><b>Caminho:</b> " . $diretorio . "</p><p><b>Arquivo:</b> " . $leitura . "</p>";

      while (!feof($arq_leitura)) {
        $linha = fgets($arq_leitura);
        $array_count =  explode(' ', trim(strtolower($linha)));
        $qtd_palavras += count($array_count);
        array_push($array_leitura, $array_count);
        echo "<p class=\"align\">" . $linha . "</p><br>";
      }
      $qtd_linhas = count($array_leitura);


      echo "<p>Com <b>" . $qtd_linhas . "</b> linhas e <b>" . $qtd_palavras . "</b> palavras ";

      //Substituindo vírgulas e pontos por espaço vazio.
      foreach ($array_leitura as $key1 => $frase) {
        foreach ($frase as $key2 => $palavra) {
          $palavra = str_replace(",", "", $palavra);
          $palavra = str_replace(".", "", $palavra);
          $array_leitura[$key1][$key2] = $palavra;
        }
      }
      fclose($arq_leitura);
      ?>

    </div>
    <div class="content">

      <?php
      echo "<h3>Arquivo stop words: </h3>" . "<p><b>Caminho:</b> " . $diretorio . "</p><p><b>Arquivo:</b> " . $stopWords . "</p>";

      foreach ($array_leitura as $key1 => $frase) {
        foreach ($frase as $key => $palavra) {
          $variavel_search = array_search($palavra, $arq_words);
          if (false !== $variavel_search) {
            unset($array_leitura[$key1][$key]);
            $palavras_ret++;
            $lista_retiradas .= $palavra . "<br>";
          }
        }
      }

      echo "<p> com <b>" . count($arq_words) . "</b> palavras.</p>";
      echo "<p> <b> " . $palavras_ret . "</b> stop words retiradas do texto original.</p>";
      echo "<p class=\"align\"> " . $lista_retiradas . "</p>";
      ?>

    </div>
    <div class="content">
      <?php
      echo "<h3>Arquivo de emoções: </h3>" . "<p><b>Caminho:</b> " . $diretorio . "</p><p><b>Arquivo:</b> " . $valencia . "</p>";
      echo "<p> com <b>" . count($arq_valencia) . "</b> palavras de emoção.";

      foreach($arq_valencia as $emocoes) {
        $qtd_linhas_valencia = explode(' ', $emocoes);
        $cont_emocoes++;
        $array_valencia[$qtd_linhas_valencia[0]] = $qtd_linhas_valencia[1];
      }
      
      foreach ($arq_valencia as $key1 => $frase) {
        foreach ($frase as $key2 => $palavra) {
          if (array_key_exists($palavra, $arq_valencia)) {
            if ($arq_valencia[$palavra] == '+') {
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
      echo "<pre>";
      print_r($array_valencia);
      echo "</pre>";

      ?>
    </div>
  </div>
</body>

</html>