<?php
session_start();
include_once('config.php');

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location.href='../form.html';</script>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_servico = $_POST['id_servico'] ?? null;

if ($id_servico) {
    // Verifica se já é voluntário nesse serviço
    $check = $conexao->prepare("SELECT id FROM voluntarios_servicos WHERE id_usuario = ? AND id_servico = ?");
    $check->bind_param("ii", $id_usuario, $id_servico);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Você já é voluntário nesse serviço.'); window.history.back();</script>";
    } else {
        $insert = $conexao->prepare("INSERT INTO voluntarios_servicos (id_usuario, id_servico) VALUES (?, ?)");
        $insert->bind_param("ii", $id_usuario, $id_servico);
        if ($insert->execute()) {
            echo "<script>alert('Cadastro como voluntário realizado com sucesso!'); window.history.back();</script>";
        } else {
            echo "<script>alert('Erro ao se voluntariar.'); window.history.back();</script>";
        }
        $insert->close();
    }

    $check->close();
}
$conexao->close();
?>
