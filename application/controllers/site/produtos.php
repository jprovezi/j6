<?php

class Produtos extends Controller
{

    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelProdutos;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;


    public function __construct()
    {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');
        $this->loadModel('produtosmodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelProdutos = new ProdutosModel();
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
        $this->lista();
    }

    public function lista($page = 1, $busca = "")
    {

        //Dados para montar a página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy" => "id DESC", "where" => "ativo = 'S'"));
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(2);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];           
        
        //Configurações e filtro da página
        $dados["urlAction"] = SITE_URL . "/".Common::slug($dados["menuPagina"])."/lista/1";
        $dados["busca"] = $busca;
        $busca = Common::getUrltoString($busca);
        $limit = 12;
        
        //Filtrando categoria de busca
        if ($busca == "") {
            $filtroBusca = "(categoria_id <> 0 OR ISNULL(categoria_id)) AND ativo = 'S'";
        } else {
            $filtroBusca = "(categoria_id = $busca) AND ativo = 'S'";
        }
        
        //Montando Botões de navegação página
        $dados["totalRows"] = $this->modelProdutos->getRows(array("where" => $filtroBusca));
        $dados["pageView"] = Common::getPageView($dados["totalRows"], $page, Common::slug($dados["menuPagina"])."/lista", $busca, $limit);
        //Carregando listagem do banco
        $dados["produtos"] = $this->modelProdutos->getAll(array("where" => $filtroBusca, "orderBy" => "id DESC", "limit" => $limit, "offset" => Common::getOffsetPage($page, $limit)));
        $dados["categorias"] = $this->modelProdutos->getAllCategoriaAtivas();
        
        //Validador
        if (!$dados["produtos"]) {
            Common::redir();
        }
        
        //Chamando a View
        $this->loadview("templates/{$dados['layout']['template']}/produtos", $dados);
    }

    public function detalhes($id = 0)
    {

        //Nome Controlador
        $nomeControlador = Common::getControlador();

        //Busca dados da página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy" => "id DESC", "where" => "ativo = 'S'"));
        $dados["produto"] = $this->modelProdutos->getByid($id);
        $dados["seo"] = $this->seo($id);
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(2);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];

        //Validador
        if (!$dados["produto"]) {
            Common::redir();
        }

        //Buscando Galeria
        $nomeDiretorioGaleria = $dados['produto']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/{$nomeControlador}";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_", "thumb770_", "thumb1200_"));

        //Filtrando categoria de outros produtos
        if (is_null($dados["produto"]["categoria_id"])) {
            $filtroBusca = "(categoria_id <> 0 OR ISNULL(categoria_id)) AND ativo = 'S' AND id <> $id";
        } else {
            $filtroBusca = "(categoria_id = {$dados['produto']['categoria_id']}) AND ativo = 'S' AND id <> $id";
        }

        //Buscando outros produtos
        $dados["outrosprodutos"] = $this->modelProdutos->getAll(array("where" => $filtroBusca, "orderBy" => "rand()", "limit" => "10"));

        $this->loadView("templates/{$dados['layout']['template']}/produtos-detalhes", $dados);
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
                $dados["produto"] = $this->modelProdutos->getByid($id);
                $dadosSeo["titulo"] = $dados["produto"]["titulo"] . " - " . $config["nome_fantasia"];
                $dadosSeo["descricao"] = Common::limpaCaracteresEstranhos(Common::reduzirTexto($dados["produto"]["texto"], 160));
            }else{
                $dadosSeo["titulo"] = "Conheça os produtos da {$config['nome_fantasia']}";
                $dadosSeo["descricao"] = "Produtos de extrema qualidade, preço competitivo e compromisso no que entrega.";                
            }
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
