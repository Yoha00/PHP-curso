<?php
// Configurações do banco
$host = "localhost";
$port = "5432";
$dbname = "Lavanderia";
$user = "postgres";
$password = "acess";

// Criando a conexão
$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);


?>