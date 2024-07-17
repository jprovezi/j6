<?php

class PaginasExtras extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;
    private $modelPaginaExtra;
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
        $this->loadModel('paginaextramodel');
        $this->loadModel('slug');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelPaginaExtra = new PaginaExtraModel();
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
                "nome" => "Páginas Extras",
                "url" => SITE_URL . "/paginas-extras",
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
        $dados["listagem"] = $this->modelPaginaExtra->getAll();

        //Carregando a view
        $this->loadView("admin/paginas-extras/main", $dados);
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
                "nome" => "Páginas Extras",
                "url" => SITE_URL . "/paginas-extras",
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

        $dados["urlAction"] = SITE_URL . "/paginas-extras/cadastrar-exe";

        //Carrega visão
        $this->loadView("admin/paginas-extras/cadUpdate", $dados);
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
            "titulo"   => Common::removerCaracteresEspeciais($_POST['titulo']),
            "ativo"    => $_POST['ativo'],
            "texto"    => Common::limpaTagsHtml($_POST['texto']),
            "destaque" => $_POST['destaque'], 
        );

        //Validando dados
        $arrRetorno = $this->modelPaginaExtra->validaForm($_POST);

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Criando documento
            $dataPost["dir_documento"] = $this->escreverDocumento($_POST["texto"]);

            //Diretório Galeria de Imagens
            $nomeDiretorioGaleria = md5(date('d/m/y h:i:s'));
            $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";

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
                    $objImagem->criarThumb(550, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
            }


            //Cadastra dados no banco
            $idSave = $this->modelPaginaExtra->save($dataPost);

            //Cadastra Slug no banco
            $controladorBase = Common::slug("Pagina Detalhes");
            $slug = Common::slug($dataPost["titulo"]);
            $dataPostSlug["slug"] = Common::slugNomeArquivo($slug);
            $dataPostSlug["id_slug"] = $idSave;
            $this->modelSlug->save($dataPostSlug);

            //Cria arquivo fisico do controlador
            $this->copiaControlador(Common::slug($dataPost["titulo"]), $controladorBase);                

            //grava log
            $this->modelLog->gravarLog("Cadastrado novo paginas-extras " . $dataPost['titulo']);

            //Url editar paginas-extras
            $url = SITE_URL . "/paginas-extras/editar/" . $idSave;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Cadastrado novo paginas-extras " . $dataPost["titulo"], $url, "all");
        }

        //retorno usuário
        echo json_encode($arrRetorno);
    }

    /**
     * Lê um documento em arquivo base64 e retorna uma string
     *
     * @param [int] $id
     * @return string
     */
    public function lerDocumento($id)
    {

        //Lendo diretorio que o documento ta no banco
        $dados["dadosBanco"] = $this->modelPaginaExtra->getByid($id);

        //Abrindo documento salvo no servidor
        $nomeDiretorioDocumento = $dados["dadosBanco"]["dir_documento"];
        $pathDiretorioDocumento = DOCUMENTOS_PATH . "/paginas-extras";
        $caminhoDocumento = $pathDiretorioDocumento . "/" . $nomeDiretorioDocumento;

        //Abre o arquivo e coloca no modo leitura
        $arquivo = $caminhoDocumento . '/documento.bin';
        $handle  = fopen($arquivo, 'r');
        $ler = fread($handle, filesize($arquivo));
        $documento = base64_decode($ler);
        fclose($handle);

        //Retorna documento
        return $documento;
    }

    public function lerDocumentoModal($id)
    {

        //Lendo diretorio que o documento ta no banco
        $dadosBanco = $this->modelPaginaExtra->getByid($id);

        //Lendo diretório da galeria de imagens
        $nomeDiretorioGaleria = (is_null($dadosBanco['dir_galeria']) || empty($dadosBanco['dir_galeria'])) ? "-" : $dadosBanco['dir_galeria'];
        $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $arrGaleria = $objDiretorio->lerDiretorio(array("thumb550_", "thumb870_", "thumb1200_"));
        if(count($arrGaleria) >= 1){
            $img = "";
            $caminhoImagem = STATIC_URL."/img/paginas-extras/{$dadosBanco['dir_galeria']}";
            foreach( $arrGaleria as $valor ){
                $img .= "<a href='{$caminhoImagem}/thumb1200_{$valor}' data-fancybox='galeria' class='fancybox'>";
                $img .= "<img src='{$caminhoImagem}/thumb550_{$valor}' class='imagem-modal'>";
                $img .= "</a>";
            }
            $arrGaleria = $img;
        }else{
            $arrGaleria = "";
        }

        $arrRetorno = array(
            "titulo"    => $dadosBanco["titulo"],
            "documento" => $this->lerDocumento($id),
            "editar"    => SITE_URL . "/paginas-extras/editar/$id",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }

    public function escreverDocumento($conteudo, $id = 0)
    {

        if ($id == 0) {
            //Diretório onde será guardado o documento
            $nomeDiretorioDocumento = md5(date('d/m/y h:i:s'));
            $pathDiretorioDocumento = DOCUMENTOS_PATH . "/paginas-extras";
            $caminhoDocumento = $pathDiretorioDocumento . "/" . $nomeDiretorioDocumento;

            //Criando diretório para gravar os documentos
            $objDiretorio = new diretorio($nomeDiretorioDocumento, $pathDiretorioDocumento);
            $objDiretorio->criarDiretorio();

            //Criando arquivo no diretório
            $conteudo = base64_encode($conteudo);

            $arquivo = fopen($caminhoDocumento . '/documento.bin', 'w');
            fwrite($arquivo, $conteudo);
            fclose($arquivo);
        } else {

            //Recebendo dados salvos no banco
            $dadosBanco = $this->modelPaginaExtra->getByid($id);

            //Diretório onde será guardado o documento
            $nomeDiretorioDocumento = $dadosBanco["dir_documento"];
            $pathDiretorioDocumento = DOCUMENTOS_PATH . "/paginas-extras";
            $caminhoDocumento = $pathDiretorioDocumento . "/" . $nomeDiretorioDocumento;

            //Criando arquivo no diretório
            $conteudo = base64_encode($_POST["texto"]);

            $arquivo = fopen($caminhoDocumento . '/documento.bin', 'w');
            fwrite($arquivo, $conteudo);
            fclose($arquivo);
        }

        return $nomeDiretorioDocumento;
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
        $dados["dadosBanco"] = $this->modelPaginaExtra->getByid($id);
        $dados["breadcrumb"] = array(
            array(
                "nome" => "Páginas Extra",
                "url" => SITE_URL . "/paginas-extras",
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
        $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";
        $objDiretorio = new diretorio($nomeDiretorioGaleria, $pathDiretorioGaleria);
        $dados["galeria"] = $objDiretorio->lerDiretorio(array("thumb550_", "thumb1200_"));
        $dados["texto"] = $this->lerDocumento($id);

        $dados["urlAction"] = SITE_URL . "/paginas-extras/editar-exe/" . $dados["dadosBanco"]["id"];

        //Carrega visão
        $this->loadView("admin/paginas-extras/cadUpdate", $dados);
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
            "titulo"   => Common::removerCaracteresEspeciais($_POST['titulo']),
            "ativo"    => $_POST['ativo'],
            "texto"    => Common::limpaTagsHtml($_POST['texto']),
            "destaque" => $_POST['destaque'], 
        );

        //Recebendo dados do banco
        $dadosBanco = $this->modelPaginaExtra->getByid($id);           

        //Validando dados
        if (empty($_FILES)) {
            $arrRetorno = $this->modelPaginaExtra->validaForm($_POST, "edicao", $dadosBanco["titulo"]);
        } else {
            $arrRetorno = $this->modelPaginaExtra->validaForm($_POST, "edicaoImagem", $dadosBanco["titulo"]);
        }

        //Se dados forem válidos, realiza cadastro
        if ($arrRetorno["tipo"] == "sucesso") {

            //Escrevendo documento por cima do anterior
            $this->escreverDocumento($_POST["texto"], $id);

            //Gravando imagens no servidor se tiver
            if (!empty($_FILES)) {

                //Diretório Galeria de Imagens
                $nomeDiretorioGaleria = (!empty($dadosBanco["dir_galeria"])) ? $dadosBanco["dir_galeria"] : md5(date('d/m/y h:i:s'));
                $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";

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
                    $objImagem->criarThumb(550, $objImagem->getDirSaveImage() . $nomeUnico, true);

                    //Setando nome de capa
                    $nomeCapa = $nomeUnico;
                }
                //Acrescenta imagens de capa e diretorio no banco se tiver imagem selecionada
                $dataPost["capa"] = $nomeCapa;
                $dataPost["dir_galeria"] = $nomeDiretorioGaleria;
            }

            //Cadastra dados no banco
            $this->modelPaginaExtra->update($dataPost, $id);

            //Apenas cria novo controlador se o usuário editou o titulo
            if($dadosBanco["titulo"] != $dataPost["titulo"]){

                //Acha e Deleta Slug no banco
                $slug = Common::slug($dadosBanco["titulo"]);
                $slug = $this->modelSlug->getBySlug(Common::slugNomeArquivo($slug));
                $this->modelSlug->delete($slug["id"]);

                //Deleta controlador antigo
                $this->deletaControlador($dadosBanco["titulo"]);

                //Cadastra Novo Slug no banco
                $controladorBase = Common::slug("Pagina Detalhes");
                $slug = Common::slug($dataPost["titulo"]);
                $dataPostSlug["slug"] = Common::slugNomeArquivo($slug);
                $dataPostSlug["id_slug"] = $id;
                $this->modelSlug->save($dataPostSlug);

                //Cria arquivo fisico do controlador
                $this->copiaControlador(Common::slug($dataPost["titulo"]), $controladorBase);    

            }              

            //grava log
            $this->modelLog->gravarLog("Editado paginas-extras " . $dataPost['titulo']);

            //Url da notificação
            $url = SITE_URL . "/paginas-extras/editar/" . $id;

            //grava Notificação
            $this->modelNotificacao->gravarNotificacao("Editado paginas-extras no sistema " . $dataPost["titulo"], $url, "all");
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
        $this->modelPaginaExtra->update($dataPost, $id);
    }


    public function ativarRegistro($id, $campoBanco = "ativo")
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("editar")) {
            Common::redir('admin');
        }

        //Recebe atual situação do registro
        $dadosBanco = $this->modelPaginaExtra->getByid($id);

        //Faz a inversão do botão
        $ativo = ($dadosBanco[$campoBanco] == "S") ? "N" : "S";

        //Salva
        $dataPost = array(
            $campoBanco => $ativo,
        );

        //Modifica o registro
        $this->modelPaginaExtra->update($dataPost, $id);
    }

    /**
     * exclui imagem do diretorio
     */
    public function excluirCapaGaleria($dirPathGaleria, $nomeImagem)
    {
        //Criando Objeto diretorio
        $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";
        $objDiretorio = new diretorio($dirPathGaleria, $pathDiretorioGaleria);
        $objDiretorio->removerImagemDir($nomeImagem);
        $objDiretorio->removerImagemDir("thumb550_" . $nomeImagem);
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
        $pathDiretorioGaleria = STATIC_PATH . "/img/paginas-extras";
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
        $dados = $this->modelPaginaExtra->getByid($id);

        //Excluindo fotos
        $this->excluirTodasFotos($dados["dir_galeria"]);

        //Excluindo documento do servidor
        $pathDiretorioDocumento = DOCUMENTOS_PATH . "/paginas-extras";
        $objDiretorio = new diretorio($dados["dir_documento"], $pathDiretorioDocumento);
        $objDiretorio->removerDiretorio($objDiretorio->getPathDiretorioFinal());


        //Se remover linha com sucesso
        if ($this->modelPaginaExtra->delete($id)) {

            //Acha e Deleta Slug no banco
            $slug = Common::slug($dados["titulo"]);
            $slug = $this->modelSlug->getBySlug(Common::slugNomeArquivo($slug));
            $this->modelSlug->delete($slug["id"]);

            //Deleta controlador antigo
            $this->deletaControlador($dados["titulo"]);     

            //grava log
            $this->modelLog->gravarLog("Excluído paginas-extras " . $dados["titulo"] . " - " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído paginas-extras " . $dados["titulo"] . " - " . $dados["id"], "", "all");

            //Retorno usuário
            $retornoUsuario = array(
                "tipoAviso" => "true",
                "mensagem" => "Deletado com sucesso.",
            );
        }

        echo json_encode($retornoUsuario); 
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
