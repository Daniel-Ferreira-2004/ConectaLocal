<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['usuario_id'])) {
    include_once('../php/config.php'); // ajuste o caminho se necessário

    $id = $_SESSION['usuario_id'];
    $stmt = $conexao->prepare("SELECT nome FROM formulariodaniel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        echo json_encode([
            'loggedIn' => true,
            'nome' => $user['nome']
        ]);
        exit;
    }
}

// Se não estiver logado ou erro:
echo json_encode(['loggedIn' => false]);