<?php 

spl_autoload_register(function($nameClass) { //Função de autoload para carregar classes automaticamente 
    $dirClass = "class"; 
    $filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php"; //Constroi o caminho do arquivo da classe
       
       if (file_exists($filename)) { //Verifica se o arquivo da classe existe
           require_once($filename); //Inclui o arquivo da classe se existir
       }
   });

?>