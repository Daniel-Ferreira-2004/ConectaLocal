<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Você precisa estar logado para se voluntariar.'); window.location.href='../HTML/form.html';</script>";
    exit;
}

include_once('config.php');

// Pega os dados da sessão e do POST
$id_usuario = $_SESSION['usuario_id'];
$id_servico = $_POST['id_servico'] ?? null;

// Verifica se veio o id do serviço
if ($id_servico) {
    // Verifica se já está cadastrado como voluntário
    $check = $conexao->prepare("SELECT id FROM voluntarios_servicos WHERE id_usuario = ? AND id_servico = ?");
    $check->bind_param("ii", $id_usuario, $id_servico);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Você já é voluntário neste serviço. Você continuará recebendo os pedidos de ajuda.'); window.history.back();</script>";
    } else {
        // Cadastra como voluntário
        $insert = $conexao->prepare("INSERT INTO voluntarios_servicos (id_usuario, id_servico) VALUES (?, ?)");
        $insert->bind_param("ii", $id_usuario, $id_servico);

        if ($insert->execute()) {
            // Envia e-mail de confirmação
            $usuario_email = $_SESSION['usuario_email'];
            $assunto = "Cadastro como voluntário confirmado";
            $mensagem = "Olá! Você se cadastrou como voluntário para o serviço ID $id_servico. Agora, você será notificado quando alguém solicitar ajuda nesse serviço.";
            $headers = "From: danikferreira69@gmail.com\r\nReply-To:$usuario_email\r\n";

            mail($usuario_email, $assunto, $mensagem, $headers);

            echo "<script>
                alert('Cadastro realizado com sucesso!</br>
                 Você receberá um e-mail de confirmação e será notificado quando alguém pedir ajuda neste serviço.');
                window.history.back();
            </script>";
        } else {
            echo "<script>alert('Erro ao realizar cadastro como voluntário.'); window.history.back();</script>";
        }

        $insert->close();
    }

    $check->close();
}

$conexao->close();
?>