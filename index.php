<?php
require_once './config/headers.php';
require_once './controllers/ContatoController.php';

$method = $_SERVER['REQUEST_METHOD'];

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '';
$path = str_starts_with($path, $basePath) ? substr($path, strlen($basePath)) : $path;

$request = explode('/', trim($path, '/'));
$resource = $request[0] ?? '';
$id = $request[1] ?? null;

if ($resource !== 'contatos') {
    http_response_code(404);
    echo json_encode(["erro" => "Endpoint não encontrado"]);
    exit;
}

switch ($method) {
    case 'GET':
        $id ? ContatoController::obter($id) : ContatoController::listar();
        break;

    case 'POST':
        ContatoController::criar();
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["erro" => "ID obrigatório"]);
            return;
        }
        ContatoController::atualizar($id);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["erro" => "ID obrigatório"]);
            return;
        }
        ContatoController::deletar($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido"]);
}
