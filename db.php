<?php
$host = 'caboose.proxy.rlwy.net';
$port = 52709;
$db = 'railway';
$user = 'root';
$pass = 'PZzcvtDjfSLQQpChNyhTllsczQvSdIg';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao conectar no banco de dados: " . $e->getMessage()]);
    exit;
}
