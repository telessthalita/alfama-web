<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (! isset($data['name']) || ! isset($data['email']) || ! isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$name     = filter_var($data['name'], FILTER_SANITIZE_STRING);
$email    = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email já cadastrado']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no servidor']);
}
