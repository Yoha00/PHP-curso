<?php 

//-----------------------------------------------------//
  //             Classe Date Time                 //

// Cria um objeto de fuso horário de Brasília
/*$timezoneBrasilia = new DateTimeZone('America/Sao_Paulo'); 

  $dt = new DateTime("now", $timezoneBrasilia);

  echo $dt->format("d/m/Y H:i:s");*/

  $dt = new DateTime();

  $periodo = new DateInterval("P4D");

  echo $dt->format("d/m/Y H:i:s");

  $dt -> add($periodo);

  echo "<br>";

  echo $dt->format("d/m/Y H:i:s"); 



?>