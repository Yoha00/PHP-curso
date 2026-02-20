<?php

session_start(); // Inicia a sessão para controlar o acesso às páginas e armazenar informações do usuário logado
include 'config.php';

// --- Verificação --- //
if (!isset($_SESSION['adm_id'])) { //Se a variavel não existir, ele redireciona para a pagina de login
    header("Location: login.php");
    exit;
}

// --- LÓGICA DE EXCLUSÃO --- //
if (isset($_GET['excluir'])) { //Se a variavel excluir existir 
    $id = $_GET['excluir']; // Ele pega o id da maquina que o usuario deseja excluir pela URL
    $sql_del = "DELETE FROM maquinas WHERE maqid = ?"; // Exclue no banco de dados
    $stmt_del = $conn->prepare($sql_del); 
    $stmt_del->execute([$id]);
    
    // Recarrega a página para atualizar a lista
    header("Location: maquinas.php"); // Redireciona para a mesma página para evitar reenvio do formulário
    exit;
}

// --- Lógica para adicionar maquinas --- //
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_adicionar'])) { //Priva de aparecer na URL e verifica se a variavel btn existe
    $nome = $_POST['nome_maquina']; // Pega o nome da máquina digitado no formulário
    $preco = $_POST['preco_uso']; 
    $status = $_POST['status'];

    $sql_ins = "INSERT INTO maquinas (nome_maquina, preco_uso, status) VALUES (?, ?, ?)"; // SQL para inserir a nova máquina no banco
    $stmt_ins = $conn->prepare($sql_ins); 
    $stmt_ins->execute([$nome, $preco, $status]);
    
    header("Location: maquinas.php"); // Redireciona para a mesma página para evitar reenvio do formulário
    exit;
}

$sql_select = "SELECT * FROM maquinas ORDER BY maqid ASC"; 
$stmt = $conn->query($sql_select); //Executa o comando direto do banco, de forma rapida e trazendo as informações que tiver
$maquinas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ele pega os dados, coloca tudo na variavel maquinas, e depois organiza com fetch_assoc para colocar em lista
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Máquinas</title>
</head>
<body>
    <header>
        <p>Olá, <strong><?php echo $_SESSION['adm_nome']; ?></strong>! | <a href="logout.php">Sair</a></p>
    </header>

    <h1>Gerenciamento de Máquinas</h1>

    <fieldset>
        <legend>Nova Máquina</legend>
        <form method="POST">
            <input type="text" name="nome_maquina" placeholder="Nome da Máquina" required>
            <input type="number" step="0.01" name="preco_uso" placeholder="Preço (Ex: 10.50)" required>
            <select name="status">
                <option value="Disponivel">Disponível</option>
                <option value="Ocupada">Ocupada</option>
                <option value="Manutenção">Manutenção</option>
            </select>
            <button type="submit" name="btn_adicionar">Adicionar</button>
        </form>
    </fieldset>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Preço</th>
                <th>Última Atualização</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maquinas as $maq): ?>
            <tr>
                <td><?php echo $maq['maqid']; ?></td>
                <td><?php echo $maq['nome_maquina']; ?></td>
                <td><?php echo $maq['status']; ?></td>
                <td>R$ <?php echo number_format($maq['preco_uso'], 2, ',', '.'); ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($maq['ultimaatualizacao'])); ?></td>
                <td>
                    <a href="editar_maquinas.php?id=<?php echo $maq['maqid']; ?>">Editar</a> | 
                    
                    <a href="maquinas.php?excluir=<?php echo $maq['maqid']; ?>" 
                       onclick="return confirm('Deseja mesmo excluir esta máquina?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>