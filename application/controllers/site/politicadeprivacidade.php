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
class PoliticaDePrivacidade extends Controller
{


    private $modelLayout;
    private $modelConfig;
    private $modelPensador;
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
        $this->loadModel('paginaextramodel');
        $this->loadModel('seomodel');
        $this->loadModel('sitemenu');
        $this->loadModel('slug');

        //Cria as classes de modelo
        $this->modelLayout = new LayoutSite();
        $this->modelConfig = new Configuracao();
        $this->modelPensador = new Pensador();
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
        $dados["paginaExtra"] = $this->modelPaginaExtra->getByid($id);
        $dados["seo"] = $this->seo($id);
        $dados["menuTopo"] = $this->modelMenu->getAll(array("where"=>"menu_topo = 'S'", "orderBy"=>"ordem ASC"));
        $dados["menuFooter"] = $this->modelMenu->getAll(array("where"=>"menu_footer = 'S'", "orderBy"=>"ordem ASC"));


        //Validador
        if (!$dados["paginaExtra"]) {
            Common::redir();
        }

        //Buscando Galeria
        $nomeDiretorioGaleria = $dados['paginaExtra']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_", "thumb1200_"));

        //Lendo documento da página
        $dados["documento"] = $this->lerDocumento($id);

        $this->loadview("templates/{$dados['layout']['template']}/pagina-extra", $dados);
    }

    /**
     * Lê um documento em arquivo base64 e retorna uma string
     *
     * @param [int] $id
     * @return string
     */
    public function lerDocumento($id)
    {

        //Lendo diretorio que o documento ta no banco
        $dados["dadosBanco"] = $this->modelPaginaExtra->getByid($id);

        //Abrindo documento salvo no servidor
        $nomeDiretorioDocumento = $dados["dadosBanco"]["dir_documento"];
        $pathDiretorioDocumento = DOCUMENTOS_PATH . "/paginas-extras";
        $caminhoDocumento = $pathDiretorioDocumento . "/" . $nomeDiretorioDocumento;

        //Abre o arquivo e coloca no modo leitura
        $arquivo = $caminhoDocumento . '/documento.bin';
        $handle  = fopen($arquivo, 'r');
        $ler = fread($handle, filesize($arquivo));
        $documento = base64_decode($ler);
        fclose($handle);

        //Retorna documento
        return $documento;
    }

    private function seo($id)
    {

        //Buscando SEO no banco de dados
        $dadosSeo = $this->modelSeo->getByString(Common::getURL());

        //Ele verifica duas vezes se não achar entrega o defautl
        if ($dadosSeo == FALSE) {
            $dadosSeo = $this->modelSeo->getByString(Common::getURL() . "/");
        }

        if ($dadosSeo == FALSE) {
            //Recebe dados
            $dados["paginaExtra"] = $this->modelPaginaExtra->getByid($id);  
            $config = $this->modelConfig->getByid(1);

            $dadosSeo["titulo"] = $dados["paginaExtra"]["titulo"]." - ".$config["nome_fantasia"];
            $dadosSeo["descricao"] = Common::limpaCaracteresEstranhos(Common::reduzirTexto($dados["paginaExtra"]["texto"],160));
        }

        $arrSeo = array(
            "titulo" => $dadosSeo["titulo"],
            "descricao" => $dadosSeo["descricao"],
        );

        return $arrSeo;
    }
}
