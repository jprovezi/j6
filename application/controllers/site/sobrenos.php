<?php


/**
 * Description of index
 *
 * @author Joao Provezi
 */
class SobreNos extends Controller
{

    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelInstitucional;
    private $modelEquipe;
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
        $this->loadModel('institucionalmodel');
        $this->loadModel('equipemodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelInstitucional = new InstitucionalModel();
        $this->modelEquipe = new EquipeModel();
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
        $dados["institucional"] = $this->modelInstitucional->getByid(1);
        $dados["equipe"] = $this->modelEquipe->getAll();
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuEquipe = $this->modelMenu->getByid(7);
        $dados["menuEquipe"] = (empty($menuEquipe["pseudo_titulo"])) ? $menuEquipe["titulo"] : $menuEquipe["pseudo_titulo"];
        $menuPagina = $this->modelMenu->getByid(1);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];
        $menuContato = $this->modelMenu->getByid(6);
        $dados["menuContato"] = (empty($menuContato["pseudo_titulo"])) ? $menuContato["titulo"] : $menuContato["pseudo_titulo"];

        //Recebendo dados da galeria
        $nomeDiretorioGaleria = $dados['institucional']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/institucional";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb585_", "thumb1000_"));
        

        $this->loadview("templates/{$dados['layout']['template']}/empresa", $dados);
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

            $dadosSeo["titulo"] = "Conheça a {$config['nome_fantasia']}";
            $dadosSeo["descricao"] = Common::reduzirTexto($institucional['texto'], 160);
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
