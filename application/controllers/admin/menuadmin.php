<?php

class MenuAdmin extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;
    private $modelMenu;

    public function __construct()
    {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if (!Session::get("logado")) {
            Session::destroy();
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('usuario');
        $this->loadModel('perfil');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelMenu = new SiteMenu();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();
    }


    public function main()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("visualizar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Menu",
                "url" => SITE_URL . "/menu-admin",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);


        //Perfil do usuário
        $dados["cadastrar"] = false;
        $dados["editar"] = $this->modelPerfil->verificaPerfil("editar");
        $dados["excluir"] = false;

        //Carregando dados banco
        $dados["listagem"] = $this->modelMenu->getAll();

        //Carregando a view
        $this->loadView("admin/menu/main", $dados);
    }


    public function editar($id = 0)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelMenu->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Menu",
                "url" => SITE_URL . "/menu-admin",
            ),
            array(
                "nome" => "{$dados["dadosBanco"]["titulo"]}",
                "url" => "",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        $dados["urlAction"] = SITE_URL . "/menu-admin/editar-exe/" . $dados["dadosBanco"]["id"];

        //Carrega visão
        $this->loadView("admin/menu/cadUpdate", $dados);
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 0)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Procurando informação do menu atual
        $menu = $this->modelMenu->getByid($id);
        $apelidoAtual = $menu["pseudo_titulo"];
        $controladorBase = Common::slug($menu["titulo"]);

        //Recebendo dados do form
        $dataPost = array(
            "pseudo_titulo"  => Common::removerCaracteresEspeciais($_POST['pseudo_titulo']),
            "menu_topo"      => $_POST['menu_topo'],
            "menu_footer"    => $_POST['menu_footer'],
            "ordem"          => $_POST['ordem'],
        );


        //Validando dados
        $arrRetorno = $this->modelMenu->validaForm($dataPost, $apelidoAtual);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Copia o controlador no sistema
            if($menu["id"] != 0 && !empty($dataPost["pseudo_titulo"]) && $apelidoAtual != $dataPost["pseudo_titulo"]){
                $this->copiaControlador(Common::slug($dataPost["pseudo_titulo"]),$controladorBase);
            }

            //Cadastra dados no banco
            $this->modelMenu->update($dataPost, $id);

            //grava log
            $this->modelLog->gravarLog("Editado Menu do site " . $dataPost['titulo']);

            //Url da notificação
            $url = SITE_URL . "/menu-admin/editar/" . $id;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado Menu do site " . $dataPost["titulo"], $url, "all");
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }


    public function copiaControlador($apelido, $controladorBase)
    {
    
        //lê o controlador que irá aplicar a copia
        $stringController = file_get_contents(CONTROLLER_PATH."/site/".$controladorBase.".php");

        //Cria o nome da classe de copia
        $controladorBaseClass = Common::slugClass($controladorBase);

        //Cria o nome da nova classe
        $apelicoClass = Common::slugClass($apelido);

        //Altera o nome da classe
        $stringController = str_replace("class $controladorBaseClass", "class $apelicoClass", $stringController);

        //Cria o novo controller no sistema
        $arquivo = fopen(CONTROLLER_PATH."/site/".Common::slugNomeArquivo($apelido).".php", 'w');
        fwrite($arquivo, $stringController);
        fclose($arquivo);

    }


    public function ativarRegistro($id, $campoBanco)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Recebe atual situação do registro
        $menu = $this->modelMenu->getByid($id);

        //Faz a inversão do botão
        $ativo = ($menu[$campoBanco] == "S") ? "N" : "S";

        //Salva
        $dataPost = array(
            $campoBanco => $ativo,
        );

        //Modifica o registro
        $this->modelMenu->update($dataPost, $id);
    }

}
