<?php 
/*
///////////////// Primeira versão /////////////////
function soma(int ...$valores) //... pede pra pegar todas as informações passada pela variavel e colocar em um array com o nome
{
    return array_sum($valores);
}

echo soma(2 , 2);
echo "<br>";
echo soma (25, 35);
echo "<br>";
echo soma (1.5 , 3.7); */

///////////////// Segunda versão /////////////////

function soma(float ...$valores) : string // TIPO DE RETORNO
{
    return array_sum($valores);
}

echo var_dump(soma(2 , 2));
echo "<br>";
echo soma (25, 35);
echo "<br>";
echo soma (1.5 , 3.7);

?>