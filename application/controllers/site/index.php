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

        
        //Dados de configuração
        $config = $this->objModelConfig->getByid(1);

        //Carregando view index
        $dados["nomeControlador"] = "index"; //servicos ou produtos {enviar uma das duas strings}
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
    
    /**
     * Retorna vazio, ou o int da primeira categoria
     * @return string
     */
    public function verificaIdCategoria(){
        
        $retorno = "";
        
        //Verificando se tem produtos sem categoria
        $this->modelHome->setTabela("produtos");
        $produtoNull = $this->modelHome->getAll(array("where" => "ISNULL(categoria_id)", "orderBy" => "id DESC"));
        
        //Se for VAZIO, ele busca o id da primeira categoria
        if(empty($produtoNull)){
            //Recebendo ID primeira categoria
            $this->modelHome->setTabela("produtos_categoria");
            $categoriaId = $this->modelHome->idPrimeiraCategoria();
            $retorno = "/".$categoriaId["id"];
        }
        
        return $retorno;
        
    }
	
    
    public function single($slug, $id){
        //Passar variáveis para a view
        
        $this->modelHome->setTabela("empresa");
        $dados["arrEmpresa"] = $this->modelHome->getByid(1);
        
        $this->modelHome->setTabela("info_estatico");
        $dados["arrInfoEstatico"] = $this->modelHome->getByid(1);
        
        $this->modelHome->setTabela("info_estatico");
        $dados["conheca"] = $this->modelHome->getByid(6);
        
        $this->modelHome->setTabela("info_estatico");
        $dados["informacoesreforco"] = $this->modelHome->getByid(7);
        
        $this->modelHome->setTabela("valores");
        $dados["valores"] = $this->modelHome->getAll(['orderBy' => 'id desc']);
        
        $this->modelHome->setTabela("config");
        $dados["config"] = $this-> modelHome->getByid(1);
        
        $this->modelHome->setTabela("informacoes_landing_page");
        $dados["informacoesLandingPage"] = $this->modelHome->getAll(['orderBy' => 'id']);
        
        $this->modelHome->setTabela("produtos");
        $dados["single"] = $this->modelHome->getByid($id);
        
        //Criando Galeria
        $nomeDiretorioGaleria = $dados["single"]["dir_galeria"];
        $pathDiretorioGaleria = STATIC_PATH."/img/admin/img/produtos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);          
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb120_","thumb25_","thumb400_","thumb800_"));
        
        
        if(!empty($dados['arrInfoEstatico']['url_redirecionamento'])){
            $dados['urlBotao'] = $dados['arrInfoEstatico']['url_redirecionamento'];
        }else{
            $telefone = "55".str_replace(['(', ')', ' ', '-'], '', $dados['arrInfoEstatico']['whatsapp']);
            $dados['urlBotao'] = "https://api.whatsapp.com/send?phone={$telefone}&amp;text={$dados['arrInfoEstatico']['texto_whatsapp']}";
        }
        
        
        //chama a view
        var_dump("dsadas");
        exit;
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
        
        
        //var_dump($arrRetorno);
        //exit;
        
        echo json_encode($arrRetorno);

    }    
    
    
}
