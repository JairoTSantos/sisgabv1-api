<?php

require '../class/Pessoas.php';
$Data = new Pessoas();
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 0;
$endpoint = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($_SESSION['ponto'])) {
    switch ($endpoint) {
        case 'POST';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            $Data->novaPessoa($form['nome'], $form['aniversario'], $form['email'], $form['telefone'], $form['endereco'], $form['estado'], $form['municipio'], $form['cep'], $form['relacao'], $form['cargo'], $form['orgao'], $form['facebook'], $form['instagram']) ? header("HTTP/1.1 200 OK") : header('HTTP/1.0 500 Verifique o LOG');
            break;

        case 'PUT';
            $dados = file_get_contents('php://input');
            parse_str($dados, $form);
            if ($Data->atualizarPessoa($id, $form['nome'], $form['aniversario'], $form['email'], $form['telefone'], $form['endereco'], $form['estado'], $form['municipio'], $form['cep'], $form['relacao'], $form['cargo'], $form['orgao'], $form['facebook'], $form['instagram'])) {
                $busca = $Data->buscarPessoasId($id);
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
                $busca = $Data->buscarPessoas();
            } else {
                $busca = $Data->buscarPessoasId($id);
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
            if ($Data->apagarPessoa($id)) {
                $busca = $Data->buscarPessoas();
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




