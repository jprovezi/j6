<?php


class Contato extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelLayout;
    private $modelLeads;
    private $modelConfig;
    private $modelPensador;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;

    public function __construct()
    {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('configuracao');
        $this->loadModel('lead');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelConfig = new Configuracao();
        $this->modelLeads = new Lead();
        $this->modelPensador = new Pensador();
        $this->modelPaginaExtra = new PaginaExtraModel();
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();

        //Verifica se o site está em manutenção
        if($this->modelConfig->siteEmManutenção()){
            Common::redir('site-em-manutencao');
        }        
    }

    public function main()
    {
        //Busca dados da página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy" => "id DESC", "where" => "ativo = 'S'"));
        $dados["urlAction"] = SITE_URL . "/contato/enviar-mensagem/";
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(6);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];        

        $this->loadview("templates/{$dados['layout']['template']}/contato", $dados);
    }

    public function enviarMensagem()
    {

        //Recebendo dados do config
        $config = $this->modelConfig->getByid(1);

        if (Common::validarEmBranco($_POST["nome"])) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome</strong> não pode estar em branco",
            );
        } else if (Common::validarMinimo($_POST["nome"], 5)) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Nome</strong> deve ter pelo menos 5 caracteres",
            );
        } else if (Common::validarEmBranco($_POST["telefone"])) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Telefone</strong> não pode estar em branco",
            );
        } else if (!Common::validarEmail($_POST["email"])) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Email</strong> Não é válido",
            );
        } else if (Common::validarEmBranco($_POST["assunto"])) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Assunto</strong> Não pode estar em branco",
            );
        } else if (Common::validarEmBranco($_POST["mensagem"])) {
            $arrRetorno = array(
                "tipo" => "error",
                "mensagem" => "<strong>Mensagem</strong> Não pode estar em branco",
            );
        } else {

            //Grava lead no banco
            $dataPost = array(
                "nome" => $_POST["nome"],
                "email" => $_POST["email"],
                "telefone" => $_POST["telefone"],
                "assunto" => $_POST["assunto"],
                "mensagem" => $_POST["mensagem"],
                "data" => Common::getTimeStamp(),
            );
            $this->modelLeads->save($dataPost);

            //Envia o email
            $corpoEmail = "Mensagem enviada pelo site {$config['nome_fantasia']}<br><br>
            <strong>Nome: </strong>{$_POST['nome']}<br>
            <strong>Telefone: </strong>{$_POST['telefone']}<br>
            <strong>Email: </strong>{$_POST['email']}<br>
            <strong>Assunto: </strong>{$_POST['assunto']}<br>
            <strong>Mensagem: </strong>{$_POST['mensagem']}";
            Common::enviarEmail($config['email'], $config["nome_fantasia"], array(), $_POST["assunto"], $corpoEmail);

            //grava log
            $this->modelLog->gravarLog("Cadastrado novo contato pelo site " . $_POST['assunto']);

            //Url editar Blog
            $url = SITE_URL . "/leads";

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Cadastrado novo contato pelo site " . $_POST["assunto"], $url, "all");


            //mensagem de retorno
            $arrRetorno = array(
                "tipo" => "sucesso",
                "mensagem" => "Enviado com sucesso",
            );
        }

        //Retorna msg para o usuário
        echo json_encode($arrRetorno);
    }


    private function seo()
    {

        //Buscando SEO no banco de dados
        $dadosSeo = $this->modelSeo->getByString(Common::getURL());

        //Ele verifica duas vezes se não achar entrega o defautl
        if ($dadosSeo == FALSE) {
            $dadosSeo = $this->modelSeo->getByString(Common::getURL() . "/");
        }

        if ($dadosSeo == FALSE) {
            //Recebe dados de configuração
            $config = $this->modelConfig->getByid(1);

            $dadosSeo["titulo"] = "Entre em contato com a {$config['nome_fantasia']}";
            $dadosSeo["descricao"] = "Aqui você poderá falar conosco, tirar dúvidas e enviar sugestões.";
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
