<?php

class Usuario extends Model {

    private $_tabela = "usuarios";

    /**
     * Validação do formulario de login e verificação de login e senha
     * para autenticação do usuário no sistema
     * @param String $email
     * @param String $senha
     * @return String
     */
    public function validaUsuario($email, $senha) {

        //SQL para localizar Usuario e Senha no banco
        $sql = "SELECT id FROM {$this->_tabela} WHERE email = :email AND senha = :senha";

        //parametros para verificar login e senha do usuario no banco de dados
        $dataSql = array(
            ':email' => $email,
            ':senha' => md5($senha)
        );

        //Se achar registro retorna usuário logado
        return $this->db->select($sql, $dataSql, FALSE);
    }

    public function lembrarSenha($email) {

        //SQL para localizar Usuario pelo email no banco
        $sql = "SELECT * FROM {$this->_tabela} WHERE email = :email";

        //parametros para verificar login e senha do usuario no banco de dados
        $dataSql = array(
            ':email' => $email,
        );

        //Se achar registro retorna usuário logado
        return $this->db->select($sql, $dataSql, FALSE);
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
     * Retorna uma linha especifica, se tiver o email registrado no banco
     * @param string $email
     * @return Array
     */
    public function getByEmail($email){
        $query = "SELECT * FROM {$this->_tabela} WHERE email = :email";
        $dataWhere = array(":email" => $email);
        return $this->db->select($query, $dataWhere, FALSE);
    }

    /**
     * Retorna os contatos a partir de uma busca LIKE
     * @param String $busca
     * @return Array
     */
    public function getLike($busca) {
        $query = "SELECT * FROM {$this->_tabela} WHERE (nome LIKE '%$busca%' OR email LIKE '%$busca%' OR cpf LIKE '%$busca%' OR endereco LIKE '%$busca%') AND id <> ".ID_MASTER_ADMIN;
        return $this->db->select($query);
    }

    /**
     * Seleciona uma frase e autor motivacional para o usuário
     *
     * @return array
     */
    public function getFraseMotivacional(){
        $query = "SELECT * FROM pensador ORDER BY RAND() LIMIT 1";
        return $this->db->select($query,"",FALSE);        
    }

    /**
     * Retorna os menus mais acessados pelo usuário
     *
     * @return array
     */
    public function getMenuMaisAcessados(){

        //Recebe menus acessados pelo sistema
        $id = Session::get('id_usuario');
        $query = "SELECT * FROM {$this->_tabela}_acessos_menu WHERE id_usuario = {$id} ORDER BY qt DESC";
        $menuAcessos = $this->db->select($query);

        /**
         * Essa etapa filtramos para ver se o menu ainda tem vinculo com o perfil do usuario. Se não tiver nos deletemos
         */
        $perfil = Session::get("dadosPerfil");
        foreach($menuAcessos as $indice => $valor){
            if( empty(Common::verificaOcorrenciaArrayMatriz($perfil, "id_menu", $valor["id_menu"])) ){
                unset($menuAcessos[$indice]);
            }
        }

        //Recebendo informações dos menu
        foreach($menuAcessos as $indice => $valor){
            $retornoMenu[$indice] = $this->getDadosMenu($valor["id_menu"]);
            $retornoMenu[$indice][0]["qt"] = $valor["qt"];
        }

        return $retornoMenu;

    }
    
    private function getDadosMenu($idMenu = 0, $controller = ""){
        $query = "SELECT * FROM menu WHERE id = {$idMenu} OR controller = '{$controller}'";
        return $this->db->select($query);
    }

    /**
     * Seta +1 no acesso ao Menu do usuário logado ao sistema
     *
     * @return void
     */
    public function setAcessoMenu(){
        $dadosMenu = $this->getDadosMenu(0,Common::getControlador()); //Recebe dados do menu
        $id = Session::get('id_usuario'); //Recebe dados do usuário logado

        //Verifica se o usuário já acessou o menu
        $query = "SELECT * FROM usuarios_acessos_menu WHERE id_usuario = {$id} AND id_menu = {$dadosMenu[0]['id']}";
        $menuAcessado = $this->db->select($query);

        //Se usuário já acessou aquele menu ele soma o contador, caso não insere o registro novo
        if(!empty($menuAcessado)){

            //atualiza tabela somando +1 no acesso ao menu
            $where = "id = " . (int) $menuAcessado[0]["id"];
            $dataPost["qt"] = $menuAcessado[0]["qt"]+1;

            //Executa a operação
            $this->db->update($this->_tabela."_acessos_menu", $dataPost, $where);            

        }else{
            //Dados para salvar
            $dataPost["id_usuario"] = $id;
            $dataPost["id_menu"] = $dadosMenu[0]["id"];

            //Insere registro novo
            $this->db->insert($this->_tabela."_acessos_menu", $dataPost);
        }

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
        }else if(Common::validarMinimo($dataCadastro["nome"], 5)){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome Completo</strong> deve ter pelo menos 5 caracteres",
            );            
        }else if(!Common::validarEmail($dataCadastro["email"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Email</strong> Não é válido",
            );             
        }else if($this->getByEmail($dataCadastro["email"]) && $dataCadastro['emailAtualBanco'] != $dataCadastro['email']){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Email</strong> já está cadastrado no sistema, por favor escolha outro",
            );
        }else if(Common::validarMinimo($dataCadastro["senha"],5) && $dataCadastro["senhaEditar"] == "FALSE"){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Senha</strong> tem que ter pelo menos 5 caracteres",
            );                 
        }else if(!Common::validarCamposIguais($dataCadastro["senha"], $dataCadastro["confirmarSenha"])){
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Senhas</strong> não conferem",
            );            
        }else{
            if($tipoValidacao == "cadastro"){
                $arrRetorno = array(
                    "tipo" => "sucesso",
                    "mensagem" => "Cadastro Realizada com sucesso!",
                    "acaoForm" => "redir",
                    "url" => SITE_URL."/usuarios",                    
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
