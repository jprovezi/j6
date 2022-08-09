<?php

/**
 * Controlador index da aplicação
 *
 * @author João Provezi
 */
class Admin extends Controller{
        
    public function __construct() {
        
        //Inicia o construtor do pai da classe
        parent::__construct();
        
        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();//Destroi a sessão do usuário
            Common::redir('login');
        }
        
    }

    public function main() {
        $this->dashboard();
    }

    public function logout(){
        Session::destroy();
        $this->objModelLog->gravarLog("Realizado logout no sistema");
        Common::redir('login');
    }

    public function dashboard(){
        $dados["usuario"] = $this->objModelUsuario->getByid(Session::get("idUsuario"));
        $dados["menu"] = $this->objModelMenu->getMenuSistema();
        $dados["notificacoes"] = $this->objModelNotificacao->getAll(array("where" => "", "orderBy" => "id DESC", "limit" => "6", "offset" => ""));
        $dados["totalNotificacoesNaoLidas"] = $this->objModelNotificacao->totalNotificacoesNaoLidas($dados["notificacoes"]);

        $this->loadView("admin/dashboard/dashboard",$dados);
    }
    
    public function login(){
        //Redireciona o usuário para a index
        Common::redir('login');
    }
    
         
}
