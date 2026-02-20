<?php 

//----- Conexão com o BANCO -----//
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Requisitando o metodo POST
    $nome = $_POST['nome']; // Com o metodo POST, posso navegar por esses dados, sem aparecer externamente.
    $email = $_POST['email'];
    $nascimento = $_POST['dtNascimento'];
    
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha, gerando um salt aleatorio e combinando com a senha
    //                                                      Password_default é um algoritmo padrão, só para poder usar o hash

    //----------------- Forma segura de fazer, evitando SQL Injection -----------------//
    $sql = "INSERT INTO cadastro (nome, email, dtNascimento, senha) VALUES (?, ?, ?, ?)"; // SQL para inserir os dados no banco, porem utilizando placeholder, para não precisar setar os dados no momento
    $stmt = $conn->prepare($sql); // instruo ao sistema analisar a minha ordem, mas não executar, exatamente preparando para ser executado
    
    if($stmt->execute([$nome, $email, $nascimento, $senha])) { // Executa a ordem que eu preparei no $conn->prepare
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