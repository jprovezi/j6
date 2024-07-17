<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe para criar o menu do sistema
 *
 * @author joao
 */
class Menu extends Model{
    
    private $_tabela = "menu";

    public function __construct() {
        parent::__construct();
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
    public function delete($id) {
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
     * Retorna os contatos a partir de uma busca LIKE
     * @param String $busca
     * @return Array
     */
    public function getLike($busca) {
        $query = "SELECT * FROM {$this->_tabela} WHERE nome LIKE '%$busca%' OR tags LIKE '%$busca%'";
        return $this->db->select($query);
    }    

    /**
     * Validação de campos do formulário
     * @param array $dataCadastro
     * @return array
     */
    public function validaForm($dataCadastro, $tipoValidacao = "cadastro"){
        
        if(Common::validarEmBranco($dataCadastro["nome"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome Completo</strong> não pode estar em branco",
            );
        }else if(Common::validarEmBranco($dataCadastro["url"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>URL</strong> não pode estar em branco",
            );            
        }else if(Common::validarEmBranco($dataCadastro["controller"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Controller</strong> Não pode estar em branco",
            );             
        }else{
            if($tipoValidacao == "cadastro"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "mensagem" => "Cadastro Realizada com sucesso!",
                    "acaoForm" => "redir",
                    "url" => SITE_URL."/configuracoes-admin/menu",                    
                );
            }else if($tipoValidacao == "edicao"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "acaoForm" => "",
                    "mensagem" => "Edição Realizada com sucesso!",
                );
            }else if($tipoValidacao == "edicaoImagem"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "mensagem" => "Edição Realizada com sucesso!",
                    "acaoForm" => "reload",
                );                
            }
        }
        
        return $arrRetorno;
        
    }    
    
    /**
     * Retorna um array com todos os menus do sistema, cadastrados no banco de dados
     * @return array
     */
    public function getMenuSistema(){
        
        //Recebendo menu unico
        $query = "SELECT * FROM {$this->_tabela} WHERE categoria = :categoria ORDER BY ordem ASC";
        $dataWhere = array(":categoria" => "unico");
        $arrMenu["unico"] = $this->db->select($query, $dataWhere);
        
        //Recebendo menu categoria pai
        $query = "SELECT * FROM {$this->_tabela} WHERE categoria = :categoria ORDER BY ordem ASC";
        $dataWhere = array(":categoria" => "pai");
        $arrMenu["pai"] = $this->db->select($query, $dataWhere);
        
        //Criando menu filhos do pai
        foreach($arrMenu["pai"] as $indice => $valor){
            $query = "SELECT * FROM {$this->_tabela} WHERE idFilho = :id ORDER BY ordem ASC";
            $dataWhere = array(":id" => $valor["id"]);       
            $valor["filhos"] = $this->db->select($query, $dataWhere);
            $arrMenu["pai"][$indice] = $valor;// Mudando índice no array com carga das categorias filhas
        }
        
        //Recebendo menu de configurações
        $query = "SELECT * FROM {$this->_tabela} WHERE categoria = :categoria ORDER BY ordem ASC";
        $dataWhere = array(":categoria" => "config");
        $arrMenu["config"] = $this->db->select($query, $dataWhere);        
        
        return $arrMenu;
        
    }
    
    
    
    
    
}
