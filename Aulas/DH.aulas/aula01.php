<?php 

//https://www.php.net/manual/en/function.date.php
//https://www.php.net/manual/en/function.strftime.php

/*
 echo date("d/m/Y H:i:s"); //mostra o dia e o horario em tempo real
 echo "<br>";
 echo time(); //segundos desde 1970, usado geralmente pra determinar quantos segundos atras foi clicado

$ts = strtotime("2025-01-28"); //converte string para Time
$ts = strtotime ("now"); // "Now" mostra o dia atual, calculando o time stamp atual, +1 day coloca o de amanhã, e week coloca no proximo dia da semana, exemplo: segunda now, segunda week é na proxima segunda

echo date("l, d/m/Y", $ts); */

setlocale(LC_ALL,"pt-BR", "pt-BR.utf-8", "portuguese");

// strftime() <- Função obsoleta, acessar o manual do fuction.date.php



?>