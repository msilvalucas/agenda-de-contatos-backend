<?php
require_once './db.php';
require_once './models/Contato.php';
require_once './validations/Validator.php';

class ContatoController {
    public static function listar() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM contatos");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function obter($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = ?");
        $stmt->execute([$id]);
        $contato = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($contato) echo json_encode($contato);
        else http_response_code(404) && print(json_encode(["erro" => "Contato não encontrado"]));
    }

    public static function criar() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(["erros" => ["Dados inválidos"]], JSON_UNESCAPED_UNICODE);
        return;
    }

    $erros = Validator::validar($data);
    if (!empty($erros)) {
        http_response_code(400);
        echo json_encode(["erros" => $erros], JSON_UNESCAPED_UNICODE);
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO contatos (nome, telefone, cidade, estado, email, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['nome'],
        $data['telefone'],
        $data['cidade'],
        $data['estado'],
        $data['email'],
        $data['categoria']
    ]);

    echo json_encode(["id" => $pdo->lastInsertId()]);
}

    public static function atualizar($id) {
        global $pdo;
        $data = json_decode(file_get_contents("php://input"), true);
        $erros = Validator::validar($data);
        if ($erros) {
            http_response_code(400);
            echo json_encode(["erros" => $erros]);
            return;
        }

        $stmt = $pdo->prepare("UPDATE contatos SET nome=?, telefone=?, cidade=?, estado=?, email=?, categoria=? WHERE id=?");
        $stmt->execute([$data['nome'], $data['telefone'], $data['cidade'], $data['estado'], $data['email'], $data['categoria'], $id]);
        echo json_encode(["mensagem" => "Contato atualizado com sucesso"]);
    }

    public static function deletar($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["mensagem" => "Contato removido com sucesso"]);
    }
}
