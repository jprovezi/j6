<?php

require_once VENDOR_PATH . "/PHPMailer/src/class.phpmailer.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author Joao Provezi
 */
class Contato extends Controller {

    public $email;
    public $modelContato;

    public function __construct() {

        parent::__construct();

        //Criando objetos modelos
        $this->loadModel("leads");
        $this->modelContato = $this->Contatos;    

        //Criando objeto de envio de email
        $this->email = new PHPMailer();
        $this->email->setLanguage('br');
        $this->email->CharSet='UTF-8';
        $this->email->isSMTP();
        $this->email->Host = EMAIL_HOST;
        $this->email->SMTPAuth = true;
        $this->email->Username = EMAIL_USERNAME;
        $this->email->Password = EMAIL_PASSWORD;
        $this->email->SMTPSecure = EMAIL_SEGURANCA;
        $this->email->Port = EMAIL_PORT;
        $this->email->From = 'nao-responder@querosite.digital'; //Endereço previamente verificado no painel do SMTP
        $this->email->FromName = "Informação do site : ".TITULO_FRAMEWORK; // Nome no remetente
        $this->email->addAddress('jprovezi@gmail.com', 'João Provezi');// Acrescente um destinatário
        //$this->email->addReplyTo('jprovezi@gmail.com', 'Qportais Comunicação');        
        
        
    }

    public function main() {
        $this->contato();
    }

    public function contato(){
        $config = $this->objModelConfig->getByid(1);
        $this->loadview("templates/{$config['template']}/contato");
    }

    public function contatoForm() {
        
        //criando corpo do email
        if (!empty($_POST)) {

            //Gravando dados no banco
            $data = array(
                "nome" => $_POST["name"],
                "email" => $_POST["email"],
                "telefone" => $_POST["phone"],
                "mensagem" => $_POST["message"],
            );
            $this->modelContato->cadastrar($data);

            $corpoEmail = "Nome: " . $data["nome"] . "<br>";
            $corpoEmail = $corpoEmail . "Email: " . $data["email"] . "<br>";
            $corpoEmail = $corpoEmail . "Telefone: " . $data["telefone"] . "<br>";
            $corpoEmail = $corpoEmail . "Mensagem: " . $data["mensagem"] . "<br>";
        } else {
            $corpoEmail = "Nenhuma informação vinda do formulário";
        }


            try {
                
                // Configura o formato do email como HTML
                $this->email->isHTML(true);

                $this->email->Subject = 'Contato vindo do site '.TITULO_FRAMEWORK;
                $this->email->Body    = $corpoEmail;

                //Enviando Email
                $this->email->Send();
                echo"ok";
                exit;
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
            }
    }
    
}
