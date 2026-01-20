<?php 

//////////// - Variaveis - ///////////
$nome = "Yohann";
$sobrenome = "Silva";
$nomeCompleto = $nome . " " . $sobrenome;
$anoNascimento = 2005;
$salario = 1100;
$ativo = true;

/////// - Verificação - ///////
echo "Informações do úsuario: <br>";
echo "Nome: " . $nome . "<br>";
echo "Sobrenome: " . $sobrenome . "<br>";
echo "Nome Completo: " . $nomeCompleto . "<br>";
echo "Nascido no ano de: " . $anoNascimento . "<br>";
echo "Salario: " . $salario . "<br>";


var_dump($nome);
var_dump($sobrenome);
var_dump($nomeCompleto);
var_dump($anoNascimento);
var_dump($salario);
var_dump($ativo);
?>