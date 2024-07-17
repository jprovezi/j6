<?php


class PerfilUsuario extends Controller {

    private $modelLog;
    private $modelNotificacao;
    private $modelPerfil;
    private $modelUsuario;

    public function __construct() {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('perfil');
        $this->loadModel('usuario');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelPerfil = new Perfil();
        $this->modelUsuario = new Usuario();

        //Seta acesso ao menu
        $this->modelUsuario->setAcessoMenu();

    }


    public function main() {
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }      

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Perfil dos Usuários",
                "url" => SITE_URL."/perfil-usuario",  
            ),
        );

        //Permissões do usuário
        $dados["permissaoCadastro"] = $this->modelPerfil->verificaPerfil("cadastrar");
        $dados["permissaoEditar"] = $this->modelPerfil->verificaPerfil("editar");
        $dados["permissaoExcluir"] = $this->modelPerfil->verificaPerfil("excluir");

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);        


        //Carregando dados do banco
        $dados["listagem"] = $this->modelPerfil->getAll();

        //Carregando a view
        $this->loadView("admin/perfil/main",$dados);
    }

    /**
     * Cria view de cadastro
     */
    public function cadastrar(){
               
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }      
        
        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Perfil de Usuários",
                "url" => SITE_URL."/perfil-usuario",  
            ),
            array(
                "nome" => "Novo cadastro",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);     

        //Variáveis de construção da view
        $dados["dadosBanco"] = NULL;
        $dados["galeria"] = array();
        $dados["perfil"] = $this->modelPerfil->getAll();
        $dados["perfil"] = NULL;
        $dados["urlAction"] = SITE_URL."/perfil-usuario/cadastrar-exe";
        
        //Carrega visão
        $this->loadView("admin/perfil/cadUpdate", $dados);
        
    }

    /**
     * Executa o cadastro do controller
     */
    public function cadastrarExe(){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }      
        
        //Recebendo dados do form
        $dataPost = array(
            "nome"           => $_POST['nome'],
        );
        
        
        //Validando dados
        $arrRetorno = $this->modelPerfil->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
            
            //Cadastra dados no banco
            $this->modelPerfil->save($dataPost);
            
            //grava log
            $this->modelLog->gravarLog("Cadastrado novo Perfil de usuário ".$dataPost['nome']);

            //grava Notificação
            //$this->modelNotificacao->gravarNotificacao("Gravado novo Perfil usuário no sistema ".$dataPost["nome"]);
            
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }



    /**
     * Cria view de cadastro
     */
    public function editar($id = 0){
               
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelPerfil->getByid($id);

        $dados["breadcrumb"] = array(
            array(
                "nome" => "Editando Perfil de Usuários",
                "url" => SITE_URL."/perfil-usuario",  
            ),
            array(
                "nome" => "Editando {$dados["dadosBanco"]["nome"]}",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);             
        
        $dados["urlAction"] = SITE_URL."/perfil-usuario/editar-exe/".$dados["dadosBanco"]["id"];
        
        //Carrega visão
        $this->loadView("admin/perfil/cadUpdate", $dados);
        
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 0){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }
        
        //Recebendo dados do cadastro atual
        $dados = $this->modelPerfil->getByid($id);        
        
        //Recebendo dados do form
        $dataPost = array(
            "nome" => $_POST['nome'],
        );

        
        $arrRetorno = $this->modelPerfil->validaForm($_POST, "edicao");


        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
            

            //Atualiza dados no banco
            $this->modelPerfil->update($dataPost,$id);
            
            //grava log
            $this->modelLog->gravarLog("Editado Perfil de usuário ".$dataPost['nome']);

            //grava Notificação
            //$this->modelNotificacao->gravarNotificacao("Editado usuário no sistema ".$dataPost["nome"]);
            
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }    
    

    
    
    /**
     * Remove registro do banco de dados
     */
    public function remover($id){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("excluir") ){
            Common::redir('admin');
        }        
        
        $retornoUsuario = NULL;
        
        //Recebendo dados do usuário
        $dados = $this->modelPerfil->getByid($id);
        
        //Se remover linha com sucesso
        if($this->modelPerfil->delete($id)){
            
            //grava log
            $this->modelLog->gravarLog("Excluído Usuário ".$dados["nome"]." - ".$dados["id"]);

            //Notificação
            //$this->modelNotificacao->gravarNotificacao("Excluído Usuário ".$dados["nome"]." - ".$dados["id"],"",Session::get("idUsuario"));
            
            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }
            
        echo json_encode($retornoUsuario);
        
    }   
    
    
    /*
     * Executa cadastro dos módulos
     */
    public function executaCadastroModulo($id = ""){
        
        //Verifica se usuário tem permissão de usar o módulo
        /*if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }*/
        
        //Remove todo o perfil do sistema
        $this->modelPerfil->removeAllModulos($id);

        
        //Cadastrando modulos pais
        if( isset($_POST["pai"]) ){
            foreach( $_POST["pai"] as $valor ){
                //criando dados para salvar
                $dataPost = array(
                    "id_menu"           => $valor,
                    "id_perfil_sistema" => $id,
                    "cadastrar"         => 'S',
                    "editar"            => 'S',
                    "excluir"           => 'S',
                    "visualizar"        => 'S',
                );
                $this->modelPerfil->cadastrarModulos($dataPost);
            }
        }

        //Remove indices desnecessários para cadastro
        if( isset($_POST["pai"]) ){
            unset($_POST["pai"]);
        }
        if( isset($_POST["unico"]) ){
            unset($_POST["unico"]);
        }
        if( isset($_POST["config"]) ){
            unset($_POST["config"]);
        }
        if( isset($_POST["undefined"]) ){
            unset($_POST["undefined"]);
        }
        if( isset($_POST["busca"]) ){
            unset($_POST["busca"]);
        }


        //Cadastrando restante dos modulos
        foreach ( $_POST as $indiceMenu => $arrAcesso ) {
            
            //criando dados para salvar
            $dataPost = array(
                "id_menu" => $indiceMenu,
                "id_perfil_sistema" => $id,
            );
            
            //cadastrando os acessos dos modulos
            foreach( $arrAcesso as $valor ){
                $dataPost[$valor] = "S";
            }

            //Cadastrando modulo no perfil
            $this->modelPerfil->cadastrarModulos($dataPost);   
            
        }

        //retorno usuário
        $arrRetorno = array(
            "tipo" => "sucesso",
            "mensagem" => "Edição Realizada com sucesso. Para ativar perfil no usuário faça o login novamente",
            "acaoForm" => "edicao",
        );
        echo json_encode($arrRetorno);
        
    }

    /**
     * Cria view de edição
     */
    public function habilitarModulos($id = ""){
        
        //Redireciona usuário se não tem id na URL
        if(!is_numeric($id)){
            Common::redir("admin");
        }
        
        //Verifica se usuário tem permissão de usar o módulo
        /*if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }*/        
        
        //Recebendo dados do usuário
        $dadosPerfil = $this->modelPerfil->getByid($id);
        
        //Variáveis de construção da view
        $dados["perfil"] = $dadosPerfil;
        $dados["moduloSelecionado"] = $this->modelPerfil->modulosSelecionadosPerfil($id);

        //Construção view página
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Habilitando Perfil",
                "url" => SITE_URL."/perfil-usuario",  
            ),
            array(
                "nome" => "{$dados["perfil"]["nome"]}",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);        

        $dados["urlAction"] = SITE_URL."/perfil-usuario/executacadastromodulo/$id";

        //Carrega visão
        $this->loadView("admin/perfil/cadUpdateModulos", $dados);
        
    }    

}

