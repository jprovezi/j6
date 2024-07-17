<?php

class CriacaoDeSites extends Controller
{

    private $modelLayout;
    private $modelConfig;
    private $modelServicos;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;
    private $modelSlug;
    private $modelProjetos;


    public function __construct()
    {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('servicosmodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');
        $this->loadModel('slug');
        $this->loadModel('projetosmodel');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelServicos = new ServicosModel();
        $this->modelPaginaExtra = new PaginaExtraModel();
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();
        $this->modelSlug = new Slug();
        $this->modelProjetos = new ProjetosModel();

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
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy" => "id DESC", "where" => "ativo = 'S'"));
        $dados["servico"] = $this->modelServicos->getByid($id);
        $dados["seo"] = $this->seo($id);
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(3);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];                
        $dados["menuContato"] = $this->modelMenu->getByid(6);

        //Validador
        if (!$dados["servico"]) {
            Common::redir();
        }

        //Buscando Galeria
        $nomeDiretorioGaleria = $dados['servico']['dir_galeria'];
        $nomeCapa = $dados["servico"]["capa"];
        $pathDiretorioGaleria = STATIC_PATH . "/img/servicos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_", "thumb770_", "thumb1200_", $nomeCapa));


        //Buscando outros servicos
        $dados["jobs"] = $this->modelProjetos->getAll(array("where" => "categoria_id = 23", "orderBy" => "rand()", "limit" => "10"));
        $dados["tituloJobs"] = "Conheça alguns sites criados";
        $dados["botoesOferecemos"] = [
            [
                "titulo" => $dados["servico"]["bt1"],
                "url" => (empty($dados["servico"]["btlink1"])) ? "javascript:void(0);" : $dados["servico"]["btlink1"],
            ],
            [
                "titulo" => $dados["servico"]["bt2"],
                "url" => (empty($dados["servico"]["btlink2"])) ? "javascript:void(0);" : $dados["servico"]["btlink2"],
            ],
            [
                "titulo" => $dados["servico"]["bt3"],
                "url" => (empty($dados["servico"]["btlink3"])) ? "javascript:void(0);" : $dados["servico"]["btlink3"],
            ],
            [
                "titulo" => $dados["servico"]["bt4"],
                "url" => (empty($dados["servico"]["btlink4"])) ? "javascript:void(0);" : $dados["servico"]["btlink4"],
            ],
            [
                "titulo" => $dados["servico"]["bt5"],
                "url" => (empty($dados["servico"]["btlink5"])) ? "javascript:void(0);" : $dados["servico"]["btlink5"],
            ],
            [
                "titulo" => $dados["servico"]["bt6"],
                "url" => (empty($dados["servico"]["btlink6"])) ? "javascript:void(0);" : $dados["servico"]["btlink6"],
            ],
            [
                "titulo" => $dados["servico"]["bt7"],
                "url" => (empty($dados["servico"]["btlink7"])) ? "javascript:void(0);" : $dados["servico"]["btlink7"],
            ],
            [
                "titulo" => $dados["servico"]["bt8"],
                "url" => (empty($dados["servico"]["btlink8"])) ? "javascript:void(0);" : $dados["servico"]["btlink8"],
            ],
            [
                "titulo" => $dados["servico"]["bt9"],
                "url" => (empty($dados["servico"]["btlink9"])) ? "javascript:void(0);" : $dados["servico"]["btlink9"],
            ],
            [
                "titulo" => $dados["servico"]["bt10"],
                "url" => (empty($dados["servico"]["btlink10"])) ? "javascript:void(0);" : $dados["servico"]["btlink10"],
            ],
        ];

        $this->loadView("templates/{$dados['layout']['template']}/servicos-detalhes", $dados);
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

            if ($id != "") {
                $dados["servicos"] = $this->modelServicos->getByid($id);
                $dadosSeo["titulo"] = $dados["servicos"]["titulo"] . " - " . $config["nome_fantasia"];
                $dadosSeo["descricao"] = Common::limpaCaracteresEstranhos(Common::reduzirTexto($dados["servicos"]["texto"], 160));
            } else {
                $dadosSeo["titulo"] = "Conheça os serviços da {$config['nome_fantasia']}";
                $dadosSeo["descricao"] = "Nosso compromisso é levar qualidade a todos os nossos clientes nos serviços prestados.";
            }
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
