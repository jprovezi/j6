<?php

class EquipeAdmin extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;
    private $modelEquipe;

    public function __construct()
    {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if (!Session::get("logado")) {
            Session::destroy();
            Common::redir('login');
        }

        //Carrega os modelos
        $this->loadModel('log');
        $this->loadModel('notificacoes');
        $this->loadModel('usuario');
        $this->loadModel('perfil');
        $this->loadModel('equipemodel');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelEquipe = new EquipeModel();

        //Adiciona Acesso ao menu
        $this->modelUsuario->setAcessoMenu();
    }


    public function main()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("visualizar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "equipe",
                "url" => SITE_URL . "/equipe-admin",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);


        //Perfil do usuário
        $dados["cadastrar"] = $this->modelPerfil->verificaPerfil("cadastrar");
        $dados["editar"] = $this->modelPerfil->verificaPerfil("editar");
        $dados["excluir"] = $this->modelPerfil->verificaPerfil("excluir");

        //Carregando dados banco
        $dados["listagem"] = $this->modelEquipe->getAll();

        //Carregando a view
        $this->loadView("admin/equipe/main", $dados);
    }

    /**
     * Cria view de cadastro
     */
    public function cadastrar()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Equipe",
                "url" => SITE_URL . "/equipe-admin",
            ),
            array(
                "nome" => "Novo cadastro",
                "url" => "",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        //Variáveis de construção da view
        $dados["dadosBanco"] = NULL;
        $dados["galeria"] = array();

        $dados["urlAction"] = SITE_URL . "/equipe-admin/cadastrar-exe";

        //Carrega visão
        $this->loadView("admin/equipe/cadUpdate", $dados);
    }

    /**
     * Executa o cadastro do controller
     */
    public function cadastrarExe()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Recebendo dados do form
        $dataPost = array(
            "titulo" => $_POST['titulo'],
            "texto"  => $_POST['texto'],
            "cargo"   => $_POST['cargo'],
        );


        //Validando dados
        $arrRetorno = $this->modelEquipe->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Diretório Galeria de Imagens
            $nomeDiretorioGaleria = md5(date('d/m/y h:i:s'));
            $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";

            //Criando diretório para gravar a galeria
            $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
            $objDiretorio->criarDiretorio();

            //Vamos salvar o nome do diretorio no banco
            $dataPost["dir_galeria"] = $nomeDiretorioGaleria;

            //Gravando imagens no servidor se tiver
            if (!empty($_FILES)) {

                for ($i = 0; $i < count($_FILES["imagens"]["name"]); $i++) {

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal() . "/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(1200, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(270, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
            }


            //Cadastra dados no banco
            $idSave = $this->modelEquipe->save($dataPost);

            //grava log
            $this->modelLog->gravarLog("Cadastrado novo equipe " . $dataPost['titulo']);

            //Url editar equipe
            $url = SITE_URL . "/equipe-admin/editar/" . $idSave;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Cadastrado novo equipe " . $dataPost["titulo"], $url, "all");
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }



    /**
     * Cria view de cadastro
     */
    public function editar($id = 0)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Carregando dados da view
        $dados["dadosBanco"] = $this->modelEquipe->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Equipe",
                "url" => SITE_URL . "/equipe-admin",
            ),
            array(
                "nome" => "{$dados["dadosBanco"]["titulo"]}",
                "url" => "",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        //Criando Galeria
        $nomeDiretorioGaleria = (is_null($dados['dadosBanco']['dir_galeria']) || empty($dados['dadosBanco']['dir_galeria'])) ? "-" : $dados['dadosBanco']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb270_","thumb1200_"));

        $dados["urlAction"] = SITE_URL . "/equipe-admin/editar-exe/" . $dados["dadosBanco"]["id"];

        //Carrega visão
        $this->loadView("admin/equipe/cadUpdate", $dados);
    }



    /**
     * Executa a edição do controller
     */
    public function editarExe($id = 0)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Recebendo dados do form
        $dataPost = array(
            "titulo" => $_POST['titulo'],
            "texto"  => $_POST['texto'],
            "cargo"   => $_POST['cargo'],
        );


        //Validando dados
        if (empty($_FILES)) {
            $arrRetorno = $this->modelEquipe->validaForm($_POST, "edicao");
        } else {
            $arrRetorno = $this->modelEquipe->validaForm($_POST, "edicaoImagem");
        }

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Gravando imagens no servidor se tiver
            if (!empty($_FILES)) {

                $dados = $this->modelEquipe->getByid($id);

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for ($i = 0; $i < count($_FILES["imagens"]["name"]); $i++) {

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal() . "/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(1200, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(270, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
                $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }



            //Cadastra dados no banco
            $this->modelEquipe->update($dataPost, $id);

            //grava log
            $this->modelLog->gravarLog("Editado equipe " . $dataPost['titulo']);

            //Url da notificação
            $url = SITE_URL . "/equipe-admin/editar/" . $id;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado equipe no sistema " . $dataPost["titulo"], $url, "all");
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }


    /*
     * Salva capa no banco de dados
     */
    public function salvarCapaGaleria($nomeCapa, $id)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Salvando capa
        $dataPost = array(
            "capa" => $nomeCapa,
        );
        $this->modelEquipe->update($dataPost, $id);
    }


    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem)
    {
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb270_" . $nomeImagem);
        $objDiretorio->removerImagemDir("thumb1200_" . $nomeImagem);
    }

    /**
     * Exclui todas as imagens da pasta galeria
     */
    public function excluirTodasFotos($nomeDiretorioGaleria)
    {

        if (is_null($nomeDiretorioGaleria)) {
            $nomeDiretorioGaleria = "sem-dir";
        }

        //Removendo pasta total galeria
        $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);


        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());

        //Criando pasta galeria vazia
        $objDiretorio->criarDiretorio();
    }


    /**
     * Remove registro do banco de dados
     */
    public function remover($id)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("excluir")) {
            Common::redir('admin');
        }

        $retornoUsuario = NULL;

        //Recebendo dados do usuário
        $dados = $this->modelEquipe->getByid($id);

        //Excluindo fotos
        $this->excluirTodasFotos($dados["dir_galeria"]);


        //Se remover linha com sucesso
        if ($this->modelEquipe->delete($id)) {

            //grava log
            $this->modelLog->gravarLog("Excluído equipe " . $dados["titulo"] . " - " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído equipe " . $dados["titulo"] . " - " . $dados["id"], "", "all");

            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }

        echo json_encode($retornoUsuario);
    }

    public function lerDocumentoModal($id)
    {

        //Lendo diretorio que o documento ta no banco
        $dadosBanco = $this->modelEquipe->getByid($id);

        //Lendo diretório da galeria de imagens
        $nomeDiretorioGaleria = (is_null($dadosBanco['dir_galeria']) || empty($dadosBanco['dir_galeria'])) ? "-" : $dadosBanco['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/equipe";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $arrGaleria = $objDiretorio->lerDiretorio(array("thumb270_", "thumb1200_"));
        if (count($arrGaleria) >= 1) {
            $img = "";
            $caminhoImagem = STATIC_URL . "/img/equipe/{$dadosBanco['dir_galeria']}";
            foreach ($arrGaleria as $valor) {
                $img .= "<a href='{$caminhoImagem}/thumb1200_{$valor}' data-fancybox='galeria' class='fancybox'>";
                $img .= "<img src='{$caminhoImagem}/thumb270_{$valor}' class='imagem-modal'>";
                $img .= "</a>";
            }
            $arrGaleria = $img;
        } else {
            $arrGaleria = "";
        }

        $arrRetorno = array(
            "titulo"    => "{$dadosBanco['titulo']} - {$dadosBanco['cargo']}",
            "documento" => $dadosBanco["texto"],
            "editar"    => SITE_URL . "/equipe/editar/$id",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }
}
