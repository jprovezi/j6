<?php

class ClientesAdmin extends Controller {

    private $modelPerfil;
    private $modelUsuario;
    private $modelClientes;

    public function __construct() {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('perfil');
        $this->loadModel('usuario');
        $this->loadModel('clientemodel');

        //Cria as classes de modelo
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelClientes = new ClienteModel();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();        

    }


    public function main() {

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }

        //Carregar edição config
        $this->clientes();
    }    


    /**
     * Cria view de cadastro
     */
    public function clientes(){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }
        
        //Carregando dados da view
        $clientes = $this->modelClientes->getByid(1);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Logo dos Clientes",
                "url" => SITE_URL."/clientes-admin",  
            ),
            array(
                "nome" => "Listagem das logos",
                "url" => "",  
            ),
        );
        

        //Criando Galeria
        $nomeDiretorioGaleria = ( is_null($clientes['dir_galeria']) || empty($clientes['dir_galeria']) ) ? "-" : $clientes['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH."/img/clientes";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["dadosBanco"] = $clientes;
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb360_","thumb1000_"));

        $dados["urlAction"] = SITE_URL."/clientes-admin/clientes-exe/".$clientes["id"];
        
        //Carrega visão
        $this->loadView("admin/clientes/update", $dados);
        
    }


    /**
     * Executa a edição do controller
     */
    public function clientesExe($id){

        //Recebendo dados do banco
        $clientes = $this->modelClientes->getByid($id);

        //Retorno Page
        $arrRetorno = array(
            "tipo" => "sucesso",
            "mensagem" => "Edição Realizada com sucesso!",
            "acaoForm" => "reload",
        ); 

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){

            //Gravando imagens no servidor se tiver
            if(!empty($_FILES)){

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($clientes["dir_galeria"])) ? $clientes["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH."/img/clientes";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                //Salvando diretorio no banco
                $dataPost = array("dir_galeria"=>$nomeDiretorioGaleria);
                $this->modelClientes->update($dataPost,1);

                for($i=0; $i<count($_FILES["imagens"]["name"]); $i++){

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal()."/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(360, $objImagem->getDirSaveImage().$nomeUnico);
                    $objImagem->criarThumb(1000, $objImagem->getDirSaveImage().$nomeUnico);

                }
            }
                                    
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }       

    
    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem){
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH."/img/clientes";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb360_".$nomeImagem);
        $objDiretorio->removerImagemDir("thumb1000_".$nomeImagem);
    }
    
    /**
     * Exclui todas as imagens da pasta galeria
     */
    public function excluirTodasFotos($nomeDiretorioGaleria){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }        
        
        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH."/img/clientes";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);

        
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());
        
        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }
    
    
}

