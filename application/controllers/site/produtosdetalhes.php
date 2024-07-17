<?php

class ProdutosDetalhes extends Controller
{

    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelProdutos;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;
    private $modelSlug;


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
        $this->loadModel('slug');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelProdutos = new ProdutosModel();
        $this->modelPaginaExtra = new PaginaExtraModel();
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();
        $this->modelSlug = new Slug();

        //Verifica se o site está em manutenção
        if($this->modelConfig->siteEmManutenção()){
            Common::redir('site-em-manutencao');
        }        
    }

    public function main()
    {
        $this->detalhes();
    }

    public function detalhes()
    {

        //Procura primeiro o id no slug
        $slug = $this->modelSlug->getBySlug(Common::getControlador());

        //Insere o id
        $id = $slug["id_slug"];

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
        $dados["menuContato"] = $this->modelMenu->getByid(6);

        //Validador
        if (!$dados["produto"]) {
            Common::redir();
        }

        //Buscando Galeria
        $nomeDiretorioGaleria = $dados['produto']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";
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
            $dados["produto"] = $this->modelProdutos->getByid($id);
            $dadosSeo["titulo"] = $dados["produto"]["titulo"] . " - " . $config["nome_fantasia"];
            $dadosSeo["descricao"] = Common::limpaCaracteresEstranhos(Common::reduzirTexto($dados["produto"]["texto"], 160));

        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
