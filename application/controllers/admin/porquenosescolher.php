<?php

class PorqueNosEscolher extends Controller {

    private $modelLog;
    private $modelNotificacao;
    private $modelPerfil;
    private $modelUsuario;
    private $modelIcone;
    private $modelPorqueNosEscolher;

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
        $this->loadModel('icone');
        $this->loadModel('pqnosescolher');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelIcone = new Icone();
        $this->modelPorqueNosEscolher = new PqNosEscolher();

        //Adiciona Acesso ao menu
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
                "nome" => "Porque Nos Escolher",
                "url" => SITE_URL."/porque-nos-escolher",  
            ),  
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);    

        //Perfil do usuário
        $dados["cadastrar"] = $this->modelPerfil->verificaPerfil("cadastrar");
        $dados["editar"] = $this->modelPerfil->verificaPerfil("editar");
        $dados["excluir"] = $this->modelPerfil->verificaPerfil("excluir");        
       
        //Carregando dados banco
        $dados["listagem"] = $this->modelPorqueNosEscolher->getAll();

        //Carregando a view
        $this->loadView("admin/porquenosescolher/main",$dados);    

    }    

    public function cadastrar(){
               
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }        
        
        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Porque Nos Escolher",
                "url" => SITE_URL."/porque-nos-escolher",  
            ),
            array(
                "nome" => "Cadastrar",
                "url" => "",  
            ),
        );

        //Recebendo ícones do banco
        $dados["icones"] = $this->modelIcone->getAll(array("orderBy"=>"id ASC"));

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);    

        //Variáveis de construção da view
        $dados["dadosBanco"] = NULL;

        $dados["urlAction"] = SITE_URL."/porque-nos-escolher/cadastrar-exe";
        
        //Carrega visão
        $this->loadView("admin/porquenosescolher/cadUpdate", $dados);
        
    }

    public function cadastrarExe(){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }
        
        //Recebendo dados do form
        $dataPost = array(
            "titulo"       => $_POST['titulo'],
            "texto"       => $_POST['texto'],
            "icone"      => $_POST['icone'],
        );

        
        //Validando dados
        $arrRetorno = $this->modelPorqueNosEscolher->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
             
            //Cadastra dados no banco
            $this->modelPorqueNosEscolher->save($dataPost);
            
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }

  /**
     * Cria view de cadastro
     */
    public function editar($id = 0){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelPorqueNosEscolher->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Porque Nos Escolher",
                "url" => SITE_URL."/porque-nos-escolher",  
            ),
            array(
                "nome" => $dados["dadosBanco"]["titulo"],
                "url" => "",  
            ),
        );
        $dados["urlAction"] = SITE_URL."/porque-nos-escolher/editar-exe/".$dados["dadosBanco"]["id"];

        //Recebendo ícones do banco
        $dados["icones"] = $this->modelIcone->getAll(array("orderBy"=>"id ASC"));

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);            
        
        
        //Carrega visão
        $this->loadView("admin/porquenosescolher/cadUpdate", $dados);
        
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 0){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }
        
        //Recebendo dados do cadastro atual
        $dados = $this->modelPorqueNosEscolher->getByid($id);        
        
        //Recebendo dados do form
        $dataPost = array(
            "titulo"       => $_POST['titulo'],
            "texto"       => $_POST['texto'],
            "icone"      => $_POST['icone'],
        );

        
        $arrRetorno = $this->modelPorqueNosEscolher->validaForm($_POST, "edicao");


        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
                        
            //Cadastra dados no banco
            $this->modelPorqueNosEscolher->update($dataPost,$id);
                        
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
        $dados = $this->modelPorqueNosEscolher->getByid($id);

        
        //Se remover linha com sucesso
        if($this->modelPorqueNosEscolher->delete($id)){
            
            //grava log
            $this->modelLog->gravarLog("Excluído registro Porque nos escolher : ".$dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído registro Porque nos escolher : ".$dados["id"],"","all");
            
            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }
            
        echo json_encode($retornoUsuario);
        
    }    

}

