<?php

class Login {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    public function login($ponto, $senha) {
        $busca = $this->data->Buscar('SELECT servidor_ponto, servidor_nome, servidor_senha, servidor_nivel, servidor_email FROM db_servidores WHERE servidor_ponto = "' . $ponto . '";');
        if (count($busca) > 0) {
            if ($this->data->decrypt($busca[0]['servidor_senha']) === $senha) {
                define("LIFETIME", 5);
                session_set_cookie_params(LIFETIME);
                session_start();
                $_SESSION['ponto'] = $busca[0]['servidor_ponto'];
                $_SESSION['nome'] = $busca[0]['servidor_nome'];
                $_SESSION['nivel'] = $busca[0]['servidor_nivel'];
                $_SESSION['email'] = $busca[0]['servidor_email'];
                $this->data->gerarLogAcesso($_SESSION['ponto'], $_SESSION['nome']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        if (session_destroy()) {
            return true;
        }
    }

    public function verificaLogin() {
        session_start();
        if (empty($_SESSION['nome'])) {
            return false;
        } else {
            return true;
        }
    }

}
