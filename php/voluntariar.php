<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Você precisa estar logado para se voluntariar.'); window.location.href='../HTML/form.html';</script>";
    exit;
}

// Inclui a conexão com o banco
include_once('config.php');

// Inclui os arquivos do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Pega os dados do usuário e do serviço
$id_usuario = $_SESSION['usuario_id'];
$id_servico = $_POST['id_servico'] ?? null;

if ($id_servico) {
    // Verifica se já é voluntário
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
            // Dados do usuário para o e-mail
            $usuario_email = $_SESSION['usuario_email'];

            // Inicia o PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'danikferreira69@gmail.com'; // Seu email Gmail
                $mail->Password = 'vbytqonrbkdqfybb'; // Senha de app do Gmail
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('danikferreira69@gmail.com', 'Conecta Local');
                $mail->addAddress($usuario_email);

                $mail->isHTML(true);
                $mail->Subject = 'Cadastro como voluntário confirmado';
                $mail->Body = "Olá!<br>Você se cadastrou como voluntário para o serviço ID <strong>$id_servico</strong>.<br>Agora, você será notificado quando alguém solicitar ajuda nesse serviço.";
                $mail->AltBody = "Olá! Você se cadastrou como voluntário para o serviço ID $id_servico.";

                $mail->send();
            } catch (Exception $e) {
                error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
                // Email falhou, mas cadastro foi feito
            }

            echo "<script>
                alert('Cadastro realizado com sucesso!\\nVocê receberá um e-mail de confirmação e será notificado quando alguém pedir ajuda neste serviço.');
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
