<?php

class Servidor {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    function novoServidor($ponto, $nome, $aniversario, $email, $telefone, $lotacao, $senha, $nivel) {  
        if(count($this->data->Buscar('SELECT servidor_ponto FROM db_servidores WHERE servidor_ponto = '.$ponto.';')) > 0){
            return false;
        }else{
            return $this->data->Query('INSERT INTO db_servidores (servidor_ponto, servidor_nome, servidor_aniversario, servidor_email, servidor_telefone, servidor_lotacao, servidor_senha, servidor_nivel) VALUES (' . $ponto . ', "' . $nome . '", "' . $aniversario . '", "' . $email . '", "' . $telefone . '", "' . $lotacao . '", "' . $this->data->crypt($senha) . '", "' . $nivel . '")');
        }
    }

    function atualizarServidor($ponto, $email, $telefone, $nivel, $lotacao) {        
        return $this->data->Query('UPDATE db_servidores SET servidor_email="' . $email . '",servidor_telefone="' . $telefone . '", servidor_lotacao="' . $lotacao . '",  servidor_nivel=' . $nivel . ' WHERE servidor_ponto = "' . $ponto . '";');
    }

    function buscarServidor() {
        return $this->data->Buscar('SELECT servidor_ponto, servidor_nome, servidor_aniversario, servidor_email, servidor_telefone, servidor_lotacao, servidor_nivel, servidor_criado_em FROM db_servidores ORDER BY servidor_nome ASC');
    }
    
    function buscarServidorId($ponto) {
        return $this->data->Buscar('SELECT servidor_ponto, servidor_nome, servidor_aniversario, servidor_email, servidor_telefone, servidor_lotacao, servidor_nivel, servidor_criado_em FROM db_servidores WHERE servidor_ponto = '.$ponto.' ORDER BY servidor_nome ASC');
    }

    function apagarServidor($ponto) {  
        if(count($this->data->Buscar('SELECT servidor_ponto FROM db_servidores WHERE servidor_ponto = '.$ponto.';')) > 0){
            return $this->data->Query('DELETE FROM db_servidores WHERE servidor_ponto=' . $ponto . ';');
        }else{
            return false;
        }
    }
}
