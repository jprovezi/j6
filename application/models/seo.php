<?php

class Seo extends Model{
    
    //Nome da tabela trabalhada no modelo
    private $_tabela = "seo";
    
    /**
     * Retornando todos os valores
     * @return Array
     */
    public function getAll(){
        $query = "SELECT * FROM {$this->_tabela} ORDER BY nome ASC";
        return $this->db->select($query);
    }
    
    /**
     * Retorna um valor especifico da base a partir do id do registro
     * @param Integer $id
     * @return Array
     */
    public function getByid($id){
        $id = (int) $id;//recebendo apenas um id
        $query     = "SELECT * FROM {$this->_tabela} WHERE id = :id";
        $dataWhere = array(":id" => $id);
        return $this->db->select($query, $dataWhere, FALSE);
    }
    
    /**
     * Retorna os contatos a partir de uma busca LIKE
     * @param String $busca
     * @return Array
     */
    public function getLike($busca){ 
        $query = "SELECT * FROM {$this->_tabela} WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%'";
        return $this->db->select($query);
    }
    
    /**
     * Deleta um registro no banco de dados
     * @param Integer $id
     * @return Integer
     */
    public function remove($id){
        $id = (int) $id;
        return $this->db->delete($this->_tabela, "id = '$id'");
    }
    
    /**
     * Cadastra dados no banco de dados retorna o numero do ultimo id cadastrado
     * @param Array $contato
     * @return Integer
     */
    public function cadastrar($contato = array()){
        //processa o cadastro
        return $this->db->insert($this->_tabela,$contato);
    }
    
    /**
     * Atualiza um ou mais registros no banco de dados
     * @param Array $contato
     * @param Integer $id
     * @return Integer
     */
    public function atualizar($contato, $id){
        //montando o where do update
        $where = "id = " . (int) $id;
        
        //Executa a operação
        return $this->db->update($this->_tabela, $contato, $where);
    }
    
    /**
     * Validação de campos do formulário
     * @param array $dataCadastro
     * @return array
     */
    public function validaForm($dataCadastro, $tipoValidacao = "") {
        $arrRetorno = array(
            "tipo" => "sucesso",
            "mensagem" => "Atualizado com sucesso!",
            "acaoForm" => "",
                //"acaoForm" => "reset",
                "acaoForm" => "redir",
                "url" => SITE_URL."/admin-config",
        );            
        return $arrRetorno;
    }    
    
}
