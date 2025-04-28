<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

// Verifica se usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Não autorizado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Validação básica
if (!isset($data['full_name']) || !isset($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

// Sanitização dos dados
$full_name = filter_var($data['full_name'], FILTER_SANITIZE_STRING);
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = isset($data['phone']) ? filter_var($data['phone'], FILTER_SANITIZE_STRING) : null;
$company = isset($data['company']) ? filter_var($data['company'], FILTER_SANITIZE_STRING) : null;
$cpf = isset($data['cpf']) ? filter_var($data['cpf'], FILTER_SANITIZE_STRING) : null;
$address = isset($data['address']) ? filter_var($data['address'], FILTER_SANITIZE_STRING) : null;

try {
    // Verifica se email já existe (para outro usuário)
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $_SESSION['user_id']]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email já está em uso por outro usuário']);
        exit;
    }

    // Atualiza os dados
    $stmt = $pdo->prepare("UPDATE users SET 
                          full_name = ?, 
                          email = ?, 
                          phone = ?, 
                          company = ?, 
                          cpf = ?, 
                          address = ? 
                          WHERE id = ?");
    $stmt->execute([$full_name, $email, $phone, $company, $cpf, $address, $_SESSION['user_id']]);
    
    // Atualiza dados na sessão
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $full_name;
    
    echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no servidor']);
}
?>