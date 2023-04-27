<?php

class Clipping {

    public function __construct() {
        require '../utils/Data.php';
        $this->data = new Data();
    }

    public function novoClipping($link, $veiculo, $resumo, $data, $texto, $file, $importancia) {
        $sql = '';
        $name = $this->uploadFile($file);
        if (!empty($name)) {
            $sql = 'INSERT INTO db_clipping (clipping_link, clipping_veiculo, clipping_resumo, clipping_data, clipping_texto, clipping_pdf, clipping_importancia) VALUES ("' . $link . '", "' . $veiculo . '", "' . $resumo . '", "' . $data . '", "' . addslashes($texto) . '", "' . $name . '", "' . $importancia . '")';
        } else {
            return false;
        }
        return $this->data->Query($sql);
    }

    function uploadFile($file) {
        $targetDirectory = '../../www/images/';
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = date('Y-m-d-H-i-s') . '.' . $fileExtension;
        $targetFile = $targetDirectory . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (file_exists($targetFile)) {
            return false;
        }
        
        if ($file["size"] > 50000000) {
            return "Erro: o arquivo é muito grande.";
        }
        
        if ($fileType != "pdf" && $fileType != "jpg" && $fileType != "jpeg") {
            return false;
        }
        
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $fileName;
        } else {
            return false;
        }
    }

    public function buscarClipping() {
        return $this->data->Buscar('SELECT * FROM db_clipping ORDER BY clipping_data DESC');
    }

    public function buscarClippingId($id) {
        return $this->data->Buscar('SELECT * FROM db_clipping WHERE clipping_id = ' . $id . ' ;');
    }

   
    function apagarClipping($id) {        
        $busca = $this->data->Buscar('SELECT clipping_id, clipping_pdf FROM db_clipping WHERE clipping_id = ' . $id . ';');
        if (count($busca) > 0) {
            if(unlink('../../www/images/'.$busca[0]['clipping_pdf'])){
                return $this->data->Query('DELETE FROM db_clipping WHERE clipping_id=' . $id);
            }else{
                return false;
            }
            
            
        } else {
            return false;
        }
    }

}
