<?php
/**
 * Controlador responsável pela autenticação do usuário no sistema
 *
 * @author João
 */
class Login extends Controller{
    
    public function __construct() {
        parent::__construct();
        
        //Verificando se usuário já está logado
        if( Session::get('logado') ){
            Common::redir('admin/dashboard');
        }
        
    }
    
    /**
     * Método main, carrega a tela de visão do login
     */
    public function main(){
        $this->loadView("admin/login/index");
    }
    

    /**
     * Processa a requisição de autentificação do usuário para logar no sistema
     */
    public function processar(){
        
        //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Headers: Content-Type");

        //Verificando usuário e senha
        $logar = $this->objModelUsuario->validaUsuario($_POST['user'], $_POST['pass']);

        if( empty($logar) ){

            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "warning", //sucess - warning - danger
                "url" => "", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Usuário ou senha incorreta",
            );
            echo json_encode($retornoUsuario);
            
        }else{
                        
            //Criando sessões necessárias
            Session::set('logado', TRUE);
            Session::set("idUsuario", $logar["id"]);
            
            //Gravando log
            $this->objModelLog->gravarLog("login no sistema {$_POST['user']}");

            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "sucess", //sucess - warning - danger
                "url" => SITE_URL."/admin", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Sucesso, redirecionando...",
            );
            echo json_encode($retornoUsuario);
            
        }
        
    }
    
    
    
}
