<?php

class AgendaDeputado {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    public function novoCompromisso($situacao, $data, $horario, $titulo, $local, $equipe, $presenca, $uf, $tipo) {
        return $this->data->Query('INSERT INTO db_agenda (agenda_situacao, agenda_data, agenda_titulo, agenda_local, agenda_equipe, agenda_presenca, agenda_uf, agenda_tipo) VALUES ("' . $situacao . '", "' . $horario . ' ' . $data . ':00", "' . $titulo . '", "' . $local . '", "' . $equipe . '", "' . $presenca . '", "' . $uf . '", "' . $tipo . '")');
    }

    public function atualizarCompromisso($id, $situacao, $data, $horario, $titulo, $local, $equipe, $presenca, $uf, $tipo) {
        return $this->data->Query('UPDATE db_agenda SET agenda_situacao="' . $situacao . '", agenda_data="' . $data . ' ' . $horario . '", agenda_titulo="' . $titulo . '", agenda_local="' . $local . '", agenda_equipe="' . $equipe . '", agenda_presenca="' . $presenca . '", agenda_uf="' . $uf . '", agenda_tipo="' . $tipo . '" WHERE agenda_id = ' . $id . ';');
    }

    public function atualizarStatus($id, $situacao) {
        return $this->data->Query('UPDATE db_agenda SET agenda_situacao="' . $situacao . '"WHERE agenda_id = ' . $id . ';');
    }

    public function buscarCompromissos() {
        return $this->data->Buscar('SELECT * FROM db_agenda WHERE MONTH(agenda_data) = MONTH(NOW()) ORDER BY agenda_data ASC;');
    }

    public function buscarCompromissosId($id) {
        return $this->data->Buscar('SELECT * FROM db_agenda WHERE agenda_id = ' . $id . ';');
    }

    function apagarAgenda($id) {
        if (count($this->data->Buscar('SELECT agenda_id FROM db_agenda WHERE agenda_id = ' . $id . ';')) > 0) {
            return $this->data->Query('DELETE FROM db_agenda WHERE agenda_id=' . $id);
        } else {
            return false;
        }
    }

}
