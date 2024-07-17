<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author Joao Provezi
 */
class Clientes extends Controller
{


    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelClientes;
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
        $this->loadModel('clientemodel');
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
        $this->modelClientes = new ClienteModel();
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
        $clientes = $this->modelClientes->getByid(1);
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(5);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];                 
        $menuContato = $this->modelMenu->getByid(6);
        $dados["menuContato"] = (empty($menuContato["pseudo_titulo"])) ? $menuContato["titulo"] : $menuContato["pseudo_titulo"];        

        //Criando Galeria
        $nomeDiretorioGaleria = (is_null($clientes['dir_galeria']) || empty($clientes['dir_galeria'])) ? "-" : $clientes['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/clientes";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["dadosBanco"] = $clientes;
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb360_", "thumb1000_"));

        //Redireciona site se não houver clientes cadastrados
        if (count($dados["galeria"]) <= 0) {
            Common::redir();
        }

        $this->loadview("templates/{$dados['layout']['template']}/clientes", $dados);
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

            $dadosSeo["titulo"] = "Conheça os clientes da {$config['nome_fantasia']}";
            $dadosSeo["descricao"] = "Veja os principais clientes da nossa empresa, que orgulhosamente apresentamos a você.";
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
