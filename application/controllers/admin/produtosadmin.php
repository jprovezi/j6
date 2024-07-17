<?php

class ProdutosAdmin extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;
    private $modelProdutos;
    private $modelSlug;

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
        $this->loadModel('produtosmodel');
        $this->loadModel('slug');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelProdutos = new ProdutosModel();
        $this->modelSlug = new Slug();

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
                "nome" => "Produtos",
                "url" => SITE_URL . "/produtos-admin",
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
        $dados["listagem"] = $this->modelProdutos->getAllProdutosCategorias();

        //Carregando a view
        $this->loadView("admin/produtos/main", $dados);
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
                "nome" => "Produtos",
                "url" => SITE_URL . "/produtos-admin",
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
        $dados["urlAction"] = SITE_URL . "/produtos-admin/cadastrar-exe";
        $dados["urlCategoria"] = SITE_URL . "/produtos-admin/categoria-cadastrar-exe";
        $dados["urlCategoriaRemover"] = SITE_URL . "/produtos-admin/categoria-remover-exe";

        //Categorias do produto
        $dados["categoria"] = $this->modelProdutos->getAllCategoria(array("orderBy" => "titulo ASC"));

        //Carrega visão
        $this->loadView("admin/produtos/cadUpdate", $dados);
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
            "titulo"             => Common::removerCaracteresEspeciais($_POST['titulo']),
            "texto"              => Common::limpaCaracteresEstranhos($_POST['texto']),
            "url_video"          => $_POST['url_video'],
            "preco"              => $_POST['preco'],
            "link_pagamento"     => $_POST['link_pagamento'],
            "categoria_id"       => ($_POST['categoria_id'] == "") ? NULL : $_POST['categoria_id'],
            "ativo"              => $_POST['ativo'],
            "destaque"           => $_POST['destaque'],
            "url_botao"    => $_POST['url_botao'],
            "texto_botao"    => $_POST['texto_botao'],              
        );


        //Validando dados
        $arrRetorno = $this->modelProdutos->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Diretório Galeria de Imagens
            $nomeDiretorioGaleria = md5(date('d/m/y h:i:s'));
            $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";

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
                    $objImagem->criarThumb(770, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(1200, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(550, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
            }


            //Cadastra dados no banco
            $idSave = $this->modelProdutos->save($dataPost);

            //Cadastra Slug no banco
            $controladorBase = Common::slug("Produtos Detalhes");
            $slug = Common::slug($dataPost["titulo"]);
            $dataPostSlug["slug"] = Common::slugNomeArquivo($slug);
            $dataPostSlug["id_slug"] = $idSave;
            $this->modelSlug->save($dataPostSlug);

            //Cria arquivo fisico do controlador
            $this->copiaControlador(Common::slug($dataPost["titulo"]), $controladorBase);

            //grava log
            $this->modelLog->gravarLog("Cadastrado novo produto " . $dataPost['titulo']);

            //Url editar produtos
            $url = SITE_URL . "/produtos-admin/editar/" . $idSave;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Cadastrado novo produto " . $dataPost["titulo"], $url, "all");
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }

    /**
     * Cadastra uma nova categoria no banco de dados
     *
     * @return void
     */
    public function categoriaCadastrarExe()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("cadastrar")) {
            Common::redir('admin');
        }

        //Recebendo dados do form
        $dataPost = array(
            "titulo"    => $_POST['titulo'],
        );

        //Cadastra dados no banco
        $idSave = $this->modelProdutos->saveCategoria($dataPost);

        //Retorno da categoria
        $arrRetorno = array(
            "id" => $idSave
        );

        //retorno usuário
        echo json_encode($arrRetorno);
    }

    public function categoriaRemoverExe()
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("excluir")) {
            Common::redir('admin');
        }

        //Recebendo dados do form
        $id = $_POST['id'];

        //Removendo categoria
        $this->modelProdutos->deleteCategoria($id);

        //Retorno da categoria
        $arrRetorno = array(
            "id" => $id
        );

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
        $dados["dadosBanco"] = $this->modelProdutos->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Produtos",
                "url" => SITE_URL . "/produtos-admin",
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
        $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_", "thumb770_", "thumb1200_"));

        $dados["urlAction"] = SITE_URL . "/produtos-admin/editar-exe/" . $dados["dadosBanco"]["id"];
        $dados["urlCategoria"] = SITE_URL . "/produtos-admin/categoria-cadastrar-exe";
        $dados["urlCategoriaRemover"] = SITE_URL . "/produtos-admin/categoria-remover-exe";

        //Categorias do produto
        $dados["categoria"] = $this->modelProdutos->getAllCategoria(array("orderBy" => "titulo ASC"));

        //Carrega visão
        $this->loadView("admin/produtos/cadUpdate", $dados);
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
            "titulo"             => Common::removerCaracteresEspeciais($_POST['titulo']),
            "texto"              => Common::limpaCaracteresEstranhos($_POST['texto']),
            "url_video"          => $_POST['url_video'],
            "preco"              => $_POST['preco'],
            "link_pagamento" => $_POST['link_pagamento'],
            "categoria_id"       => ($_POST['categoria_id'] == "") ? NULL : $_POST['categoria_id'],
            "ativo"              => $_POST['ativo'],
            "destaque"           => $_POST['destaque'],
            "url_botao"    => $_POST['url_botao'],
            "texto_botao"    => $_POST['texto_botao'],              
        );

        //Recebendo dados do banco
        $dadosBanco = $this->modelProdutos->getByid($id);


        //Validando dados
        if (empty($_FILES)) {
            $arrRetorno = $this->modelProdutos->validaForm($_POST, "edicao", $dadosBanco["titulo"]);
        } else {
            $arrRetorno = $this->modelProdutos->validaForm($_POST, "edicaoImagem", $dadosBanco["titulo"]);
        }

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Gravando imagens no servidor se tiver
            if (!empty($_FILES)) {

                $dados = $this->modelProdutos->getByid($id);

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dados["dir_galeria"])) ? $dados["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";

                //Criando diretório para gravar a galeria
                $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
                $objDiretorio->criarDiretorio();

                for ($i = 0; $i < count($_FILES["imagens"]["name"]); $i++) {

                    //Criando obj Imagem
                    $objImagem = new imagem($objDiretorio->getPathDiretorioFinal() . "/", $_FILES["imagens"]["name"][$i]);

                    //Salvando imagem no servidor
                    $nomeUnico = $objImagem->saveImage($_FILES["imagens"]["tmp_name"][$i]);

                    //Criando thumbs das imagens
                    $objImagem->criarThumb(770, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(1200, $objImagem->getDirSaveImage() . $nomeUnico);
                    $objImagem->criarThumb(550, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
                $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }


            //Cadastra dados no banco
            $this->modelProdutos->update($dataPost, $id);

            //Apenas cria novo controlador se o usuário editou o titulo
            if($dadosBanco["titulo"] != $dataPost["titulo"]){

                //Acha e Deleta Slug no banco
                $slug = Common::slug($dadosBanco["titulo"]);
                $slug = $this->modelSlug->getBySlug(Common::slugNomeArquivo($slug));
                $this->modelSlug->delete($slug["id"]);

                //Deleta controlador antigo
                $this->deletaControlador($dadosBanco["titulo"]);

                //Cadastra Novo Slug no banco
                $controladorBase = Common::slug("Produtos Detalhes");
                $slug = Common::slug($dataPost["titulo"]);
                $dataPostSlug["slug"] = Common::slugNomeArquivo($slug);
                $dataPostSlug["id_slug"] = $id;
                $this->modelSlug->save($dataPostSlug);

                //Cria arquivo fisico do controlador
                $this->copiaControlador(Common::slug($dataPost["titulo"]), $controladorBase);    

            }
        

            //grava log
            $this->modelLog->gravarLog("Editado produto " . $dataPost['titulo']);

            //Url da notificação
            $url = SITE_URL . "/produtos-admin/editar/" . $id;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado produto no sistema " . $dataPost["titulo"], $url, "all");
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
        $this->modelProdutos->update($dataPost, $id);
    }

    /**
     * Ativa ou Desativa um registro no banco
     *
     * @param int $id
     * @param string $campoBanco Nome da coluna no banco de dados
     * @return void
     */
    public function ativarRegistro($id, $campoBanco = "ativo")
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Recebe atual situação do registro
        $produtos = $this->modelProdutos->getByid($id);

        //Faz a inversão do botão
        $ativo = ($produtos[$campoBanco] == "S") ? "N" : "S";

        //Salva
        $dataPost = array(
            $campoBanco => $ativo,
        );

        //Modifica o registro
        $this->modelProdutos->update($dataPost, $id);
    }

    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem)
    {
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb550_" . $nomeImagem);
        $objDiretorio->removerImagemDir("thumb770_" . $nomeImagem);
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
        $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";
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
        $dados = $this->modelProdutos->getByid($id);

        //Excluindo fotos
        $this->excluirTodasFotos($dados["dir_galeria"]);


        //Se remover linha com sucesso
        if ($this->modelProdutos->delete($id)) {

            //Acha e Deleta Slug no banco
            $slug = Common::slug($dados["titulo"]);
            $slug = $this->modelSlug->getBySlug(Common::slugNomeArquivo($slug));
            $this->modelSlug->delete($slug["id"]);

            //Deleta controlador antigo
            $this->deletaControlador($dados["titulo"]);            

            //grava log
            $this->modelLog->gravarLog("Excluído produto " . $dados["titulo"] . " - " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído produto " . $dados["titulo"] . " - " . $dados["id"], "", "all");

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
        $dadosBanco = $this->modelProdutos->getByid($id);

        //Lendo diretório da galeria de imagens
        $nomeDiretorioGaleria = (is_null($dadosBanco['dir_galeria']) || empty($dadosBanco['dir_galeria'])) ? "-" : $dadosBanco['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/produtos";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $arrGaleria = $objDiretorio->lerDiretorio(array("thumb550_", "thumb770_", "thumb1200_"));
        if (count($arrGaleria) >= 1) {
            $img = "";
            $caminhoImagem = STATIC_URL . "/img/produtos/{$dadosBanco['dir_galeria']}";
            foreach ($arrGaleria as $valor) {
                $img .= "<a href='{$caminhoImagem}/thumb1200_{$valor}' data-fancybox='galeria' class='fancybox'>";
                $img .= "<img src='{$caminhoImagem}/thumb550_{$valor}' class='imagem-modal'>";
                $img .= "</a>";
            }
            $arrGaleria = $img;
        } else {
            $arrGaleria = "";
        }

        //Botão de assistir video se tiver
        if(!empty($dadosBanco["url_video"])){
            $btnVideo = "<br><br><a data-fancybox='' href='{$dadosBanco['url_video']}' class='btn btn-sistema'>ASSISTIR VÍDEO</a><br><br>";
        }else{
            $btnVideo = "";
        }

        //Preço se tirver
        if(!empty($dadosBanco["preco"])){
            $btnPreco = "<br><a class='btn btn-sistema'>{$dadosBanco['preco']}</a><br><br>";
        }else{
            $btnPreco = "";
        }        

        $arrRetorno = array(
            "titulo"    => "{$dadosBanco['titulo']}",
            "documento" => $dadosBanco["texto"].$btnVideo.$btnPreco,
            "editar"    => SITE_URL . "/produtos-admin/editar/$id",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }


    private function copiaControlador($apelido, $controladorBase)
    {
    
        //lê o controlador que irá aplicar a copia
        $stringController = file_get_contents(CONTROLLER_PATH."/site/".Common::slugNomeArquivo($controladorBase).".php");

        //Cria o nome da classe de copia
        $controladorBaseClass = Common::slugClass($controladorBase);

        //Cria o nome da nova classe
        $apelicoClass = Common::slugClass($apelido);

        //Altera o nome da classe
        $stringController = str_replace("class $controladorBaseClass", "class $apelicoClass", $stringController);

        //Cria o novo controller no sistema
        $arquivo = fopen(CONTROLLER_PATH."/site/".Common::slugNomeArquivo($apelido).".php", 'w');
        fwrite($arquivo, $stringController);
        fclose($arquivo);

    }

    private function deletaControlador($titulo)
    {
        //lê o controlador que irá aplicar a copia
        $controlador = Common::slug($titulo);
        unlink(CONTROLLER_PATH."/site/".Common::slugNomeArquivo($controlador).".php");
    } 

}
