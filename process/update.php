<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if (! isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Não autorizado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (! isset($data['name']) || ! isset($data['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$name    = filter_var($data['name'], FILTER_SANITIZE_STRING);
$email   = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone   = isset($data['phone']) ? preg_replace('/\D/', '', $data['phone']) : null;
$company = isset($data['company']) ? filter_var($data['company'], FILTER_SANITIZE_STRING) : null;
$cpf     = isset($data['cpf']) ? preg_replace('/\D/', '', $data['cpf']) : null;
$address = isset($data['address']) ? filter_var($data['address'], FILTER_SANITIZE_STRING) : null;

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'E-mail inválido']);
    exit;
}

try { $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Este e-mail já está em uso']);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET
                          name = ?,
                          email = ?,
                          phone = ?,
                          company = ?,
                          cpf = ?,
                          address = ?,
                          updated_at = NOW()
                          WHERE id = ?");

    $stmt->execute([
        $name,
        $email,
        $phone,
        $company,
        $cpf,
        $address,
        $_SESSION['user_id'],
    ]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $user['phone'] = $user['phone'] ? formatPhone($user['phone']) : '';
    $user['cpf']   = $user['cpf'] ? formatCPF($user['cpf']) : '';

    echo json_encode([
        'success' => true,
        'message' => 'Dados atualizados com sucesso',
        'user'    => $user,
    ]);} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()]);
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
