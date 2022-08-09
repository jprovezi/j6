<?php

class ProdutosCategoria extends Model {

    private $_tabela = "produtos_categoria";

    
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
    
    /**
     * Retorna os registros da tabela
     * @param array $config array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")
     * @return array
     */
    public function getAll($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")) {
        $query = "SELECT * FROM {$this->_tabela} ";
        $query .= $this->configQuery($config);
        return $this->db->select($query);
    }
    
    /**
     * Retorna o número total de linhas da consulta
     * @param array $config
     * @return int
     */
    public function getRows($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")) {
        $query = "SELECT count(*)as total FROM {$this->_tabela} ";
        
        $query .= $this->configQuery($config);
        
        $retorno = $this->db->select($query,"",FALSE);
        return $retorno["total"];
    }

    /**
     * Retorna um valor especifico da base a partir do id do registro
     * @param Integer $id
     * @return Array
     */
    public function getByid($id) {
        $id = (int) $id; //recebendo apenas um id
        $query = "SELECT * FROM {$this->_tabela} WHERE id = :id";
        $dataWhere = array(":id" => $id);
        return $this->db->select($query, $dataWhere, FALSE);
    }
    
    /**
     * Retorna um valor especifico da base a partir do id do registro
     * @param Integer $id
     * @return Array
     */
    public function idPrimeiraCategoria() {
        $query = "SELECT id FROM {$this->_tabela} ORDER BY ordem ASC LIMIT 1";
        return $this->db->select($query, array(), FALSE);
    }
    
    /**
     * Retorna os contatos a partir de uma busca LIKE
     * @param String $busca
     * @return Array
     */
    public function getLike($busca) {
        $query = "SELECT * FROM {$this->_tabela} WHERE titulo LIKE '%$busca%' OR texto LIKE '%$busca%'";
        return $this->db->select($query);
    }

    /**
     * Deleta um registro no banco de dados
     * @param Integer $id
     * @return Integer
     */
    public function remove($id) {
        $id = (int) $id;
        return $this->db->delete($this->_tabela, "id = '$id'");
    }

    /**
     * Cadastra dados no banco de dados retorna o numero do ultimo id cadastrado
     * @param Array $dataPost
     * @return Integer
     */
    public function cadastrar($dataPost = array()) {
        //processa o cadastro
        return $this->db->insert($this->_tabela, $dataPost);
    }

    /**
     * Atualiza registro no banco
     * @param Array $dataPost
     * @param Integer $id
     * @return Integer
     */
    public function atualizar($dataPost, $id) {
        //montando o where do update
        $where = "id = " . (int) $id;

        //Executa a operação
        return $this->db->update($this->_tabela, $dataPost, $where);
    }

}
