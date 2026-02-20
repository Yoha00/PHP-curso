<?php
session_start(); // inicia a sessão.
session_destroy(); //Limpa e destroi as informações da sessão
header("Location: login.php"); // Manda de volta para a tela de entrada
exit;
?>