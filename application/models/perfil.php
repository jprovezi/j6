<?php

class Perfil extends Model {

    private $_tabela = "perfil_sistema";
    
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
     * retorna os dados dos modulos ativos para aquele perfil
     * @param array $config
     * @return array
     */
    public function getAllModulos($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")) {
        $query = "SELECT * FROM {$this->_tabela}_modulos ";
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
     * Deleta um registro no banco de dados
     * @param Integer $id
     * @return Integer
     */
    public function delete($id) {
        $id = (int) $id;
        return $this->db->delete($this->_tabela, "id = '$id'");
    }
    
    /**
     * Remove todos os modulos do sistema pelo id do perfil
     */
    public function removeAllModulos($idPerfilSistema){
        $idPerfilSistema = (int) $idPerfilSistema;
        return $this->db->delete($this->_tabela."_modulos", "id_perfil_sistema = '$idPerfilSistema'");
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
     * Cadastra os modulos do perfil selecionado
     */
    public function cadastrarModulos($dataPost = array()) {
        //processa o cadastro
        return $this->db->insert($this->_tabela."_modulos", $dataPost);
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
     * Validação de campos do formulário
     * @param array $dataCadastro
     * @return array
     */
    public function validaForm($dataCadastro, $tipoValidacao = "cadastro"){
        
        if(Common::validarEmBranco($dataCadastro["nome"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome do Perfil</strong> não pode estar em branco",
                "iconAlert" => "fa-user-tie",
            );
        }else if(Common::validarMinimo($dataCadastro["nome"], 5)){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome do Perfil</strong> deve ter pelo menos 5 caracteres",
                "iconAlert" => "fa-user-tie",
            );                        
        }else{
            if($tipoValidacao == "cadastro"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "mensagem" => "Cadastro Realizada com sucesso!",
                    "acaoForm" => "redir",
                    "url" => SITE_URL."/perfil-usuario",                    
                );
            }else if($tipoValidacao == "edicao"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
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
     * Verifica se o modulo é ativo para usuário logado no sistema
     * @param int $id_menu
     * @param string $acaoModulo cadastrar, editar, deletar, visualizar
     * @return Boolean
     */
    public function verificaPerfil(String $acaoModulo){
        
        //Recebendo Identificação do Perfil do sistema
        $id_perfil_sistema = Session::get("dadosUsuario");
        
        //verificando se usuário tem acesso ao módulo
        $query = "SELECT * FROM {$this->_tabela}_modulos "
        . "WHERE id_menu = {$this->getIdMenuController()} AND id_perfil_sistema = {$id_perfil_sistema["id_perfil"]} AND $acaoModulo = 'S'";

        if( !empty($this->db->select($query)) ){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Retorna id do menu conforme nome do controlador
     * @return integer
     */
    public function getIdMenuController(){
        $controlador = Common::getControlador();
        $query = "SELECT * FROM menu "
        . "WHERE controller = '$controlador'";
        $menuRow = $this->db->select($query, "", FALSE);
        return $menuRow["id"];
    }
    
    /**
     * Retorna um array com os modulos selecionados do perfil
     * @param int $id_perfil_sistema
     * @return array
     */
    public function modulosSelecionadosPerfil($id_perfil_sistema){
        
        //Recebe modulos do perfil
        $arrModulos = $this->getAllModulos(array("where"=>"id_perfil_sistema = $id_perfil_sistema"));
        $arrRetorno = NULL;
        
        foreach( $arrModulos as $valor ){
            
            //Recebendo os valores atuais e convertendo
            $id_menu = $valor["id_menu"];
            $cadastrar = ( $valor["cadastrar"] == "S" ) ? "checked=''" : "";
            $editar = ( $valor["editar"] == "S" ) ? "checked=''" : "";
            $excluir = ( $valor["excluir"] == "S" ) ? "checked=''" : "";
            $visualizar = ( $valor["visualizar"] == "S" ) ? "checked=''" : "";
            
            //Criando array de retorno dos modulos selecionados do perfil
            $arrRetorno[$id_menu] = array(
                "cadastrar" => "$cadastrar",
                "editar" => "$editar",
                "excluir" => "$excluir",
                "visualizar" => "$visualizar",
            );
           
        }
        return $arrRetorno;
    }

}
