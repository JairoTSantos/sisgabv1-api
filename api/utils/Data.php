<?php

class Data {

    public function configs() {
        $configs = require '../config/app_config.php';
        return $configs;
    }

    public function crypt($string) {
        $iv = random_bytes(16);
        $cipherText = openssl_encrypt($string, 'AES-256-CBC', $this->configs()->key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $cipherText);
    }

    function decrypt($cipherText) {
        $encryptedText = base64_decode($cipherText);
        $iv = substr($encryptedText, 0, 16);
        $encryptedText2 = substr($encryptedText, 16);
        $plainText = openssl_decrypt($encryptedText2, 'AES-256-CBC', $this->configs()->key, OPENSSL_RAW_DATA, $iv);
        return $plainText;
    }

    public function Buscar($query) {
        require_once 'Conexao.php';
        try {
            $banco = Conexao::getInstance()->prepare($query);
            $banco->execute();
            $busca = $banco->fetchAll(PDO::FETCH_ASSOC);
            return $busca;
        } catch (Exception $e) {
            $this->gerarLogDB($e->getMessage());
            return false;
        }
    }

    public function Query($query) {
        require_once 'Conexao.php';
        try {
            $banco = Conexao::getInstance()->prepare($query);
            $banco->execute();
            return true;
        } catch (PDOException $e) {
            $this->gerarLogDB($e);
            return false;
        }
    }

    public function gerarLogDB($mensagem) {
        $texto = "Erro de banco de dados: " . date('d/m/Y') . " - " . date('H:i') . " - " . $mensagem . "\r\n";
        date_default_timezone_set('America/Sao_Paulo');
        $arquivo = fopen($this->configs()->logUrl . "log_erros_DB.txt", "a");
        fwrite($arquivo, $texto);
        fclose($arquivo);
    }

    public function gerarLogAcesso($ponto, $nome) {
        $texto = "Acesso: " . date('d/m/Y') . " - " . date('H:i') . " - Ponto: " . $ponto . " - Nome: " . $nome . "\r\n";
        date_default_timezone_set('America/Sao_Paulo');
        $arquivo = fopen($this->configs()->logUrl . "log_acesso.txt", "a");
        fwrite($arquivo, $texto);
        fclose($arquivo);
    }

    public function pegarUrlApi($url, $post = NULL, array $header = array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        if (count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if ($post !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data);
    }

}
