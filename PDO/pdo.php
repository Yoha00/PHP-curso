<?php 

$conn = new PDO("pgsql:host=localhost; port=5432; dbname=Cadastro", "postgres", "acess"); //Conexão com o banco de dados

$stmt = $conn->prepare("INSERT INTO tb_usuarios(deslogin, dessenha) VALUES (?, ?)"); // Inserindo valores

//Valores em variaveis para inserir na tabela do banco
$login = "Yohann";
$pass = "YOHA0000";

$stmt->execute([$login, $pass]); //Executa os seguintes parametros

//-------------------------- Visualização da tabela -----------------------//
$stmt = $conn->prepare("SELECT * FROM tb_usuarios ORDER BY deslogin"); //Prepara o comando para exibir a tela
$stmt->execute(); //Executa

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results); // transforma o codigo em string json
echo"<br>"; 

//----------------------------------- Com parametros para segurança do banco de dados -----------------------------//
/*
$conn = new PDO("pgsql:host=localhost; port=5432; dbname=Cadastro", "postgres", "acess");

$stmt = $conn->prepare("INSERT INTO tb_usuarios(deslogin, dessenha) VALUES (:LOGIN, :PASS)"); //Parametros para segurança das tabelas

$login = "Peidos Secos";
$pass = "teste123456";

$stmt->bindParam(":LOGIN", $login); //Aloco que os parametros são para o Login abaixo para a Password
$stmt->bindParam(":PASS", $pass);

$stmt->execute();
echo "<br>";

echo"Inserido"; */

//-------------------------------- Atualizando informações de uma tabela --------------------------------//
/*
$conn = new PDO("pgsql:host=localhost; port=5432; dbname=Cadastro", "postgres", "acess");

$stmt = $conn->prepare("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASS WHERE usuarioid = :ID");

$login = "Peidos Secos";
$pass = "teste123456";
$usuarioid = 2;

$stmt->bindParam(":LOGIN", $login);
$stmt->bindParam(":PASS", $pass);
$stmt->bindParam(":ID", $usuarioid);
$stmt->execute();
echo "<br>";

echo"Alterado"; */

//-------------------------------- Excluindo uma informação da tabela --------------------------------//

/*$conn = new PDO("pgsql:host=localhost; port=5432; dbname=Cadastro", "postgres", "acess");

$stmt = $conn->prepare("DELETE FROM tb_usuarios WHERE usuarioid = :ID");
$usuarioid = 1;

$stmt->bindParam(":ID", $usuarioid);
$stmt->execute();

echo"Informação excluida";*/

//-------------------------------- Transações na tabela --------------------------------//
/*
$conn = new PDO("pgsql:host=localhost; port=5432; dbname=Cadastro", "postgres", "acess");
$conn->beginTransaction(); //Iniciando uma transação

$stmt = $conn->prepare("DELETE FROM tb_usuarios WHERE usuarioid = ?");
$usuarioid = 1;

$stmt->execute(array());
$stmt->execute();

$conn->rollback(); //Rollback cancela uma atualização caso haja erro, voltando para o estado anterior
//$conn->commit(); //Caso não der erro, manda para o banco

echo"Informação recuperada"; */



?>