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
class Duvidas extends Controller {

    
    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
    private $modelDuvidas;
    private $modelPaginaExtra;
    private $modelSeo;
    private $modelMenu;


    public function __construct() {
        parent::__construct();

        //Carrega os modelos
        $this->loadModel('configuracao');
        $this->loadModel('layoutsite');
        $this->loadModel('pensador');    
        $this->loadModel('duvida'); 
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao(); 
        $this->modelPensador = new Pensador();  
        $this->modelDuvidas = new Duvida();  
        $this->modelPaginaExtra = new PaginaExtraModel(); 
        $this->modelSeo = new SeoModel();
        $this->modelMenu = new SiteMenu();
        
        //Verifica se o site está em manutenção
        if($this->modelConfig->siteEmManutenção()){
            Common::redir('site-em-manutencao');
        }

    }
    
    public function main(){

        //Busca dados da página
        $dados["config"] = $this->modelConfig->getByid(1);
        $dados["layout"] = $this->modelLayout->getByid(1);
        $dados["fraseMotivacional"] = $this->modelPensador->getFraseMotivacional();
        $dados["paginasExtras"] = $this->modelPaginaExtra->getAll(array("orderBy"=>"id DESC","where"=>"ativo = 'S'"));
        $dados["seo"] = $this->seo();
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));
        $menuPagina = $this->modelMenu->getByid(9);
        $dados["menuPagina"] = (empty($menuPagina["pseudo_titulo"])) ? $menuPagina["titulo"] : $menuPagina["pseudo_titulo"];        

        //Carregando dúvidas
        $dados["duvidas"] = $this->modelDuvidas->getAll(array("orderBy"=>"titulo ASC"));

        //Buscando galeria de cada item
        foreach($dados["duvidas"] as $indice => $valor){
            //Buscando Galeria
            $nomeDiretorioGaleria = $valor['dir_galeria'];
            $pathDiretorioGaleria = STATIC_PATH."/img/duvidas";
            $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
            $dados["duvidas"][$indice]["galeria"] = $objDiretorio->lerDiretorio(array("thumb300_","thumb1200_"));            
        }        

        $this->loadview("templates/{$dados['layout']['template']}/duvidas",$dados);
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

            $dadosSeo["titulo"] = "Dúvidas respondidas pela empresa {$config['nome_fantasia']}";
            $dadosSeo["descricao"] = "Nessa página temos várias perguntas e respostas prontas para tirar todas as suas dúvidas.";
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }    

}
