<?php

class Leads extends Controller
{

    private $modelLog;
    private $modelNotificacao;
    private $modelUsuario;
    private $modelPerfil;
    private $modelLeads;

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
        $this->loadModel('lead');

        //Cria as classes de modelo
        $this->modelLog = new Log();
        $this->modelNotificacao = new Notificacoes();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelLeads = new Lead();

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
                "nome" => "Leads",
                "url" => SITE_URL . "/leads",
            ),
        );

        //Notificações
        $dados["notificacoes"] = $this->modelNotificacao->getNotificacoes();
        $dados["totalNotificacoesNaoLidas"] = $this->modelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);


        //Perfil do usuário
        $dados["excluir"] = $this->modelPerfil->verificaPerfil("excluir");

        //Carregando dados banco
        $dados["listagem"] = $this->modelLeads->getAll();

        //Carregando a view
        $this->loadView("admin/leads/main", $dados);
    }



    /**
     * Ativa ou Desativa um registro no banco
     *
     * @param [int] $id
     * @return void
     */
    public function ativarRegistro($id)
    {

        //Verifica se usuário tem permissão de usar o módulo
        if (!$this->modelPerfil->verificaPerfil("excluir")) {
            Common::redir('admin');
        }

        //Recebe atual situação do registro
        $lead = $this->modelLeads->getByid($id);

        //Faz a inversão do botão
        $ativo = ($lead["respondido"] == "S") ? "N" : "S";

        //Salva
        $dataPost = array(
            "respondido" => $ativo,
        );

        //Modifica o registro
        $this->modelLeads->update($dataPost, $id);
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
        $dados = $this->modelLeads->getByid($id);


        //Se remover linha com sucesso
        if ($this->modelLeads->delete($id)) {

            //grava log
            $this->modelLog->gravarLog("Excluído Lead Contato " . $dados["nome"] . " - " . $dados["id"]);

            //Notificação
            $this->modelNotificacao->gravarNotificacao("Excluído Lead contato " . $dados["nome"] . " - " . $dados["id"], "", "all");

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
        $dadosBanco = $this->modelLeads->getByid($id);

        //Lendo diretório da galeria de imagens
        $arrGaleria = "";

        //Montando texto do lead
        $texto = "<strong>Nome: </strong>{$dadosBanco["nome"]}<br>";
        $texto .= "<strong>Email: </strong>{$dadosBanco["email"]}<br>";
        $texto .= "<strong>Telefone: </strong>{$dadosBanco["telefone"]}<br>";
        $texto .= "<strong>Assunto: </strong>{$dadosBanco["assunto"]}<br>";
        $texto .= "<strong>Mensagem: </strong>".nl2br($dadosBanco["mensagem"])."<br>";

        $arrRetorno = array(
            "titulo"    => "Recebido em ".Common::converteTimestamp($dadosBanco['data']),
            "documento" => $texto,
            "editar"    => SITE_URL . "/leads",
            "galeria"   => $arrGaleria,
        );

        //retorno para o usuario
        echo json_encode($arrRetorno);
    }
}
