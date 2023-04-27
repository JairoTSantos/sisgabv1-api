<?php

require '../class/AgendaDeputado.php';
$Data = new AgendaDeputado();
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 0;
$endpoint = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($_SESSION['ponto'])) {
    switch ($endpoint) {
        case 'POST';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            $Data->novoCompromisso($form['situacao'], $form['horario'], $form['data_reuniao'], $form['titulo'], $form['local'], $form['equipe'], $form['presenca'], $form['uf'], $form['tipo']) ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 500 Verifique o LOG');
            break;

        case 'PUT';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            if ($Data->atualizarCompromisso($id, $form['situacao'], $form['horario'], $form['data_reuniao'], $form['titulo'], $form['local'], $form['equipe'], $form['presenca'], $form['uf'], $form['tipo'])) {
                $busca = $Data->buscarCompromissosId($id);
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                header('X-Total-Count: ' . count($busca) . '');
                echo json_encode($busca);
            } else {
                header('HTTP/1.0 500 Internal Server Error');
            }
            break;

        case 'GET':
            if ($id == 0) {
                $busca = $Data->buscarCompromissos();
            } else {
                $busca = $Data->buscarCompromissosId($id);
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
            if ($Data->apagarAgenda($id)) {
                $busca = $Data->buscarCompromissos();
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




