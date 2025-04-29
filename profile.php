<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/config.php';

if (! isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (! $user) {
        throw new Exception("Usuário não encontrado");
    }

    $user['phone'] = $user['phone'] ? formatPhone($user['phone']) : '';
    $user['cpf']   = $user['cpf'] ? formatCPF($user['cpf']) : '';

} catch (PDOException $e) {
    die("Erro ao buscar dados do usuário: " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}

function formatPhone($phone)
{
    $phone = preg_replace('/\D/', '', $phone);
    if (strlen($phone) === 11) {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
    }
    return $phone;
}

function formatCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) === 11) {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
    return $cpf;
}

$pageType = 'profile';
include 'includes/template.php';
