<?php
class Validator {
    private static $categorias = ["Aluno", "Responsável", "Professor", "Funcionário", "Gestor"];

    public static function validar($data) {
        $erros = [];

        if (empty($data['nome'])) $erros[] = "Nome é obrigatório";

        $telefone = preg_replace('/\D/', '', $data['telefone'] ?? '');
        if (empty($telefone) || strlen($telefone) < 10 || strlen($telefone) > 11)
            $erros[] = "Telefone inválido";

        if (empty($data['cidade'])) $erros[] = "Cidade é obrigatória";

        if (empty($data['estado']) || !preg_match('/^[A-Z]{2}$/', $data['estado']))
            $erros[] = "Estado inválido";

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $erros[] = "Email inválido";

        if (empty($data['categoria']) || !in_array($data['categoria'], self::$categorias))
            $erros[] = "Categoria inválida";

        return $erros;
    }
}
