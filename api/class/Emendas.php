<?php

class Emendas {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    public function novaEmenda($numero, $orgao, $beneficiario, $objeto, $modalidade, $grupo, $proposta, $valor, $empenho, $ordem, $situacao, $data, $tipo) {
        return $this->data->Query('INSERT INTO db_emendas (emenda_numero, emenda_orgao, emenda_beneficiario, emenda_objeto, emenda_modalidade, emenda_grupo, emenda_proposta, emenda_valor, emenda_empenho, emenda_ordem, emenda_situacao, emenda_data, emenda_tipo) VALUES (' . $numero . ', "' . $orgao . '", "' . $beneficiario . '", "' . $objeto . '", ' . $modalidade . ', ' . $grupo . ', "' . $proposta . '", "' . $valor . '", "' . $empenho . '", "' . $ordem . '", "' . $situacao . '", "' . $data . '", "' . $tipo . '");');
    }

    public function atualizarEmenda($id, $numero, $orgao, $beneficiario, $objeto, $modalidade, $grupo, $proposta, $valor, $empenho, $ordem, $situacao, $data, $tipo) {
        if (count($this->data->Buscar('SELECT emenda_id FROM db_emendas WHERE emenda_id = ' . $id . ';')) > 0) {
            return $this->data->Query('UPDATE db_emendas SET emenda_numero = ' . $numero . ', emenda_orgao = "' . $orgao . '", emenda_beneficiario = "' . $beneficiario . '", emenda_objeto = "' . $objeto . '", emenda_modalidade = ' . $modalidade . ', emenda_grupo = ' . $grupo . ', emenda_proposta = "' . $proposta . '", emenda_valor = "' . $valor . '", emenda_empenho = "' . $empenho . '", emenda_ordem = "' . $ordem . '", emenda_situacao = "' . $situacao . '", emenda_data = "' . $data . '", emenda_tipo = "' . $tipo . '" WHERE emenda_id = ' . $id . ';');
        }else{
            return false;
        }        
    }

    public function buscarEmendas() {
        return $this->data->Buscar('SELECT * FROM db_emendas');
    }

    public function buscarEmendasId($id) {
        return $this->data->Buscar('SELECT * FROM db_emendas WHERE emenda_id = ' . $id . ';');
    }  

    function apagarEmenda($id) {
        if (count($this->data->Buscar('SELECT emenda_id FROM db_emendas WHERE emenda_id = ' . $id . ';')) > 0) {
            return $this->data->Query('DELETE FROM db_emendas WHERE emenda_id=' . $id);
        } else {
            return false;
        }
    }
}
