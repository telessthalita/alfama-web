<?php
require_once '../includes/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (! isset($data['email']) || ! isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos']);
    exit;
}

$email    = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
$password = $data['password'];

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'E-mail inválido']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (! $user || ! password_verify($password, $user['password'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
        exit;
    }

    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name']  = $user['name'];

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro no servidor']);
}
