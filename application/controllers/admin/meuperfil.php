<?php

class MeuPerfil extends Controller {

    private $modelLog;
    private $modelNotificacao;        
    private $modelUsuario;
    private $modelPerfil;

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

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();     
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();

    }


    public function main($id = 0) {
        $this->editar($id);
    }



    /**
     * Cria view de cadastro
     */
    public function editar($id = 0){
        
        //blindando usuario que quer editar o amigo
        if( Session::get("id_usuario") != $id ){
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelUsuario->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Usuários",
                "url" => SITE_URL."/usuarios",  
            ),
            array(
                "nome" => "Editando {$dados["dadosBanco"]["nome"]}",
                "url" => "",  
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);            

        //Criando Galeria
        $nomeDiretorioGaleria = ( is_null($dados['dadosBanco']['dir_galeria']) || empty($dados['dadosBanco']['dir_galeria']) ) ? "-" : $dados['dadosBanco']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH."/img/usuarios";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb100_","thumb150_"));
        
        //Informação se a senha é edição ou cadastro
        $dados["senhaEditar"] = "TRUE";

        $dados["perfil"] = NULL;
        $dados["urlAction"] = SITE_URL."/meu-perfil/editar-exe/".$dados["dadosBanco"]["id"];
        
        //Carrega visão
        $this->loadView("admin/usuarios/cadUpdate", $dados);
        
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 0){

        //blindando usuario que quer editar o amigo
        if( Session::get("id_usuario") != $id ){
            Common::redir('admin');
        }        
        
        //Recebendo dados do cadastro atual
        $dados = $this->modelUsuario->getByid($id);        
        
        //Recebendo dados do form
        $dataPost = array(
            "nome"           => $_POST['nome'],
            "email"          => $_POST['email'],
            "senha"          => $_POST['senha'],
            "whatsapp"       => $_POST['whatsapp'],
            "nascimento"     => Common::dateBanco($_POST['nascimento']),
            "cpf"            => $_POST['cpf'],
            "rg"             => $_POST['rg'],
            "endereco"       => $_POST['endereco'],            
        );

        
        //Cria post para validação do email atual ja cadastrado
        $_POST['emailAtualBanco'] = $dados["email"];
        
        //Validando dados
        $arrRetorno = $this->modelUsuario->validaForm($_POST, "edicaoImagem");


        //Se dados forem válidos, realiza cadastro
        if($arrRetorno["tipo"] == "sucesso"){

            //Gravando imagens no servidor se tiver
            if(!empty($_FILES)){

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH."/img/usuarios";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for($i=0; $i<count($_FILES["imagens"]["name"]); $i++){

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal()."/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(100, $objImagem->getDirSaveImage().$nomeUnico, true);
                    $objImagem->criarThumb(150, $objImagem->getDirSaveImage().$nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                    //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                    $dataPost["capa"] = $nomeCapa;
                    $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }
            
            //Atualizando a senha se o usuário trocou
            if( !empty($_POST["senha"]) ){
                $dataPost["senha"] = md5($_POST["senha"]);
            }else{
                $dataPost["senha"] = $dados["senha"];
            }

            //Recuperando perfil
            $usuario = Session::get("dadosUsuario");
            $dataPost["id_perfil"] = $usuario["id_perfil"];
            
            //Cadastra dados no banco
            $this->modelUsuario->update($dataPost,$id);

            //Deleta dados do usuário da sessão e recria
            Session::delete("dadosUsuario");
            Session::set("dadosUsuario",$this->modelUsuario->getByid($id));
            
            //grava log
            $this->modelLog->gravarLog("Editado usuário ".$dataPost['nome']." - ".$dataPost['email']);

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado usuário no sistema ".$dataPost["nome"]);
            
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
        $this->modelUsuario->update($dataPost, $id);
    }
    
    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem){
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH."/img/usuarios";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb100_".$nomeImagem);
        $objDiretorio->removerImagemDir("thumb150_".$nomeImagem);
    }
    
    /**
     * Exclui todas as imagens da pasta galeria
     */
    public function excluirTodasFotos($nomeDiretorioGaleria){
        
        if(is_null($nomeDiretorioGaleria)){
            $nomeDiretorioGaleria = "sem-dir";
        }
        
        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH."/img/usuarios";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);

        
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());
        
        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }
    

}

