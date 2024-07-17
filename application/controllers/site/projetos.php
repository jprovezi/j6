<?php

class Projetos extends Controller {

    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelProjetos;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;


    public function __construct() {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');    
        $this->loadModel('projetosmodel'); 
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao(); 
        $this->modelPensador = new Pensador();  
        $this->modelProjetos = new ProjetosModel();
        $this->modelPaginaExtra = new PaginaExtraModel(); 
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();
        
        //Verifica se o site está em manutenção
        if($this->modelConfig->siteEmManutenção()){
            Common::redir('site-em-manutencao');
        }        
    }
    
    public function main(){
        $this->lista();
    }

    public function lista($page = 1, $busca = ""){

        //Dados para montar a página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy"=>"id DESC","where"=>"ativo = 'S'"));
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(4);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];                 

        //Configurações e filtro da página
        $dados["urlAction"] = SITE_URL."/".Common::slug($dados["menuPagina"])."/lista/1";
        $dados["busca"] = $busca;
        $busca = Common::getUrltoString($busca);        
        $limit = 12;

        //Filtrando categoria de busca
        if($busca == ""){
            $filtroBusca = "(categoria_id <> 0 OR ISNULL(categoria_id)) AND ativo = 'S'";
        }else{
            $filtroBusca = "(categoria_id = $busca) AND ativo = 'S'";
        }

        //Montando Botões de navegação página
        $dados["totalRows"] = $this->modelProjetos->getRows(array("where" => $filtroBusca));
        $dados["pageView"] = Common::getPageView($dados["totalRows"], $page, Common::slug($dados["menuPagina"])."/lista", $busca, $limit);
        
        //Carregando listagem do banco
        $dados["projetos"] = $this->modelProjetos->getAll(array("where" => $filtroBusca, "orderBy" => "id DESC", "limit" => $limit, "offset" => Common::getOffsetPage($page,$limit)));
        $dados["categorias"] = $this->modelProjetos->getAllCategoriaAtivas();

        //Validador
        if(!$dados["projetos"]){
            Common::redir();
        }

        //Chamando a View
        $this->loadview("templates/{$dados['layout']['template']}/projetos",$dados);
    }

    public function detalhes($slug = "", $id = 0){

        //Busca dados da página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();      
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy"=>"id DESC","where"=>"ativo = 'S'"));  
        $dados["projeto"] = $this->modelProjetos->getByid($id);
        $dados["seo"] = $this->seo($id);
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(4);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];                         

        //Validador
        if(!$dados["projeto"]){
            Common::redir();
        }

        //Buscando Galeria
        $nomeDiretorioGaleria = $dados['projeto']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH."/img/projetos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_","thumb770_","thumb1200_"));           

        //Filtrando categoria de outros projetos
        if( is_null($dados["projeto"]["categoria_id"])){
            $filtroBusca = "(categoria_id <> 0 OR ISNULL(categoria_id)) AND ativo = 'S' AND id <> $id";
        }else{
            $filtroBusca = "(categoria_id = {$dados['projeto']['categoria_id']}) AND ativo = 'S' AND id <> $id";
        }        

        //Buscando outros projetos
        $dados["outrosProjetos"] = $this->modelProjetos->getAll(array("where" => $filtroBusca, "orderBy"=>"rand()", "limit"=>"10"));

        $this->loadView("templates/{$dados['layout']['template']}/projetos-detalhes",$dados);
    }
    

    private function seo($id = "")
    {

        //Buscando SEO no banco de dados
        $dadosSeo = $this->modelSeo->getByString(Common::getURL());

        //Ele verifica duas vezes se não achar entrega o defautl
        if ($dadosSeo == FALSE) {
            $dadosSeo = $this->modelSeo->getByString(Common::getURL() . "/");
        }

        if ($dadosSeo == FALSE) {

            $config = $this->modelConfig->getByid(1);

            if($id != ""){
                $dados["projetos"] = $this->modelProjetos->getByid($id);
                $dadosSeo["titulo"] = $dados["projetos"]["titulo"] . " - " . $config["nome_fantasia"];
                $dadosSeo["descricao"] = Common::limpaCaracteresEstranhos(Common::reduzirTexto($dados["projetos"]["texto"], 160));
            }else{
                $dadosSeo["titulo"] = "Conheça os projetos da {$config['nome_fantasia']}";
                $dadosSeo["descricao"] = "Nosso portfólio é enorme, com muitos projetos realizados e entregues aos nossos clientes.";
            }
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }    
  
    
}
