<?php

require '../class/Clipping.php';
$Data = new Clipping();
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_UNSAFE_RAW) ?: 0 ;
$endpoint = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


$link = filter_input(INPUT_POST, 'link', FILTER_UNSAFE_RAW);
$veiculo = filter_input(INPUT_POST, 'veiculo', FILTER_UNSAFE_RAW);
$resumo = filter_input(INPUT_POST, 'resumo', FILTER_UNSAFE_RAW);
$data = filter_input(INPUT_POST, 'data', FILTER_UNSAFE_RAW);
$data2 = filter_input(INPUT_GET, 'data', FILTER_UNSAFE_RAW);
$texto = filter_input(INPUT_POST, 'texto', FILTER_UNSAFE_RAW);
$importancia = filter_input(INPUT_POST, 'importancia', FILTER_UNSAFE_RAW);

if (!empty($_SESSION['ponto'])) {
    switch ($endpoint) {
        case 'POST';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            $Data->novoClipping($link, $veiculo, $resumo, $data, $texto, $_FILES["file"], $importancia) ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 500 Verifique o LOG');
            break;

        case 'GET':
            
            if ($id == 0) {
                $busca = $Data->buscarClipping();
            } else {
                $busca = $Data->buscarClippingId($id);
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
            if ($Data->apagarClipping($id)) {
                $busca = $Data->buscarClipping();
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




