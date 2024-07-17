<?php

class Api extends Controller{

    private $modelNotificacoes;

    public function __construct(){
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if (!Session::get("logado")) {
            Session::destroy();
            exit;
        }
        $this->loadModel("notificacoes");
        $this->modelNotificacoes = new Notificacoes();
    }

    public function main(){
    }



    public function abrirNotificacao($id){

        $this->modelNotificacoes->update(array("aberta" => "S"), $id);
        $notificacoes = $this->modelNotificacoes->getAll(array("where" => "", "orderBy" => "id DESC", "limit" => "6", "offset" => ""));
        $totalNotificacoesNaoLidas = $this->modelNotificacoes->totalNotificacoesNaoLidas($notificacoes);
        $arrRetorno = array("totalNotificacoes" => $totalNotificacoesNaoLidas);
        echo json_encode($arrRetorno);
    }

    /**
     * Retorna a hora do servidor
     * @return json
     */
    public function horaServer(){
        $arrRetorno["hora"] = date("H:i:s");
        echo json_encode($arrRetorno);
        exit;
    }
}
