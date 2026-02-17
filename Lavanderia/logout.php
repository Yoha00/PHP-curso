<?php
session_start();
session_destroy(); // Limpa as variáveis de login
header("Location: login.php"); // Manda de volta para a tela de entrada
exit;
?>