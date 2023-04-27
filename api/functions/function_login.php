<?php

require '../class/Login.php';
$Data = new Login();

$acao = filter_input(INPUT_GET, 'acao', FILTER_UNSAFE_RAW);
$ponto = filter_input(INPUT_POST, 'ponto', FILTER_UNSAFE_RAW);
$senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);



switch ($acao) {

    case 'login':
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'POST') {
            $Data->login($ponto, $senha) ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 403 Forbidden');
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
        }
        break;

    case 'logout':
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'GET') {
            $Data->logout() ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 500 Verifique o LOG');
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
        }

        break;

    case 'verificaLogin':
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'GET') {
            $Data->verificaLogin() ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 403 Forbidden');
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
        }
        break;

    default:
        header('HTTP/1.0 404 Comando não encontrado');
}