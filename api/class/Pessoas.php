<?php

class Pessoas {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    public function novaPessoa($nome, $aniversario, $email, $telefone, $endereco, $estado, $municipio, $cep, $relacao, $cargo, $orgao, $facebook, $instagram) {
        return $this->data->Query('INSERT INTO db_pessoas (pessoa_nome, pessoa_aniversario, pessoa_email, pessoa_telefone, pessoa_endereco, pessoa_estado, pessoa_municipio, pessoa_cep, pessoa_relacao, pessoa_cargo, pessoa_orgao, pessoa_face, pessoa_insta) VALUES ("' . $nome . '", "' . $aniversario . '", "' . $email . '", "' . $telefone . '", "' . addslashes($endereco) . '", "' . $estado . '", "' . addslashes($municipio) . '", "' . $cep . '","' . $relacao . '", "' . $cargo . '", "' . $orgao . '", "' . $facebook . '", "' . $instagram . '")');
    }

    public function atualizarPessoa($id, $nome, $aniversario, $email, $telefone, $endereco, $estado, $municipio, $cep, $relacao, $cargo, $orgao, $facebook, $instagram) {
        if (count($this->data->Buscar('SELECT pessoa_id FROM db_pessoas WHERE pessoa_id = ' . $id . ';')) > 0) {
            return $this->data->Query('UPDATE db_pessoas SET pessoa_nome="' . $nome . '", pessoa_aniversario="' . $aniversario . '", pessoa_email="' . $email . '", pessoa_telefone="' . $telefone . '", pessoa_endereco="' . $endereco . '", pessoa_estado="' . $estado . '", pessoa_municipio="' . $municipio . '", pessoa_cep="' . $cep . '", pessoa_relacao="' . $relacao . '", pessoa_cargo="' . $cargo . '", pessoa_orgao="' . $orgao . '", pessoa_face="' . $facebook . '", pessoa_insta="' . $instagram . '" WHERE pessoa_id=' . $id . ';');
        } else {
            return false;
        }
    }

    public function buscarPessoas() {
        return $this->data->Buscar('SELECT * FROM db_pessoas ORDER BY pessoa_nome ASC');
    }

    public function buscarPessoasId($id) {
        return $this->data->Buscar('SELECT * FROM db_pessoas WHERE pessoa_id = ' . $id . ' ORDER BY pessoa_nome ASC');
    }

    function apagarPessoa($id) {
        if (count($this->data->Buscar('SELECT pessoa_id FROM db_pessoas WHERE pessoa_id = ' . $id . ';')) > 0) {
            return $this->data->Query('DELETE FROM db_pessoas WHERE pessoa_id=' . $id);
        } else {
            return false;
        }
    }
}
