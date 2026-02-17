<?php
session_start();
include 'config.php';

if (!isset($_SESSION['adm_id'])) { //Se o usuario não estiver logado, redireciona para o login
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) { // Se o ID da máquina for passado por GET, buscamos os dados para preencher o formulário
    $id = $_GET['id']; 
    $sql = "SELECT * FROM maquinas WHERE maqid = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $maquina = $stmt->fetch(PDO::FETCH_ASSOC); // Busca a máquina no banco e armazena em $maquina

    // Se a máquina não existir no banco, volta pra lista
    if (!$maquina) {
        header("Location: maquinas.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Se o formulário for enviado, atualizamos os dados da máquina
    $id_update = $_POST['id_maquina'];
    $novo_nome = $_POST['nome_maquina'];
    $novo_preco = $_POST['preco_uso'];
    $novo_status = $_POST['status'];

    $sql_update = "UPDATE maquinas SET nome_maquina = ?, preco_uso = ?, status = ? WHERE maqid = ?"; // Atualiza os dados da máquina no banco
    $stmt_up = $conn->prepare($sql_update); // Prepara a consulta de atualização
    
    if ($stmt_up->execute([$novo_nome, $novo_preco, $novo_status, $id_update])) {
        echo "<script>alert('Máquina atualizada!'); window.location='maquinas.php';</script>"; // JS para mostrar um alerta de sucesso e redirecionar para a lista de máquinas
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Máquina</title>
</head>
<body>
    <h1>Editar Máquina #<?php echo $maquina['maqid']; ?></h1>

    <form method="POST">
        <input type="hidden" name="id_maquina" value="<?php echo $maquina['maqid']; ?>">

        <label>Nome da Máquina:</label><br>
        <input type="text" name="nome_maquina" value="<?php echo $maquina['nome_maquina']; ?>" required><br><br>

        <label>Preço de Uso (R$):</label><br>
        <input type="number" step="0.01" name="preco_uso" value="<?php echo $maquina['preco_uso']; ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Disponivel" <?php echo ($maquina['status'] == 'Disponivel') ? 'selected' : ''; ?>>Disponível</option>
            <option value="Ocupada" <?php echo ($maquina['status'] == 'Ocupada') ? 'selected' : ''; ?>>Ocupada</option>
            <option value="Manutenção" <?php echo ($maquina['status'] == 'Manutenção') ? 'selected' : ''; ?>>Manutenção</option>
        </select><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="maquinas.php">Cancelar</a>
    </form>
</body>
</html>