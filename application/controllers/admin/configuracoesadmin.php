<?php

class ConfiguracoesAdmin extends Controller {

    private $modelLog;
    private $modelNotificacao;        
    private $modelConfig;
    private $modelPerfil;
    private $modelUsuario;
    private $modelMenu;
    private $modelIcone;

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
        $this->loadModel('menu');
        $this->loadModel('icone');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelConfig = new Configuracao();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelMenu = new Menu();
        $this->modelIcone = new Icone();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();        

    }


    public function main() {

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }

        //Carregar edição config
        $this->sistema();
    }    

    private function getPermissionUserMaster(){
        //Apenas usuário programador terá acesso
        if( Session::get("id_usuario") != ID_MASTER_ADMIN ){
            Common::redir("admin");
        }        
    }

    public function menuCadastrar(){
               
        //Permissão master
        $this->getPermissionUserMaster();   
        
        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Configurações",
                "url" => SITE_URL."/configuracoes-admin",  
            ),
            array(
                "nome" => "Menu",
                "url" => SITE_URL."/configuracoes-admin/menu",  
            ),
            array(
                "nome" => "Ícones",
                "url" => SITE_URL."/configuracoes-admin/icones",   
            ),
        );

        //Recebendo ícones do banco
        $dados["icones"] = $this->modelIcone->getAll(array("orderBy"=>"id ASC"));

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);    

        //Variáveis de construção da view
        $dados["dadosBanco"] = NULL;

        $dados["urlAction"] = SITE_URL."/configuracoes-admin/menu-exe";
        
        //Carrega visão
        $this->loadView("admin/configuracoes/menuCadUpdate", $dados);
        
    }

    public function menuExe(){
        
        //Permissão master
        $this->getPermissionUserMaster();  
        
        //Recebendo dados do form
        $dataPost = array(
            "nome"       => $_POST['nome'],
            "icone"      => $_POST['icone'],
            "url"        => $_POST['url'],
            "controller" => $_POST['controller'],
            "categoria"  => $_POST['categoria'],
            "idFilho"    => (empty($_POST['idFilho'])) ? NULL : $_POST['idFilho'],
            "ordem"      => $_POST['ordem'],
            "tags"       => $_POST['tags'],
        );

        
        //Validando dados
        $arrRetorno = $this->modelMenu->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
             
            //Cadastra dados no banco
            $this->modelMenu->save($dataPost);
            
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }

  /**
     * Cria view de cadastro
     */
    public function menuEditar($id = 0){
               
        //Permissão master
        $this->getPermissionUserMaster();  
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelMenu->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Configurações",
                "url" => SITE_URL."/configuracoes-admin",  
            ),
            array(
                "nome" => "Menu",
                "url" => SITE_URL."/configuracoes-admin/menu",  
            ),
            array(
                "nome" => "Ícones",
                "url" => SITE_URL."/configuracoes-admin/icones",   
            ),
        );
        $dados["urlAction"] = SITE_URL."/configuracoes-admin/menu-editar-exe/".$dados["dadosBanco"]["id"];

        //Recebendo ícones do banco
        $dados["icones"] = $this->modelIcone->getAll(array("orderBy"=>"id ASC"));        

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);            
        
        
        //Carrega visão
        $this->loadView("admin/configuracoes/menuCadUpdate", $dados);
        
    }



    /**
     * Executa a edição do controller
     */
    public function menuEditarExe($id = 0){
        
        //Verifica se usuário tem permissão de usar o módulo
        $this->getPermissionUserMaster();
        
        //Recebendo dados do cadastro atual
        $dados = $this->modelMenu->getByid($id);        
        
        //Recebendo dados do form
        $dataPost = array(
            "nome"       => $_POST['nome'],
            "icone"      => $_POST['icone'],
            "url"        => $_POST['url'],
            "controller" => $_POST['controller'],
            "categoria"  => $_POST['categoria'],
            "idFilho"    => (empty($_POST['idFilho'])) ? NULL : $_POST['idFilho'],
            "ordem"      => $_POST['ordem'],
            "tags"       => $_POST['tags'],
        );

        
        $arrRetorno = $this->modelMenu->validaForm($_POST, "edicao");


        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){
                        
            //Cadastra dados no banco
            $this->modelMenu->update($dataPost,$id);
                        
        }
        
        //retorno usuário
        echo json_encode($arrRetorno);
        
    }        
    
    public function menuRemover($id){
        
        //Permissão master
        $this->getPermissionUserMaster();        
        
        
        //Se remover linha com sucesso
        if($this->modelMenu->delete($id)){
                        
            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }
            
        echo json_encode($retornoUsuario);
        
    }     

    public function menu(){
        //Permissão master
        $this->getPermissionUserMaster();

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Configurações",
                "url" => SITE_URL."/configuracoes-admin",  
            ),
            array(
                "nome" => "Menu",
                "url" => SITE_URL."/configuracoes-admin/menu",  
            ),
            array(
                "nome" => "Ícones",
                "url" => SITE_URL."/configuracoes-admin/icones",  
            ),            
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);    
       
        //Carregando dados banco
        $dados["listagem"] = $this->modelMenu->getAll();

        //Carregando a view
        $this->loadView("admin/configuracoes/menu",$dados);      
    }

    public function icones(){
        //Permissão master
        $this->getPermissionUserMaster();

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Configurações",
                "url" => SITE_URL."/configuracoes-admin",  
            ),
            array(
                "nome" => "Menu",
                "url" => SITE_URL."/configuracoes-admin/menu",  
            ),
            array(
                "nome" => "Ícones",
                "url" => SITE_URL."/configuracoes-admin/icones",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);    
       
        //Carregando dados banco
        $dados["listagem"] = $this->modelIcone->getAll();

        //Carregando a view
        $this->loadView("admin/configuracoes/icones",$dados);      
    }

    /**
     * Cria view de cadastro
     */
    public function sistema(){

        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("visualizar") ){
            Common::redir('admin');
        }
        
        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelConfig->getConfigSistema();
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Configuração do Sistema",
                "url" => SITE_URL."/configuracoes-admin",  
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

        $dados["urlAction"] = SITE_URL."/configuracoes-admin/sistema-exe/".$dados["dadosBanco"]["id"];
        
        //Carrega visão
        $this->loadView("admin/configuracoes/updateSistema", $dados);
        
    }


    /**
     * Executa a edição do controller
     */
    public function sistemaExe($id = 1){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("editar") ){
            Common::redir('admin');
        }

        //Recebendo dados do cadastro atual
        $dados = $this->modelConfig->getConfigSistema();

        //Recebendo dados do form
        $dataPost = array(
            "cnpj"           => $_POST['cnpj'],
            "nome_fantasia"  => $_POST['nome_fantasia'],
            "razao_social"   => $_POST['razao_social'],
            "email"          => $_POST['email'],
            "telefone"       => $_POST['telefone'],
            "endereco"       => $_POST['endereco'],
            "site"           => $_POST['site'],
            "instagram"      => $_POST['instagram'],
            "linkedin"       => $_POST['linkedin'],
            "facebook"       => $_POST['facebook'],
            "cor_primaria"   => ( strlen($_POST['cor_primaria']) <= 6 ) ? "#".$_POST['cor_primaria'] : $_POST['cor_primaria'],
            "cor_secundaria" => ( strlen($_POST['cor_secundaria']) <= 6 ) ? "#".$_POST['cor_secundaria'] : $_POST['cor_secundaria'],
            "cor_terciaria"  => ( strlen($_POST['cor_terciaria']) <= 6 ) ? "#".$_POST['cor_terciaria'] : $_POST['cor_terciaria'],
            "texto_rodape"   => $_POST['texto_rodape'],
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
                    $objImagem->criarThumb(56, $objImagem->getDirSaveImage().$nomeUnico, false);
                    $objImagem->criarThumb(450, $objImagem->getDirSaveImage().$nomeUnico, false);

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
        $this->getPermissionUserMaster();      
        
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
        
        //So o programador tem acesso
        $this->getPermissionUserMaster();
        
        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH."/img/sistema";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);

        
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());
        
        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }
    
    
    /**
     * Remove registro do banco de dados
     */
    public function remover($id){
        
        //Verifica se usuário tem permissão de usar o módulo
        if( !$this->modelPerfil->verificaPerfil("excluir") ){
            Common::redir('admin');
        }       
        
        $retornoUsuario = NULL;
        
        //Recebendo dados do usuário
        $dados = $this->modelConfig->getByid($id);
        
        //Excluindo fotos
        $this->excluirTodasFotos($dados["dir_galeria"]);

        
        //Se remover linha com sucesso
        if($this->modelConfig->delete($id)){
            
            //grava log
            $this->modelLog->gravarLog("Excluído Usuário ".$dados["nome"]." - ".$dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído Usuário ".$dados["nome"]." - ".$dados["id"],"",Session::get("idUsuario"));
            
            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }
            
        echo json_encode($retornoUsuario);
        
    }    

}

