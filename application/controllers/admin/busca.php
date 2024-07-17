<?php

class Busca extends Controller{

    private $modelNotificacao;   
    private $modelUsuarios;
    private $modelLeads;
    private $modelBlog;
    private $modelMenu;
    private $modelBanner;
    private $modelDuvidas;
    private $modelEquipe;
    private $modelInstitucional;
    private $modelPaginasExtras;
    private $modelPqNosEscolher;
    private $modelProdutos;
    private $modelServicos;
    private $modelProjetos;
    private $modelSeo;
    private $modelPensador;
        
    public function __construct() {
        
        //Inicia o construtor do pai da classe
        parent::__construct();
        
        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();//Destroi a sessão do usuário
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('notificacoes');
        $this->loadModel('usuario');
        $this->loadModel('lead');
        $this->loadModel('blogmodel');
        $this->loadModel('menu');
        $this->loadModel('banner');
        $this->loadModel('duvida');
        $this->loadModel('equipemodel');
        $this->loadModel('institucionalmodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('pqnosescolher');
        $this->loadModel('produtosmodel');
        $this->loadModel('servicosmodel');
        $this->loadModel('projetosmodel');
        $this->loadModel('seomodel');
        $this->loadModel('pensador');

        //Cria as classes de modelo
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuarios = new Usuario();
        $this->modelLeads = new Lead();
        $this->modelBlog = new BlogModel();
        $this->modelMenu = new Menu();
        $this->modelBanner = new Banner();
        $this->modelDuvidas = new Duvida();
        $this->modelEquipe = new EquipeModel();
        $this->modelInstitucional = new InstitucionalModel();
        $this->modelPaginasExtras = new PaginaExtraModel();
        $this->modelPqNosEscolher = new PqNosEscolher();
        $this->modelProdutos = new ProdutosModel();
        $this->modelServicos = new ServicosModel();
        $this->modelProjetos = new ProjetosModel();
        $this->modelSeo = new SeoModel();
        $this->modelPensador = new Pensador();
    }

    public function main() {

        //Recebe busca do usuário aplicando a inteligencia de melhora
        $busca = $this->melhoraInteligenteBusca($_POST["busca"]);

        //Dados a serem enviados a view
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();        
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);


        //Verificando se usuário digitou pelo menos 3 caracteres
        if(strlen($busca) < 3){
            $dados["buscaMenu"] = array();
            $dados["totalResultado"] = 0;
        }else{
            //Encontrando buscas no sistema
            $dados["buscaMenu"] = $this->modelMenu->getLike($busca);
            $dados["buscaUsuarios"] = $this->modelUsuarios->getLike($busca);
            $dados["buscaBlog"] = $this->modelBlog->getLike($busca);
            $dados["buscaLeads"] = $this->modelLeads->getLike($busca);
            $dados["buscaBanner"] = $this->modelBanner->getLike($busca);
            $dados["buscaDuvidas"] = $this->modelDuvidas->getLike($busca);
            $dados["buscaEquipe"] = $this->modelEquipe->getLike($busca);
            $dados["buscaInstitucional"] = $this->modelInstitucional->getLike($busca);
            $dados["buscaPaginaExtra"] = $this->modelPaginasExtras->getLike($busca);
            $dados["buscaPqNosEscolher"] = $this->modelPqNosEscolher->getLike($busca);
            $dados["buscaProdutos"] = $this->modelProdutos->getLike($busca);
            $dados["buscaServicos"] = $this->modelServicos->getLike($busca);
            $dados["buscaProjetos"] = $this->modelProjetos->getLike($busca);
            $dados["buscaSeo"] = $this->modelSeo->getLike($busca);
            $dados["buscaPensador"] = $this->modelPensador->getLike($busca);

            //Somando total de buscas
            $dados["totalResultado"] = 
            count($dados["buscaMenu"]) + 
            count($dados["buscaUsuarios"]) + 
            count($dados["buscaBlog"]) + 
            count($dados["buscaBanner"]) +
            count($dados["buscaDuvidas"]) +
            count($dados["buscaEquipe"]) +
            count($dados["buscaInstitucional"]) +
            count($dados["buscaPaginaExtra"]) +
            count($dados["buscaPqNosEscolher"]) +
            count($dados["buscaProdutos"]) +
            count($dados["buscaServicos"]) +
            count($dados["buscaProjetos"]) +
            count($dados["buscaSeo"]) +
            count($dados["buscaPensador"]) +
            count($dados["buscaLeads"]);
        }


        //Titulo da página
        $dados["titulo"] = "Você buscou por <span class='badge badge-pill badge-secondary destaque-busca'>".$_POST["busca"]."</span>, 
        sua busca retornou <span class='badge badge-pill badge-secondary destaque-busca'>".$dados['totalResultado']."</span> registros";

        //Carrega a view
        $this->loadView("admin/busca/index",$dados);
    }

    public function frase(){

        //Dados a serem enviados a view
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();        
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        //Titulo da página
        $dados["titulo"] = "Essa frase é gerada pelo <span class='badge badge-pill badge-secondary destaque-busca'>Guru do sistema</span> para animar seu dia, reflita!";

        //Sorteando uma frase
        $dados["buscaPensador"] = $this->modelPensador->getFraseMotivacional();

        //Carrega a view
        $this->loadView("admin/busca/frase",$dados);
    }

    /**
     * Método inteligente de melhora de busca do usuário
     *
     * @param [string] $busca
     * @return string
     */
    private function melhoraInteligenteBusca($busca){

        //Removendo espaços vazios inicio e fim da busca
        $busca = ltrim($busca);
        $busca = rtrim($busca);

        //Se for um CPF ela adiciona os pontos e - automatico
        if( strlen($busca) == 11 && is_numeric($busca) ){
            $busca = Common::formataCpfCnpj($busca);
        }

        return $busca;
    }


    
    
}
