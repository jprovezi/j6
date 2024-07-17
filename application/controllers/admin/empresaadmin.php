<?php

class EmpresaAdmin extends Controller {

    private $modelLog;
    private $modelNotificacao;        
    private $modelConfig;
    private $modelPerfil;
    private $modelUsuario;

    public function __construct() {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('configuracao');
        $this->loadModel('perfil');
        $this->loadModel('usuario');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelConfig = new Configuracao();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();        

    }


    public function main() {

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }

        //Carregar edição config
        $this->empresa();
    }    

    private function getPermissionUserMaster(){
        //Apenas usuário programador terá acesso
        if( Session::get("id_usuario") != ID_MASTER_ADMIN ){
            Common::redir("admin");
        }        
    }

    /**
     * Cria view de cadastro
     */
    public function empresa(){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelConfig->getConfigSistema();
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Dados Empresa",
                "url" => SITE_URL."/empresa-admin",  
            ),
            array(
                "nome" => "{$dados["dadosBanco"]["nome_fantasia"]}",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);           
        

        //Criando Galeria
        $nomeDiretorioGaleria = ( is_null($dados['dadosBanco']['dir_galeria']) || empty($dados['dadosBanco']['dir_galeria']) ) ? "-" : $dados['dadosBanco']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH."/img/sistema";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb56_","thumb450_"));

        $dados["urlAction"] = SITE_URL."/empresa-admin/empresa-exe/".$dados["dadosBanco"]["id"];
        
        //Carrega visão
        $this->loadView("admin/configuracoes/updateEmpresa", $dados);
        
    }


    /**
     * Executa a edição do controller
     */
    public function empresaExe($id = 1){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }

        //Recebendo dados do cadastro atual
        $dados = $this->modelConfig->getConfigSistema();

        //Recebendo dados do form
        $dataPost = array(
            "cnpj"                  => $_POST['cnpj'],
            "nome_fantasia"         => $_POST['nome_fantasia'],
            "razao_social"          => $_POST['razao_social'],
            "email"                 => $_POST['email'],
            "telefone"              => $_POST['telefone'],
            "endereco"              => $_POST['endereco'],
            "site"                  => $_POST['site'],
            "instagram"             => $_POST['instagram'],
            "linkedin"              => $_POST['linkedin'],
            "facebook"              => $_POST['facebook'],
            "youtube"               => $_POST['youtube'],
            "twitter"               => $_POST['twitter'],
            "google_maps"           => $_POST['google_maps'],
            "pixel"                 => $_POST['pixel'],
            "horario_funcionamento" => $_POST['horario_funcionamento'],
            "slogan"                => $_POST['slogan'],
            "frase_site_construcao" => $_POST['frase_site_construcao'],
            "site_construcao"       => $_POST['site_construcao'],
        );


        //Validando dados
        if(empty($_FILES)){
            $arrRetorno = $this->modelConfig->validaForm($_POST, "edicao");
        }else{
            $arrRetorno = $this->modelConfig->validaForm($_POST, "edicaoImagem");
        }

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){

            //Gravando imagens no servidor se tiver
            if(!empty($_FILES)){

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH."/img/sistema";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for($i=0; $i<count($_FILES["imagens"]["name"]); $i++){

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal()."/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(450, $objImagem->getDirSaveImage().$nomeUnico);
                    $objImagem->criarThumb(56, $objImagem->getDirSaveImage().$nomeUnico, true, array(1,0,0,47,0,0));

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                    //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                    $dataPost["capa"] = $nomeCapa;
                    $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }
                        

            //Cadastra dados no banco
            $this->modelConfig->updateSistema($dataPost,$id);
            
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }       

    
    /*
     * Salva capa no banco de dados
     */
    public function salvarCapaGaleria($nomeCapa, $id){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }  
        
        //Salvando capa
        $dataPost = array(
            "capa" => $nomeCapa,
        );
        $this->modelConfig->updateSistema($dataPost, $id);
    }
    
    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem){
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH."/img/sistema";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb56_".$nomeImagem);
        $objDiretorio->removerImagemDir("thumb450_".$nomeImagem);
    }
    
    /**
     * Exclui todas as imagens da pasta galeria
     */
    public function excluirTodasFotos($nomeDiretorioGaleria){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("cadastrar") ){
            Common::redir('admin');
        }
        
        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH."/img/sistema";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);

        
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());
        
        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }
    
    
}

