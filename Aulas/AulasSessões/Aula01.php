<?php

//------------------------ Sessões -----------------------//
// Inicia a sessão
require_once("config.php");

$_SESSION["nome"] = 'Yoha';

//------------------------ Destruição de Sessões -----------------------//
require_once("config.php");

unset($_SESSION['nome']);

echo $_SESSION['nome'];

session_destroy();
//------------------------ IDs de Sessões -----------------------//

require_once "config.php";

echo session_id(); //Exibe o ID da sessão atual

session_id(''); //Define um novo ID para a sessão

//------------------------ Regeneração de IDs de Sessões -----------------------//

require_once("config.php");

session_regenerate_id(); //Gera um novo ID para a sessão atual

echo session_id(); //Exibe o novo ID da sessão atual

var_dump($_SESSION); //Exibe os dados da sessão atual

//------------------------ Status de Sessões -----------------------//

require_once("config.php");

echo session_save_path(); //Exibe o caminho onde as sessões são salvas

echo "<br/>";

var_dump(session_status()); //Exibe o status atual da sessão

echo "<br/>";

switch(session_status()){ //Verifica o status da sessão

	case PHP_SESSION_DISABLED: //Caso só haja sessões desabilitadas
	echo "as sessões estiverem desabilitadas.";
	break;

	case PHP_SESSION_NONE: // Caso tenha sessões habilitadas, mas nenhuma existe
	echo "as sessões estiverem habilitadas, mas nenhuma existir.";
	break;

	case PHP_SESSION_ACTIVE: // Caso tenha sessões habilitadas, e uma existe
	echo "as sessões estiverem habilitadas, e uma existir.";
	break;
}
?>