<?php

class LayoutAdmin extends Controller {

    private $modelLog;
    private $modelNotificacao;
    private $modelPerfil;
    private $modelUsuario;
    private $modelLayoutSite;

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
        $this->loadModel('layoutsite');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelLayoutSite = new LayoutSite();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();


    }


    public function main() {

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }

        //Carregar edição config
        $this->layout();
    }    
     

    /**
     * Cria view de cadastro
     */
    public function layout(){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }


        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);            
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelLayoutSite->getByid(1);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Layout do site",
                "url" => SITE_URL."/layout-admin",  
            ),
            array(
                "nome" => "{$dados["dadosBanco"]["template"]}",
                "url" => "",  
            ),
        );
        
        $dados["urlAction"] = SITE_URL."/layout-admin/layout-exe/".$dados["dadosBanco"]["id"];
        
        //Carrega visão
        $this->loadView("admin/layout/layoutUpdate", $dados);
        
    }


    /**
     * Executa a edição do controller
     */
    public function layoutExe($id = 1){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }

        //Recebendo dados do form
        $dataPost = array(
            "cor_primaria"   => ( strlen($_POST['cor_primaria']) <= 6 ) ? "#".$_POST['cor_primaria'] : $_POST['cor_primaria'],
            "cor_secundaria" => ( strlen($_POST['cor_secundaria']) <= 6 ) ? "#".$_POST['cor_secundaria'] : $_POST['cor_secundaria'],
            "cor_terciaria"  => ( strlen($_POST['cor_terciaria']) <= 6 ) ? "#".$_POST['cor_terciaria'] : $_POST['cor_terciaria'],
            "template"       => $_POST['template'],
            "css"            => $_POST['css'],
        );

        //Edita dados no banco
        $this->modelLayoutSite->update($dataPost,$id);
        
        //Retorno para usuário
        $arrRetorno = array(
            "tipo" => "sucesso",
            "mensagem" => "Edição Realizada com sucesso!",
        );           
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }       
  

}

