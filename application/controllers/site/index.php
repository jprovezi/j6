<?php


/**
 * Description of index
 *
 * @author Joao Provezi
 */
class Index extends Controller
{


    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelBanner;
    private $modelPorqueNosEscolher;
    private $modelInstitucional;
    private $modelDuvidas;
    private $modelBlog;
    private $modelPaginaExtra;
    private $modelProjetos;
    private $modelServicos;
    private $modelProdutos;
    private $modelSeo;
    private $modelMenu;


    public function __construct()
    {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');
        $this->loadModel('banner');
        $this->loadModel('pqnosescolher');
        $this->loadModel('institucionalmodel');
        $this->loadModel('duvida');
        $this->loadModel('blogmodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('projetosmodel');
        $this->loadModel('servicosmodel');
        $this->loadModel('produtosmodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelBanner = new Banner();
        $this->modelPorqueNosEscolher = new PqNosEscolher();
        $this->modelInstitucional = new InstitucionalModel();
        $this->modelDuvidas = new Duvida();
        $this->modelBlog = new BlogModel();
        $this->modelPaginaExtra = new PaginaExtraModel();
        $this->modelProjetos = new ProjetosModel();
        $this->modelServicos = new ServicosModel();
        $this->modelProdutos = new ProdutosModel();
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
        $dados["banners"] = $this->modelBanner->getAll(array("where" => "ativo = 'S'", "orderBy" => "ordem ASC"));
        $dados["porquenosescolher"] = $this->modelPorqueNosEscolher->getAll();
        $dados["institucional"] = $this->modelInstitucional->getByid(1);
        $dados["duvidas"] = $this->modelDuvidas->getAll(array("orderBy" => "rand()", "limit" => "5"));
        $dados["blog"] = $this->modelBlog->getAll(array("orderBy" => "id DESC", "limit" => "5", "where" => "ativo = 'S'"));
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy" => "id DESC", "where" => "ativo = 'S'"));
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPqNosEscolher = $this->modelMenu->getByid(0);
        $dados["menuPqNosEscolher"] = (empty($menuPqNosEscolher["pseudo_titulo"])) ? $menuPqNosEscolher["titulo"] : $menuPqNosEscolher["pseudo_titulo"];
        $menuEmpresa = $this->modelMenu->getByid(1);
        $dados["menuEmpresa"] = (empty($menuEmpresa["pseudo_titulo"])) ? $menuEmpresa["titulo"] : $menuEmpresa["pseudo_titulo"];
        $menuDuvidas = $this->modelMenu->getByid(9);
        $dados["menuDuvidas"] = (empty($menuDuvidas["pseudo_titulo"])) ? $menuDuvidas["titulo"] : $menuDuvidas["pseudo_titulo"];        
        $menuBlog = $this->modelMenu->getByid(8);
        $dados["menuBlog"] = (empty($menuBlog["pseudo_titulo"])) ? $menuBlog["titulo"] : $menuBlog["pseudo_titulo"];        
        $menuProjetos = $this->modelMenu->getByid(4);
        $menuProjetos = (empty($menuProjetos["pseudo_titulo"])) ? $menuProjetos["titulo"] : $menuProjetos["pseudo_titulo"];
        $menuServicos = $this->modelMenu->getByid(3);
        $menuServicos = (empty($menuServicos["pseudo_titulo"])) ? $menuServicos["titulo"] : $menuServicos["pseudo_titulo"];
        $menuProdutos = $this->modelMenu->getByid(2);
        $menuProdutos = (empty($menuProdutos["pseudo_titulo"])) ? $menuProdutos["titulo"] : $menuProdutos["pseudo_titulo"];

        //Buscando Destaques da Home
        $projetosDestaques = $this->modelProjetos->getAll(array("where" => "destaque = 'S'", "orderBy" => "id DESC"));
        $servicosDestaques = $this->modelServicos->getAll(array("where" => "destaque = 'S'", "orderBy" => "id DESC"));
        $produtosDestaques = $this->modelProdutos->getAll(array("where" => "destaque = 'S'", "orderBy" => "id DESC"));
        $paginasExtrasDestaques = $this->modelPaginaExtra->getAll(array("where" => "destaque = 'S'", "orderBy" => "id DESC"));

        //incluindo path da galeria no array
        foreach ($projetosDestaques as $i => $array) {
            $array["path"] = "projetos";
            $projetosDestaques[$i] = $array;
        }
        foreach ($servicosDestaques as $i => $array) {
            $array["path"] = "servicos";
            $servicosDestaques[$i] = $array;
        }
        foreach ($produtosDestaques as $i => $array) {
            $array["path"] = "produtos";
            $produtosDestaques[$i] = $array;
        }
        foreach ($paginasExtrasDestaques as $i => $array) {
            $array["path"] = "paginas-extras";
            $paginasExtrasDestaques[$i] = $array;
        }

        $dados["destaques"] = array_merge($projetosDestaques, $servicosDestaques, $produtosDestaques, $paginasExtrasDestaques);

        //Chama a view
        $this->loadview("templates/{$dados['layout']['template']}/index", $dados);
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
            $institucional = $this->modelInstitucional->getByid(1);

            $dadosSeo["titulo"] = "{$config['nome_fantasia']} - {$config['slogan']}";
            $dadosSeo["descricao"] = Common::reduzirTexto($institucional['texto'], 160);
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
