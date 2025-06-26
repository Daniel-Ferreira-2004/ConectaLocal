<?php
session_start();
include_once('config.php');
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location.href='../form.html';</script>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_servico = $_POST['id_servico'] ?? null;

// Buscar dados do usuário que está pedindo ajuda
$stmt = $conexao->prepare("SELECT nome, sobrenome, email, telefone, endereco FROM formulariodaniel WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$dados_usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Buscar voluntários para esse serviço
$stmt = $conexao->prepare("SELECT f.email FROM voluntarios_servicos v JOIN formulariodaniel f ON v.id_usuario = f.id WHERE v.id_servico = ?");
$stmt->bind_param("i", $id_servico);
$stmt->execute();
$result = $stmt->get_result();

// Enviar e-mail para cada voluntário
$mail = new PHPMailer(true);
while ($voluntario = $result->fetch_assoc()) {
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'SEU_EMAIL@gmail.com';
        $mail->Password   = 'SENHA_DE_APP';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('SEU_EMAIL@gmail.com', 'Conecta Local');
        $mail->addAddress($voluntario['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Alguém precisa da sua ajuda!';
        $mail->Body = "Nome: {$dados_usuario['nome']} {$dados_usuario['sobrenome']}<br>
                       Telefone: {$dados_usuario['telefone']}<br>
                       Email: {$dados_usuario['email']}<br>
                       Endereço: {$dados_usuario['endereco']}<br>";

        $mail->send();
    } catch (Exception $e) {
        echo "Erro ao enviar email: {$mail->ErrorInfo}";
    }
}
$stmt->close();
$conexao->close();

echo "<script>alert('Pedido de ajuda enviado com sucesso!'); window.history.back();</script>";
?>
