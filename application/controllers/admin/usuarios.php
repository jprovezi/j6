<?php

class Usuarios extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;

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

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();

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
                "nome" => "Usuários",
                "url" => SITE_URL . "/usuarios",
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
        $dados["listagem"] = $this->modelUsuario->getAll(array("where" => "id <> 1182"));

        //Carregando a view
        $this->loadView("admin/usuarios/main", $dados);
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
                "nome" => "Usuários",
                "url" => SITE_URL . "/usuarios",
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

        //Lista dos perfis de usuário
        $dados["perfil"] = $this->modelPerfil->getAll(array("where" => "", "orderBy" => "nome ASC", "limit" => "", "offset" => ""));

        $dados["urlAction"] = SITE_URL . "/usuarios/cadastrar-exe";

        //Informação se a senha é edição ou cadastro
        $dados["senhaEditar"] = "FALSE";

        //Carrega visão
        $this->loadView("admin/usuarios/cadUpdate", $dados);
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
            "nome"           => $_POST['nome'],
            "email"          => $_POST['email'],
            "senha"          => $_POST['senha'],
            "whatsapp"       => $_POST['whatsapp'],
            "nascimento"     => Common::dateBanco($_POST['nascimento']),
            "id_perfil"      => $_POST['idPerfil'],
            "cpf"            => $_POST['cpf'],
            "rg"             => $_POST['rg'],
            "endereco"       => $_POST['endereco'],
        );

        //Cria post para validação do email atual ja cadastrado
        $_POST['emailAtualBanco'] = "";

        //Validando dados
        $arrRetorno = $this->modelUsuario->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Diretório Galeria de Imagens
            $nomeDiretorioGaleria = md5(date('d/m/y h:i:s'));
            $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";

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
                    $objImagem->criarThumb(100, $objImagem->getDirSaveImage() . $nomeUnico, true);
                    $objImagem->criarThumb(150, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
            }

            //Criptografando a senha
            $dataPost["senha"] = md5($_POST["senha"]);

            //Cadastra dados no banco
            $idSave = $this->modelUsuario->save($dataPost);

            //grava log
            $this->modelLog->gravarLog("Cadastrado novo usuário " . $dataPost['nome'] . " - " . $dataPost['email']);

            //Url da notificação
            $url = SITE_URL . "/usuarios/editar/" . $idSave;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Gravado novo usuário no sistema " . $dataPost["nome"], $url, "all");
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
        $dados["dadosBanco"] = $this->modelUsuario->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Usuários",
                "url" => SITE_URL . "/usuarios",
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
        $nomeDiretorioGaleria = (is_null($dados['dadosBanco']['dir_galeria']) || empty($dados['dadosBanco']['dir_galeria'])) ? "-" : $dados['dadosBanco']['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb100_", "thumb150_"));

        //Informação se a senha é edição ou cadastro
        $dados["senhaEditar"] = "TRUE";

        $dados["perfil"] = $this->modelPerfil->getAll(array("where" => "", "orderBy" => "nome ASC", "limit" => "", "offset" => ""));
        $dados["urlAction"] = SITE_URL . "/usuarios/editar-exe/" . $dados["dadosBanco"]["id"];

        //Carrega visão
        $this->loadView("admin/usuarios/cadUpdate", $dados);
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

        //Recebendo dados do cadastro atual
        $dados = $this->modelUsuario->getByid($id);

        //Recebendo dados do form
        $dataPost = array(
            "nome"           => $_POST['nome'],
            "email"          => $_POST['email'],
            "senha"          => $_POST['senha'],
            "whatsapp"       => $_POST['whatsapp'],
            "nascimento"     => Common::dateBanco($_POST['nascimento']),
            "id_perfil"      => $_POST['idPerfil'],
            "cpf"            => $_POST['cpf'],
            "rg"             => $_POST['rg'],
            "endereco"       => $_POST['endereco'],
        );


        //Cria post para validação do email atual ja cadastrado
        $_POST['emailAtualBanco'] = $dados["email"];


        //Validando dados
        if (empty($_FILES)) {
            $arrRetorno = $this->modelUsuario->validaForm($_POST, "edicao");
        } else {
            $arrRetorno = $this->modelUsuario->validaForm($_POST, "edicaoImagem");
        }

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Gravando imagens no servidor se tiver
            if (!empty($_FILES)) {

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for ($i = 0; $i < count($_FILES["imagens"]["name"]); $i++) {

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal() . "/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(100, $objImagem->getDirSaveImage() . $nomeUnico, true);
                    $objImagem->criarThumb(150, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
                $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }

            //Atualizando a senha se o usuário trocou
            if (!empty($_POST["senha"])) {
                $dataPost["senha"] = md5($_POST["senha"]);
            } else {
                $dataPost["senha"] = $dados["senha"];
            }


            //Cadastra dados no banco
            $this->modelUsuario->update($dataPost, $id);

            //grava log
            $this->modelLog->gravarLog("Editado usuário " . $dataPost['nome'] . " - " . $dataPost['email']);

            //Url da notificação
            $url = SITE_URL . "/usuarios/editar/" . $id;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado usuário no sistema " . $dataPost["nome"], $url, "all");
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
        $this->modelUsuario->update($dataPost, $id);
    }

    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem)
    {
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb100_" . $nomeImagem);
        $objDiretorio->removerImagemDir("thumb150_" . $nomeImagem);
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
        $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";
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
        $dados = $this->modelUsuario->getByid($id);

        //Excluindo fotos
        $this->excluirTodasFotos($dados["dir_galeria"]);


        //Se remover linha com sucesso
        if ($this->modelUsuario->delete($id)) {

            //grava log
            $this->modelLog->gravarLog("Excluído Usuário " . $dados["nome"] . " - " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído Usuário " . $dados["nome"] . " - " . $dados["id"], "", "all");

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
        $dadosBanco = $this->modelUsuario->getByid($id);

        //Lendo diretório da galeria de imagens
        $nomeDiretorioGaleria = (is_null($dadosBanco['dir_galeria']) || empty($dadosBanco['dir_galeria'])) ? "-" : $dadosBanco['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/usuarios";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $arrGaleria = $objDiretorio->lerDiretorio(array("thumb150_", "thumb100_"));
        if (count($arrGaleria) >= 1) {
            $img = "";
            $caminhoImagem = STATIC_URL . "/img/usuarios/{$dadosBanco['dir_galeria']}";
            foreach ($arrGaleria as $valor) {
                $img .= "<a href='{$caminhoImagem}/{$valor}' data-fancybox='galeria' class='fancybox'>";
                $img .= "<img src='{$caminhoImagem}/thumb150_{$valor}' class='imagem-modal'>";
                $img .= "</a>";
            }
            $arrGaleria = $img;
        } else {
            $arrGaleria = "";
        }

        //Criando documento de exibição
        $documento = "<strong>Nome: </strong> {$dadosBanco['nome']}<br>";
        $documento .= "<strong>Email: </strong> {$dadosBanco['email']}<br>";
        $documento .= "<strong>Whatsapp: </strong> {$dadosBanco['whatsapp']}<br>";
        $documento .= "<strong>CPF: </strong> {$dadosBanco['cpf']}<br>";
        $documento .= "<strong>RG: </strong> {$dadosBanco['rg']}<br>";
        $documento .= "<strong>Endereço: </strong> {$dadosBanco['endereco']}<br>";
        $documento .= "<strong>Nascimento: </strong> {$dadosBanco['nascimento']}<br>";

        $arrRetorno = array(
            "titulo"    => "Dados do usuário",
            "documento" => $documento,
            "editar"    => SITE_URL . "/produtos-admin/editar/$id",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }
}
