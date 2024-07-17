<?php

class SeoAdmin extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelPerfil;
    private $modelUsuario;
    private $modelIcone;
    private $modelSeo;

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
        $this->loadModel('perfil');
        $this->loadModel('usuario');
        $this->loadModel('icone');
        $this->loadModel('seomodel');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelIcone = new Icone();
        $this->modelSeo = new SeoModel();

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
                "nome" => "SEO",
                "url" => SITE_URL . "/seo-admin",
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
        $dados["listagem"] = $this->modelSeo->getAll();

        //Carregando a view
        $this->loadView("admin/seo/main", $dados);
    }

    public function cadastrar()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "SEO",
                "url" => SITE_URL . "/seo-admin",
            ),
            array(
                "nome" => "Cadastrar",
                "url" => "",
            ),
        );

        //Recebendo ícones do banco
        $dados["icones"] = $this->modelIcone->getAll(array("orderBy" => "id ASC"));

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        //Variáveis de construção da view
        $dados["dadosBanco"] = NULL;

        $dados["urlAction"] = SITE_URL . "/seo-admin/cadastrar-exe";

        //Carrega visão
        $this->loadView("admin/seo/cadUpdate", $dados);
    }

    public function cadastrarExe()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Recebendo dados do form
        $dataPost = array(
            "titulo"     => $_POST['titulo'],
            "descricao"  => $_POST['descricao'],
            "url"        => $_POST['url'],
        );


        //Validando dados
        $arrRetorno = $this->modelSeo->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Cadastra dados no banco
            $this->modelSeo->save($dataPost);
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }

    /**
     * Cria view de cadastro
     */
    public function editar($id = 0)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelSeo->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "SEO",
                "url" => SITE_URL . "/seo-admin",
            ),
            array(
                "nome" => $dados["dadosBanco"]["titulo"],
                "url" => "",
            ),
        );
        $dados["urlAction"] = SITE_URL . "/seo-admin/editar-exe/" . $dados["dadosBanco"]["id"];

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        //Carrega visão
        $this->loadView("admin/seo/cadUpdate", $dados);
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

        //Recebendo dados do cadastro atual
        $dados = $this->modelSeo->getByid($id);

        //Recebendo dados do form
        $dataPost = array(
            "titulo"     => $_POST['titulo'],
            "descricao"  => $_POST['descricao'],
            "url"        => $_POST['url'],
        );


        $arrRetorno = $this->modelSeo->validaForm($_POST, "edicao");


        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Cadastra dados no banco
            $this->modelSeo->update($dataPost, $id);
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }



    /**
     * Remove registro do banco de dados
     */
    public function remover($id)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("excluir")) {
            Common::redir('admin');
        }

        $retornoUsuario = NULL;

        //Recebendo dados do usuário
        $dados = $this->modelSeo->getByid($id);


        //Se remover linha com sucesso
        if ($this->modelSeo->delete($id)) {

            //grava log
            $this->modelLog->gravarLog("Excluído registro SEO : " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído registro SEO : " . $dados["id"], "", "all");

            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }

        echo json_encode($retornoUsuario);
    }


    public function lerDocumentoModal($id)
    {

        //Lendo diretorio que o documento ta no banco
        $dadosBanco = $this->modelSeo->getByid($id);

        //Lendo diretório da galeria de imagens
        $nomeDiretorioGaleria = (is_null($dadosBanco['dir_galeria']) || empty($dadosBanco['dir_galeria'])) ? "-" : $dadosBanco['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/seo";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $arrGaleria = $objDiretorio->lerDiretorio(array("thumb550_", "thumb770_", "thumb1200_"));
        if (count($arrGaleria) >= 1) {
            $img = "";
            $caminhoImagem = STATIC_URL . "/img/seo/{$dadosBanco['dir_galeria']}";
            foreach ($arrGaleria as $valor) {
                $img .= "<a href='{$caminhoImagem}/thumb1200_{$valor}' data-fancybox='galeria' class='fancybox'>";
                $img .= "<img src='{$caminhoImagem}/thumb550_{$valor}' class='imagem-modal'>";
                $img .= "</a>";
            }
            $arrGaleria = $img;
        } else {
            $arrGaleria = "";
        }
        
        //Montando documento para ser exibido
        $documento = "<strong>Página: </strong> <a href='{$dadosBanco['url']}' target='_blank'>{$dadosBanco['url']}</a><br><br>";
        $documento .= "<strong>Título: </strong> {$dadosBanco['titulo']}<br>";
        $documento .= "<strong>Descrição: </strong> {$dadosBanco['descricao']}";

        $arrRetorno = array(
            "titulo"    => "Informações de SEO da página",
            "documento" => $documento,
            "editar"    => SITE_URL . "/seo-admin/editar/$id",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }    

}
