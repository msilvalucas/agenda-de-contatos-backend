<?php
$host = 'sql112.infinityfree.com';
$port = 3306;
$db = 'if0_39435870_agenda';
$user = 'if0_39435870';
$pass = '5Bw39yA44sccUoW';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao conectar no banco de dados: " . $e->getMessage()]);
    exit;
}
