<?php

class Crud extends Model {

    private $tabela = "";

    public function setTabela($tabela){
        $this->tabela = $tabela;
    }

    public function getTabela(){
        return $this->tabela;
    }

    
    /**
     * Configura o restante da query na classe
     * @param array $config
     * @return string
     */
    private function configQuery($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")){
        $query = "";
        //Criando WHERE
        if(!empty($config["where"])){
            $query .= "WHERE ".$config["where"]." ";
        }
        //Criando ORDER BY
        if(!empty($config["orderBy"])){
            $query .= "ORDER BY ".$config["orderBy"]." ";
        }
        //Criando LIMIT
        if(!empty($config["limit"])){
            $query .= "LIMIT ".$config["limit"]." ";
        }
        //Criando OFFSET
        if(!empty($config["offset"])){
            $query .= "OFFSET ".$config["offset"]." ";
        }
        
        return $query;
    }
    

    public function getAll($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")) {
        $query = "SELECT * FROM {$this->getTabela()} ";
        $query .= $this->configQuery($config);
        return $this->db->select($query);
    }
    

    public function getByControlador($string) {
        $string = (string) $string;
        $query = "SELECT * FROM {$this->getTabela()} WHERE controlador = :controlador";
        $dataWhere = array(":controlador" => $string);
        return $this->db->select($query, $dataWhere, FALSE);
    }

    public function getByid($id) {
        $id = (int) $id;
        $query = "SELECT * FROM {$this->getTabela()} WHERE id = :id";
        $dataWhere = array(":id" => $id);
        return $this->db->select($query, $dataWhere, FALSE);
    }

    public function remove($id) {
        $id = (int) $id;
        return $this->db->delete($this->getTabela(), "id = '$id'");
    }


    public function cadastrar($dataPost = array()) {
        //processa o cadastro
        return $this->db->insert($this->getTabela(), $dataPost);
    }


    public function atualizar($dataPost, $id) {
        //montando o where do update
        $where = "id = " . (int) $id;

        //Executa a operação
        return $this->db->update($this->getTabela(), $dataPost, $where);
    }

    public function validaForm($dataCadastro, $tipoValidacao = "") {
        $arrRetorno = array(
            "tipo" => "sucesso",
            "mensagem" => "Atualizado com sucesso!",
            "acaoForm" => "reload",
        );            
        return $arrRetorno;
    }
    
}
    