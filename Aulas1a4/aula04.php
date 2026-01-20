<?php 

$nome = "Cooper";

function teste(){
    global $nome;
    echo $nome . "<br>"; 
}

function teste01(){

    global $nome;
    echo $nome . " no teste 01";

}

teste();
teste01();



?>