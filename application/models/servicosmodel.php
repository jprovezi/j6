<?php

class ServicosModel extends Model {

    private $_tabela = "site_servicos";

    
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
     * SQL especifico para trazer todos os dados com o nome da categoria
     *
     * @return void
     */
    public function getAllServicosCategorias() {
        $query = "SELECT

        sp.id, sp.titulo, sp.texto, sp.capa, sp.dir_galeria, sp.url_video, sp.categoria_id, sp.ativo, sp.destaque, sp.link_pagamento, sp.preco,
        spc.titulo AS categoria
        
        FROM site_servicos sp
        JOIN site_servicos_categoria spc
        
        WHERE
        spc.id = sp.categoria_id OR ISNULL(sp.categoria_id)
        
        GROUP BY sp.id";
        
        return $this->db->select($query);
    }

    /**
     * Retorna os registros da tabela
     * @param array $config array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")
     * @return array
     */
    public function getAllCategoria($config = array("where" => "", "orderBy" => "", "limit" => "", "offset" => "")) {
        $query = "SELECT * FROM {$this->_tabela}_categoria ";
        $query .= $this->configQuery($config);
        
        return $this->db->select($query);
    }

    public function getAllCategoriaAtivas() {
        $query = "SELECT

        spc.id, spc.titulo
        
        FROM site_servicos_categoria spc
        INNER JOIN site_servicos sp
        
        WHERE
        spc.id = sp.categoria_id
        
        GROUP BY spc.id";
        
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
     * Retorna os contatos a partir de uma busca LIKE
     * @param String $busca
     * @return Array
     */
    public function getLike($busca) {
        $query = "SELECT * FROM {$this->_tabela} WHERE titulo LIKE '%$busca%' OR texto LIKE '%$busca%' ORDER BY id DESC LIMIT 100";
        return $this->db->select($query);
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

    public function deleteCategoria($id) {
        $id = (int) $id;
        return $this->db->delete($this->_tabela."_categoria", "id = '$id'");
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

    public function saveCategoria($dataPost = array()) {
        //processa o cadastro
        return $this->db->insert($this->_tabela."_categoria", $dataPost);
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
    public function validaForm($dataCadastro, $tipoValidacao = "cadastro", $tituloBanco = ""){

        //Verificando se o titulo que será criado o controlador não está em uso
        $this->_tabela = "site_menu";
        $dadosMenuSite = $this->getAll(array("where"=>"titulo = '{$dataCadastro['titulo']}' OR pseudo_titulo = '{$dataCadastro['titulo']}'"));
        
        $this->_tabela = "menu";
        $dadosMenuSistema = $this->getAll(array("where"=>"url = '{$dataCadastro['titulo']}' OR controller = '{$dataCadastro['titulo']}'"));

        $this->_tabela = "site_slug";
        $slug = Common::slug($dataCadastro['titulo']);
        $slug = Common::slugNomeArquivo($slug);
        $dadosMenuSlug = $this->getAll(array("where"=>"slug = '$slug'"));

        //Volta o nome da tabela
        $this->_tabela = "site_servicos";         
        
        if(Common::validarEmBranco($dataCadastro["titulo"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Titulo</strong> não pode estar em branco",
            );
        } else if(count($dadosMenuSite) >= 1 || count($dadosMenuSistema) >= 1 || count($dadosMenuSlug) >= 1 && $tituloBanco != $dataCadastro["titulo"]){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "Título: <strong>{$dataCadastro['titulo']}</strong> não pode ser cadastrado, escolha outro nome!",
            );
        }else{

            if($tipoValidacao == "cadastro"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "mensagem" => "Cadastro Realizada com sucesso!",
                    "acaoForm" => "redir",
                    "url" => SITE_URL."/servicos-admin",                    
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

}
