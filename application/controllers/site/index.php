<?php

//Incluindo bibliotecas extras
include VENDOR_PATH."/imagem.php";
include VENDOR_PATH."/diretorio.php";

/**
 * Description of index
 *
 * @author Joao Provezi
 */
class Index extends Controller{
    
    private $objLeads;
    private $modelHome;


    public function __construct() {
        parent::__construct();
    }
    
    //Essa classe é chamada por primeiro no controller
    public function main(){
        
        //Configurações
        $config = $this->objModelConfig->getByid(1);

        //SEO
        $dados["seo"] = $this->objModelSeo->getByid(1);

        //Carregando view
        $this->loadview("templates/{$config['template']}/index", $dados);
        
    }
    
    /**
     * Cria view de listagem
     */
    public function carregaProdutos($categoria = NULL){
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        
        if(is_null($categoria)){
            $this->modelHome->setTabela("produtos");
            echo json_encode($this->modelHome->getAll(array("where" => "ISNULL(categoria_id)", "orderBy" => "ordem, titulo ASC")));
            
        }else{
            $this->modelHome->setTabela("produtos");
            $this->modelHome->getAllProdutosCategoria(array("where" => "categoria_id = $categoria", "orderBy" => "p.ordem, p.titulo ASC"));
            echo json_encode($this->modelHome->getAllProdutosCategoria(array("where" => "categoria_id = $categoria", "orderBy" => "ordem ASC")));
        }
        
       
    }
    

    public function single($slug, $id){
        //Passar variáveis para a view
        
        $this->modelHome->setTabela("empresa");
        $dados["arrEmpresa"] = $this->modelHome->getByid(1);
        
        //Criando Galeria
        $nomeDiretorioGaleria = $dados["single"]["dir_galeria"];
        $pathDiretorioGaleria = STATIC_PATH."/img/admin/img/produtos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);          
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb120_","thumb25_","thumb400_","thumb800_"));
        
        //chama a view
        $this->loadview('template/01/index', $dados);
    }
    
    /**
     * Cria view de cadastro
     */
    public function cadastrarLead(){
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");        

        //Recebendo dados do form
        $dataPost = array(
            "nome"        => $_POST['nome'],
            "whatsapp"    => $_POST['whatsapp'],
            "mensagem"    => $_POST['mensagem'],
        );


        $arrRetorno = $this->objLeads->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){

            //Cadastra dados no banco
            $this->objLeads->cadastrar($dataPost);
            
        }
        echo json_encode($arrRetorno);

    }    
    
    
}
