<?php

class Notificacoes extends Model {

    private $_tabela = "notificacoes";
    
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
        $query = "SELECT count(*) as total FROM {$this->_tabela} ";
        
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
    public function save($dataPost = array()) {
        //processa o cadastro
        return $this->db->insert($this->_tabela, $dataPost);
    }
    
    /**
     * Atualiza registro no banco
     * @param Array $dataPost
     * @param Integer $id
     * @return Integer
     */
    public function update($dataPost, $id) {
        //montando o where do update
        $where = "id = " . (int) $id;

        //Executa a operação
        return $this->db->update($this->_tabela, $dataPost, $where);
    }

    /**
     * Grava notificação no sistema
     *
     * @param string $mensagem
     * @param string $url
     * @param integer $id_usuario - Se for 0 ele gera a notificação para o usuário logado, se for all ele gera para todos
     * @return void
     */
    public function gravarNotificacao($mensagem, $url = null, $id_usuario = 0){

        //Verificando id usuário
        if($id_usuario == 0){
            $dataPost["id_usuario"] = Session::get("id_usuario");
        }

        $dataPost = array(
            "mensagem"    => $mensagem,
            "url"         => $url,
            "aberta"      => "N"
        );
        $this->save($dataPost);
    }

    /**
     * Retorna as ultimas notificacoes do usuário ou notificacoes gerais
     *
     * @return void
     */
    public function getNotificacoes(){
        return $this->getAll(array("where" => "id_usuario IS NULL OR id_usuario = ".Session::get("id_usuario")."", "orderBy" => "id DESC", "limit" => "6", "offset" => ""));
    }


    /**
     * Retorna o total de notificações não lidas no sistema
     * @param array $notificacoes
     * @return int
     */
    public function totalNotificacoesNaoLidas($notificacoes){
        $total = 0;
        foreach($notificacoes as $valor){
            if($valor["aberta"] == "N"){
                $total++;
            }
        }
        return $total;
    }
    
}
