<?php

class InstitucionalAdmin extends Controller {

    private $modelLog;
    private $modelNotificacao;        
    private $modelUsuario;
    private $modelPerfil;
    private $modelInstitucional;

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
        $this->loadModel('usuario');
        $this->loadModel('perfil');
        $this->loadModel('institucionalmodel');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelInstitucional = new InstitucionalModel();

    }


    public function main($id = 0) {
        $this->editar($id);
    }



    /**
     * Cria view de cadastro
     */
    public function editar($id = 1){

        //Id do banco para alterar
        $id = 1;

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["config"] = Session::get('config');
        $dados["dadosBanco"] = $this->modelInstitucional->getByid(1);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Institucional",
                "url" => SITE_URL."/institucional-admin",  
            ),
            array(
                "nome" => "Editando {$dados["config"]["nome_fantasia"]}",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);            

        //Chamando a galeria do banco
        $nomeDiretorioGaleria = ( is_null($dados['dadosBanco']['dir_galeria']) || empty($dados['dadosBanco']['dir_galeria']) ) ? "-" : $dados['dadosBanco']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH."/img/institucional";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb585_","thumb1000_"));
        
        $dados["urlAction"] = SITE_URL."/institucional-admin/editar-exe/".$id;
        
        //Carrega visão
        $this->loadView("admin/institucional/cadUpdate", $dados);
        
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 1){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }      
        
        //Recebendo dados do cadastro atual
        $dados = $this->modelInstitucional->getByid($id);        
        
        //Recebendo dados do form
        $dataPost = array(
            "texto"          => $_POST['texto'],
            "missao"         => $_POST['missao'],
            "visao"          => $_POST['visao'],
            "valores"        => $_POST['valores'],
            "numero_1"       => $_POST['numero_1'],
            "numero_2"       => $_POST['numero_2'],
            "numero_3"       => $_POST['numero_3'],
            "numero_4"       => $_POST['numero_4'],
            "numero_5"       => $_POST['numero_5'],
            "numero_6"       => $_POST['numero_6'],
            "numero_7"       => $_POST['numero_7'],
            "numero_8"       => $_POST['numero_8'],
            "texto_numero_1" => $_POST['texto_numero_1'],
            "texto_numero_2" => $_POST['texto_numero_2'],
            "texto_numero_3" => $_POST['texto_numero_3'],
            "texto_numero_4" => $_POST['texto_numero_4'],
            "texto_numero_5" => $_POST['texto_numero_5'],
            "texto_numero_6" => $_POST['texto_numero_6'],
            "texto_numero_7" => $_POST['texto_numero_7'],
            "texto_numero_8" => $_POST['texto_numero_8'],
        );

        //Validando dados
        $arrRetorno = $this->modelInstitucional->validaForm($_POST, "edicaoImagem");


        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){

            //Gravando imagens no servidor se tiver
            if(!empty($_FILES)){

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH."/img/institucional";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for($i=0; $i<count($_FILES["imagens"]["name"]); $i++){

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal()."/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(585, $objImagem->getDirSaveImage().$nomeUnico);
                    $objImagem->criarThumb(1000, $objImagem->getDirSaveImage().$nomeUnico);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                    //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                    $dataPost["capa"] = $nomeCapa;
                    $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }

            
            //Cadastra dados no banco
            $this->modelInstitucional->update($dataPost,$id);
            
            //grava log
            $this->modelLog->gravarLog("Editado dados institucionais");

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado dados institucionais","","all");
            
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
        $this->modelInstitucional->update($dataPost, $id);
    }
    
    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem){
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH."/img/institucional";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb585_".$nomeImagem);
        $objDiretorio->removerImagemDir("thumb1000_".$nomeImagem);
    }
    
    /**
     * Exclui todas as imagens da pasta galeria
     */
    public function excluirTodasFotos($nomeDiretorioGaleria){
        
        if(is_null($nomeDiretorioGaleria)){
            $nomeDiretorioGaleria = "sem-dir";
        }
        
        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH."/img/institucional";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);

        
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());
        
        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }
    

}

