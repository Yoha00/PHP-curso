<?php 

//----- Conexão com o BANCO -----//
include 'config.php'; // conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['dtNascimento'];
    
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    $sql = "INSERT INTO cadastro (nome, email, dtNascimento, senha) VALUES (?, ?, ?, ?)"; // SQL para inserir os dados no banco
    $stmt = $conn->prepare($sql); // Prepara a consulta
    
    if($stmt->execute([$nome, $email, $nascimento, $senha])) { // Executa a consulta e verifica se foi bem-sucedida
        echo "<script>alert('Cadastrado com sucesso!'); window.location='login.php';</script>"; // Exibe um alerta de sucesso e redireciona para a página de login
    }
}

?>

<body>
    <h1> Cadastro de Administrador </h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="date" name="dtNascimento"><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Cadastrar Agora</button>
    </form>
</body>