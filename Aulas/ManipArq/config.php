<?php
$host = "localhost";
$port = "5432";
$dbname = "Lavanderia";
$user = "postgres";
$password = "acess";

$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
?>