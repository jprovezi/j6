<?php

class Login extends Controller{

    private $modelLog;
    private $modelUsuario;
    private $modelPerfil;
    private $modelMenu;
    private $modelConfigSistema;

    
    public function __construct() {
        parent::__construct();
        
        //Verificando se usuário já está logado
        if( Session::get('logado') ){
            Common::redir('admin/dashboard');
        }

        
        //Instanciando modelos
        $this->loadModel('log');
        $this->loadModel('usuario');
        $this->loadModel('perfil');
        $this->loadModel('menu');
        $this->loadModel('configuracao');
        $this->modelLog = new Log();
        $this->modelUsuario = new Usuario();
        $this->modelPerfil = new Perfil();
        $this->modelMenu = new Menu();
        $this->modelConfigSistema = new Configuracao();        
        
    }
    
    public function main(){
        $dados["configuracoes"] = $this->modelConfigSistema->getConfigSistema();
        $this->loadView("admin/login/index",$dados);
    }

    public function esqueceuSenha(){
        $dados["configuracoes"] = $this->modelConfigSistema->getConfigSistema();
        $this->loadView('admin/login/esqueceu-senha',$dados);
    }
    

    /**
     * Processa a requisição de autentificação do usuário para logar no sistema
     */
    public function processar(){
        
        //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Headers: Content-Type");

        //Verificando usuário e senha
        $logar = $this->modelUsuario->validaUsuario($_POST['user'], $_POST['pass']);

        if( empty($logar) ){

            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "error", //sucess - warning - danger
                "url" => "", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Usuário ou senha incorreta",
            );
            echo json_encode($retornoUsuario);
            
        }else{

            //Recebendo dados do banco para consistência do sistema
            $dadosUsuario = $this->modelUsuario->getByid($logar["id"]);
            $dadosPerfil = $this->modelPerfil->getAllModulos(array("where" => "id_perfil_sistema = {$dadosUsuario["id_perfil"]}"));
            $dadosMenu = $this->modelMenu->getMenuSistema();
            $dadosConfig = $this->modelConfigSistema->getConfigSistema();
            
                        
            //Criando sessões necessárias
            Session::set('logado', TRUE);
            Session::set("dadosUsuario", $dadosUsuario);
            Session::set("id_usuario", $dadosUsuario["id"]);
            Session::set("dadosPerfil", $dadosPerfil);
            Session::set("menu", $dadosMenu);
            Session::set("config",$dadosConfig);
            
            //Gravando log
            $this->modelLog->gravarLog("login no sistema {$_POST['user']}");

            sleep(2);
            
            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "sucesso", //sucess - warning - danger
                "acaoForm" => "redir",
                "url" => SITE_URL."/admin", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Sucesso, redirecionando...",
            );
            echo json_encode($retornoUsuario);
            
        }
        
    }

    public function processarEsqueceuSenha(){

        //Verificando usuário e senha
        $dadosUser = $this->modelUsuario->lembrarSenha($_POST['user']);

        if( empty($dadosUser) ){

            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "error", //sucess - warning - danger
                "url" => "", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Esse email de usuário não existe",
            );
            echo json_encode($retornoUsuario);
            
        }else{


            //Criando nova senha
            $novaSenha = Common::gerarSenha(6);

            //Colocando no padrao para salvar no banco
            $dataPost = array(
                "senha" => md5($novaSenha),
            );

            //Montando corpo do email
            $corpoEmail = "Olá <strong>{$dadosUser['nome']}</strong>, segue abaixo a sua nova senha de acesso ao sistema!<br><br>
            <strong style='font-size:20px;'>$novaSenha</strong><br><br>
            <a href='".SITE_URL."/admin'>Clique aqui para acessar o sistema</a>";

            //Salvando nova senha para o usuario logado
            $this->modelUsuario->update($dataPost,$dadosUser["id"]);

            Common::enviarEmail($_POST['user'],$dadosUser["nome"],array(),"Recuperação de Senha ".TITULO_FRAMEWORK,$corpoEmail);
            
            //Retorno cliente
            $retornoUsuario = array(
                "tipo" => "sucesso", //sucess - warning - danger
                "url" => "", //Se URL estiver preenchida ele redireciona
                "mensagem" => "Enviado para o seu email a sua nova senha de acesso",
            );
            echo json_encode($retornoUsuario);
            
        }
        
    }
    
    
    
}
