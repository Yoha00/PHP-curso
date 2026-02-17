<?php 
session_start(); // Inicia a sessão para armazenar informações do usuário logado
include 'config.php'; // puxa a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica se o formulário foi enviado
    $email = $_POST['email'];  
    $senha_digitada = $_POST['senha'];

    // Procuramos se o e-mail digitado existe na tabela 'cadastro'
    $sql = "SELECT * FROM cadastro WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 

    // password_verify compara o texto puro com o hash criptografado do banco
    if ($usuario && password_verify($senha_digitada, $usuario['senha'])) { // Se o usuário existir e a senha estiver correta 
        $_SESSION['adm_id'] = $usuario['adm_id']; // Armazena o ID do usuário logado
        $_SESSION['adm_nome'] = $usuario['nome'];

        // Inserimos um registro na tabela login
        $sql_log = "INSERT INTO login (adm_id) VALUES (?)";
        $stmt_log = $conn->prepare($sql_log);
        $stmt_log->execute([$usuario['adm_id']]); 

        // Redireciona para a página de máquinas
        header("Location: maquinas.php");
        exit;

    } else {
        // Se o e-mail não existir ou a senha estiver errada
        echo "<script>alert('E-mail ou senha inválidos!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Lavanderia</title>
</head>
<body>
    <h2> Entrar no Sistema de Lavanderia </h2>
    
    <form method="POST" action="login.php">
        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        
        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
</body>
</html>