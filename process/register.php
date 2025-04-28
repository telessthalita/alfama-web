<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['full_name']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$full_name = filter_var($data['full_name'], FILTER_SANITIZE_STRING);
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

try {
    // Verifica se email já existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email já cadastrado']);
        exit;
    }

    // Insere novo usuário
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$full_name, $email, $password]);
    
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no servidor']);
}
?>