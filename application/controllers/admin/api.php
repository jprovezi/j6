<?php

require_once VENDOR_PATH . "/PHPMailer/src/class.phpmailer.php";

class Api extends Controller {

    private $crud;
    
    public function __construct() {
        parent::__construct();

        //Verifica se usuário está autenticado no sistema
        if( !Session::get("logado") ){
            Session::destroy();
            exit;
        }
        $this->loadModel("crud");
        $this->crud = new Crud();
    }

    public function main() {
        
    }

    public function abrirNotificacao($id){
        
        $this->objModelNotificacao->atualizar(array("aberta"=>"S"),$id);
        $notificacoes = $this->objModelNotificacao->getAll(array("where" => "", "orderBy" => "id DESC", "limit" => "6", "offset" => ""));
        $totalNotificacoesNaoLidas = $this->objModelNotificacao->totalNotificacoesNaoLidas($notificacoes);
        $arrRetorno = array("totalNotificacoes"=>$totalNotificacoesNaoLidas);
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
    
    public function envioForm(){
        
        //Criando objeto de envio de email
        $objEmail = new PHPMailer();
        $objEmail->setLanguage('br');
        $objEmail->CharSet='UTF-8';
        $objEmail->isSMTP();
        $objEmail->Host = EMAIL_HOST;
        $objEmail->SMTPAuth = true;
        $objEmail->Username = EMAIL_USERNAME;
        $objEmail->Password = EMAIL_PASSWORD;
        $objEmail->SMTPSecure = 'tls';
        $objEmail->Port = EMAIL_PORT;
        $objEmail->From = $_POST["serverAutenticacao"]; // Endereço previamente verificado no painel do SMTP
        $objEmail->FromName = $_POST["serverFromName"];// Nome no remetente
        $objEmail->addAddress('joao@agenciaqportais.com.br', 'João Provezi');// Acrescente um destinatário
        
 
    }

    public function gerarControladorSingle(){
        $this->crud->setTabela("single_url");
        $controladoresSingle = $this->crud->getAll();

        foreach($controladoresSingle as $valor){

            $conteudo = "<?php
            class ".$valor["controlador"]." extends Controller {
            
                protected \$crud;
            
                public function __construct() {
                    parent::__construct();
                    \$this->loadModel('crud');
                    \$this->crud = new Crud();
                }
            
                public function main() {
                    \$this->crud->setTabela('single_url');
                    \$dados = \$this->crud->getByControlador(Common::getControlador());
                    \$this->crud->setTabela(\$dados['tabela']);
                    \$arrDados['single'] = \$this->crud->getByid(\$dados['id_busca']);
                    \$this->loadView('templates/charles/'.\$dados['view'],\$arrDados);
                }
            }
            ";

            $caminhoArquivo = CONTROLLER_PATH.'/site/'.$valor["controlador"].'.php';
            $arquivo = fopen($caminhoArquivo, 'w');
            fwrite($arquivo, $conteudo);
            fclose($arquivo);

        }

    }
    
}
