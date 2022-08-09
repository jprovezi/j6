<?php

class ProdutosLista extends Controller {

    public function __construct() {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();
            Common::redir('login');
        }           
    }

    public function main() {
        $dados["usuario"] = $this->objModelUsuario->getByid(Session::get("idUsuario"));
        $dados["menu"] = $this->objModelMenu->getMenuSistema();
        $dados["notificacoes"] = $this->objModelNotificacao->getAll(array("where" => "", "orderBy" => "id DESC", "limit" => "6", "offset" => ""));
        $dados["totalNotificacoesNaoLidas"] = $this->objModelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        $this->loadView("admin/dashboard/dashboard",$dados);
    }

}
