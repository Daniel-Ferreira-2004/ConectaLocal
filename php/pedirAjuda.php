<?php
session_start();
include_once('config.php');
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

// ✅ VERIFICAÇÃO: usuário logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location.href='../HTML/form.html';</script>";
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_servico = $_POST['id_servico'] ?? null;

if (!$id_servico) {
    echo "<script>alert('Serviço inválido.'); window.history.back();</script>";
    exit;
}

// ✅ Buscar dados do usuário que está pedindo ajuda
$stmt = $conexao->prepare("SELECT nome, sobrenome, email, telefone, endereco FROM formulariodaniel WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$dados_usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$dados_usuario) {
    echo "<script>alert('Erro ao obter seus dados.'); window.history.back();</script>";
    exit;
}

// ✅ Buscar o nome do serviço com base no ID
$stmt = $conexao->prepare("SELECT nome_servico FROM servicos WHERE id = ?");
$stmt->bind_param("i", $id_servico);
$stmt->execute();
$result_servico = $stmt->get_result();
$servico = $result_servico->fetch_assoc();
$nome_servico = $servico['nome_servico'] ?? 'Serviço não identificado';
$stmt->close();

// ✅ Buscar emails dos voluntários para esse serviço
$stmt = $conexao->prepare("
    SELECT f.email 
    FROM voluntarios_servicos v 
    JOIN formulariodaniel f ON v.id_usuario = f.id 
    WHERE v.id_servico = ?
");
$stmt->bind_param("i", $id_servico);
$stmt->execute();
$result = $stmt->get_result();

// ✅ Enviar e-mail para cada voluntário
$mail = new PHPMailer(true);

while ($voluntario = $result->fetch_assoc()) {
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'danikferreira69@gmail.com';         // Seu e-mail Gmail
        $mail->Password = 'vbytqonrbkdqfybb';                  // Senha de app do Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('danikferreira69@gmail.com', 'Conecta Local');
        $mail->addAddress($voluntario['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Alguem precisa da sua ajuda!!!';
        $mail->Body = "
            <strong>Um novo pedido de ajuda foi feito:</strong><br><br>
            <b>Serviço solicitado:</b> {$nome_servico}<br><br>
            <b>Nome:</b> {$dados_usuario['nome']} {$dados_usuario['sobrenome']}<br>
            <b>Telefone:</b> {$dados_usuario['telefone']}<br>
            <b>Email:</b> {$dados_usuario['email']}<br>
            <b>Endereço:</b> {$dados_usuario['endereco']}<br>
            <b>Obrigado:</b>Muito obrigado por sua colaboração, Entre em contato com essa pessoa e a ajude se possivel !!<br>
        ";

        $mail->send();
        $mail->clearAddresses(); // Limpa para o próximo envio
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail para {$voluntario['email']}: {$mail->ErrorInfo}";
    }
}

$stmt->close();
$conexao->close();

echo "<script>alert('Pedido de ajuda enviado com sucesso! Os voluntários serão notificados por e-mail.'); window.history.back();</script>";
?>