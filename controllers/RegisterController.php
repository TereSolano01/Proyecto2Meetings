<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handling OPTIONS request (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('models/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Read input data
    $input = json_decode(file_get_contents('php://input'), true);

    // Basic validation
    if (empty($input['name']) || empty($input['email']) || empty($input['password'])) {
        echo json_encode(['error' => 'Todos los campos son obligatorios']);
        http_response_code(400);
        exit();
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Correo electrónico no válido']);
        http_response_code(400);
        exit();
    }

    if (strlen($input['password']) < 6) {
        echo json_encode(['error' => 'La contraseña debe tener al menos 6 caracteres']);
        http_response_code(400);
        exit();
    }

    // Check if email is already registered
    if (User::where('email', $input['email'])->exists()) {
        echo json_encode(['error' => 'El correo electrónico ya está registrado']);
        http_response_code(400);
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($input['password'], PASSWORD_BCRYPT);

    // Create user
    $user = [
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => $hashedPassword
    ];

    try {
        User::create($user);
        echo json_encode(['message' => 'Usuario registrado con éxito']);
        http_response_code(201);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al registrar el usuario']);
        http_response_code(500);
    }
}
?>
