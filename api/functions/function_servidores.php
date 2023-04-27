<?php

require '../class/Servidor.php';
$Data = new Servidor();
session_start();
$ponto = filter_input(INPUT_GET, 'ponto', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 0;
$endpoint = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($_SESSION['ponto'])) {
    switch ($endpoint) {
        case 'POST';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            if ($Data->novoServidor($form['ponto'], $form['nome'], $form['aniversario'], $form['email'], $form['telefone'], $form['lotacao'], $form['senha'], $form['nivel'])) {
                $busca = $Data->buscarServidorId($form['ponto']);
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                echo json_encode($busca);
            } else {
                header("HTTP/1.1 302 Found");
            }
            break;

        case 'PUT';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            if ($Data->atualizarServidor($ponto, $form['email'], $form['telefone'], $form['nivel'], $form['lotacao'])) {
                $busca = $Data->buscarServidorId($ponto);
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                header('X-Total-Count: ' . count($busca) . '');
                echo json_encode($busca);
            } else {
                header('HTTP/1.0 500 Internal Server Error');
            }
            break;

        case 'GET':
            if ($ponto == 0) {
                $busca = $Data->buscarServidor();
            } else {
                $busca = $Data->buscarServidorId($ponto);
            }
            if (!empty($busca)) {
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                header('X-Total-Count: ' . count($busca) . '');
                echo json_encode($busca);
            } else if (empty($busca)) {
                header('HTTP/1.0 204 No Content');
            } else {
                header('HTTP/1.0 500 Internal Server Error');
            }
            break;

        case 'DELETE':
            if ($Data->apagarServidor($ponto)) {
                $busca = $Data->buscarServidor();
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                header('X-Total-Count: ' . count($busca) . '');
                echo json_encode($busca);
            } else {
                header('HTTP/1.0 204 No Content');
            }
            break;

        default:
            header('HTTP/1.0 405 Method Not Allowed');
    }
} else {
    header('HTTP/1.0 403  Forbidden');
}




