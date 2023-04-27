<?php

require '../class/Emendas.php';
$Data = new Emendas();
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 0;
$endpoint = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($_SESSION['ponto'])) {
    switch ($endpoint) {
        case 'POST';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            $Data->novaEmenda($form['numero'], $form['orgao'], $form['beneficiario'], $form['objeto'], $form['modalidade'], $form['grupo'], $form['proposta'], $form['valor'], $form['empenho'], $form['ordem'], $form['situacao'], $form['data'], $form['tipo']) ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 500 Verifique o LOG');
            break;

        case 'PUT';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            if ($Data->atualizarEmenda($id, $form['numero'], $form['orgao'], $form['beneficiario'], $form['objeto'], $form['modalidade'], $form['grupo'], $form['proposta'], $form['valor'], $form['empenho'], $form['ordem'], $form['situacao'], $form['data'], $form['tipo'])) {
                $busca = $Data->buscarEmendasId($id);
                header("HTTP/1.1 200 OK");
                header('Content-type: application/json');
                header('X-Total-Count: ' . count($busca) . '');
                echo json_encode($busca);
            } else {
                header('HTTP/1.0 204 No Content');
            }
            break;

        case 'GET':
            if ($id == 0) {
                $busca = $Data->buscarEmendas();
            } else {
                $busca = $Data->buscarEmendasId($id);
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
            if ($Data->apagarEmenda($id)) {
                $busca = $Data->buscarEmendas();
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




