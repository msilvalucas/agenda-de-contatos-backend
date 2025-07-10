<?php
$host = 'dpg-d1nkidripnbc73ap70p0-a';
$db = 'agenda_db_c1j1';
$user = 'agenda_db_c1j1_user';
$pass = 'keDH88bCykCksPR7WTZxCaY4ViuL7O0j';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao conectar no banco de dados: " . $e->getMessage()]);
    exit;
}
