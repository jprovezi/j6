<?php

class Admin extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelConfiguracoes;
    private $modelUsuarios;
    private $modelLeads;
    private $modelBlog;
    private $modelPensador;

    public function __construct()
    {

        //Inicia o construtor do pai da classe
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if (!Session::get("logado")) {
            Session::destroy(); //Destroi a sessão do usuário
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('configuracao');
        $this->loadModel('usuario');
        $this->loadModel('lead');
        $this->loadModel('blogmodel');
        $this->loadModel('pensador');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelConfiguracoes = new Configuracao();
        $this->modelUsuarios = new Usuario();
        $this->modelLeads = new Lead();
        $this->modelBlog = new BlogModel();
        $this->modelPensador = new Pensador();
    }

    public function main()
    {
        $this->dashboard();
    }

    public function logout()
    {
        Session::destroy();
        $this->modelLog->gravarLog("Realizado logout no sistema");
        Common::redir('login');
    }

    public function dashboard()
    {

        //Carregando dados da view
        $dados["infoPagina"] = [
            "titulo" => "Dashboard",
        ];

        //Dados a serem enviados a view
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);
        $dados["configuracoes"] = $this->modelConfiguracoes->getConfigSistema();
        $dados["usuario"] = $this->modelUsuarios->getByid(Session::get("id_usuario"));
        $dados["menuMaisAcessados"] = $this->modelUsuarios->getMenuMaisAcessados();
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();

        //Dados de Leads
        $dados["totalLeads"] = $this->modelLeads->getRows();
        $dados["leads3Meses"] = $this->modelLeads->getTotal3Meses();

        //Dados de Blog
        $dados["totalBlog"] = $this->modelBlog->getRows();
        $dados["blog3Meses"] = $this->modelBlog->getTotal3Meses();

        //Carrega a view
        $this->loadView("admin/dashboard/dashboard", $dados);
    }

    public function login()
    {
        //Redireciona o usuário para a index
        Common::redir('login');
    }

    public function update()
    {
        $sql = "

        ";
    }
}
