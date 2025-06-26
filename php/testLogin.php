<?php
session_start();

if (isset($_POST["submit"]) && !empty($_POST['email']) && !empty($_POST['passwords'])) {

    include_once('config.php');

    // Sanitiza dados
    $email = strtolower(trim($_POST['email']));
    $senha = $_POST['passwords'];

    // Prepara consulta para pegar id, email e senha
    $stmt = $conexao->prepare("SELECT id, email, senha FROM formulariodaniel WHERE LOWER(TRIM(email)) = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Liga variáveis aos resultados
        $stmt->bind_result($id, $emailBanco, $senhaHash);
        $stmt->fetch();

        // Verifica senha
        if (password_verify($senha, $senhaHash)) {
            // Guarda dados na sessão
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_email'] = $emailBanco;

            echo "<script>alert('Login realizado com sucesso!'); window.location.href = '../HTML/sejaVoluntario.html';</script>";
        } else {
            echo "<script>alert('Senha inválida.'); window.location.href = '../HTML/form.html';</script>";
        }
    } else {
        echo "<script>alert('Email não cadastrado.'); window.location.href = '../HTML/form.html';</script>";
    }

    $stmt->close();
    $conexao->close();

} else {
    header("Location: ../HTML/form.html");
    exit;
}
?>

