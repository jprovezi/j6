<?php

class siteEmManutencao extends Controller
{


    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelSeo;
    private $modelMenu;


    public function __construct()
    {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();
    }

    public function main()
    {

        //Busca dados da página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));

        $this->loadview("templates/{$dados['layout']['template']}/site-em-construcao", $dados);
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

            $dadosSeo["titulo"] = "Site Em Manutenção - {$config['nome_fantasia']}";
            $dadosSeo["descricao"] = $config["frase_site_construcao"];
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
