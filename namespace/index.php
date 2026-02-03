<?php 

require_once("config.php");

use Cliente\Cadastro;

$cad = new Cadastro();

$cad->setNome("Yohann");
$cad->setEmail("yohannqueiroz@gmail.com");
$cad->setSenha("yohaahoy");

$cad->registrarVenda();


?>