<?php 

require_once("config.php");

use Cliente\Cadastro;

$cad = new Cadastro();

$cad->setNome("Yohao");
$cad->setEmail("yohaoqueiroz@gmail.com");
$cad->setSenha("yohaahoy");

$cad->registrarVenda();


?>