<?php
// Leitura de arquivo TXT
$caminho = getcwd();
echo "<hr>Arquivo processado...";
$arquivo = "arquivo_emocao2.txt";
echo "<br>Caminho: " . $caminho;
echo "<br>Arquivo: " . $arquivo;

$array_arq = array();
$quant_pal = 0;
$arq = fopen($caminho . "\\" . $arquivo,"r");
while(!feof($arq)){
	$linha = fgets($arq);
	$new_array = explode(" ",trim(strtolower($linha)));
	$quant_pal += count($new_array);
	array_push($array_arq,$new_array);
	echo "<br>" . $linha;
}
fclose($arq);
$quant_linhas = count($array_arq);
echo "<br> Com " . $quant_linhas . " linha(s) e " . $quant_pal . " palavra(s).";

foreach($array_arq as $key1 => $frase){
	foreach($frase as $key2 => $palavra){
		$palavra = str_replace(",","",$palavra);
		$palavra = str_replace(".","",$palavra);
		$array_arq[$key1][$key2] = $palavra;
	}
}

// Leitura do arquivo STOP WORDS
echo "<hr><br>Stop Words...";
$arquivo = "stopwords.txt";
echo "<br>Arquivo: " . $arquivo;

$array_stop_words = file($caminho . "\\" . $arquivo,FILE_TEXT| FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
echo "<br> com " . count($array_stop_words) . " palavras.";
$count_retiradas = 0;
$lista_retiradas = "";

foreach($array_arq as $key1 => $frase){
	foreach($frase as $key2 => $palavra){
		$achou = array_search($palavra,$array_stop_words);
		if(false !== $achou)
		{
			unset($array_arq[$key1][$key2]);
			$count_retiradas++;
			$lista_retiradas .= $palavra . ", ";			
		}
	}
}

echo "<br>" . $count_retiradas . " stop words retiradas do texto original";
echo "<br>" . $lista_retiradas;

$array_final = array();

echo "<hr><br>Base de emoções WordNetAffectBR...";
$arquivo = "wordnetaffectbr_valencia.txt";
echo "<br>Arquivo: " . $arquivo;

$array_emocoes_file = file($caminho . "\\" . $arquivo,FILE_TEXT| FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
echo "<br> com " . count($array_emocoes_file) . " palavras de emoção.";

$array_emocoes = array();
$cont=0;
foreach($array_emocoes_file as $emocao){
	$array_emocoes_linha = explode(chr(9),$emocao);
	$cont++;
	$array_emocoes[$array_emocoes_linha[0]] = $array_emocoes_linha[1];
}

$cont_positiva=0;
$cont_negativa=0;
$str_negativa="";
$str_positiva="";

foreach($array_arq as $key1 => $frase){
	foreach($frase as $key2 => $palavra){
		if(array_key_exists($palavra,$array_emocoes)){
			if($array_emocoes[$palavra]=='+'){
				$cont_positiva++;
				$str_positiva .= $palavra . ", ";
			}else{
				$cont_negativa++;
				$str_negativa .= $palavra . ", ";
			}
		}
	}
}
echo "<hr>";
echo "<br>Emoções <b>POSITIVAS</b> encontradas: " .  $cont_positiva;
echo "<br>" . $str_positiva; 
echo "<br><br>Emoções <b>NEGATIVAS</b> encontradas: " . $cont_negativa;
echo "<br>" . $str_negativa;

echo "<pre>";
print_r($array_arq);
echo "<pre>";