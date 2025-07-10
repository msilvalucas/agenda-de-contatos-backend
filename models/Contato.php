<?php
class Contato {
    public $id, $nome, $telefone, $cidade, $estado, $email, $categoria;

    public function __construct($data) {
        $this->nome = $data['nome'] ?? '';
        $this->telefone = $data['telefone'] ?? '';
        $this->cidade = $data['cidade'] ?? '';
        $this->estado = $data['estado'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->categoria = $data['categoria'] ?? '';
    }
}
