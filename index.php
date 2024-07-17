<?php

//config da aplicacao
require_once('./config.php');

//Carregando classes do vendor
require_once VENDOR_PATH . "/PHPMailer/src/PHPMailer.php";
require_once VENDOR_PATH . "/PHPMailer/src/SMTP.php";
require_once VENDOR_PATH . "/PHPMailer/src/Exception.php";
include_once VENDOR_PATH."/imagem.php";
include_once VENDOR_PATH."/diretorio.php";

//carregamento automatico das classes PHP
spl_autoload_register(function ($classe){
    $arquivo = SITE_PATH . 'system/' . $classe . '.php';
    require_once($arquivo);
});


//Acionando o router que escolher qual controlador adicionar
try{
    //Executa o roteador
    Router::run(new Request());
} catch (Exception $ex) {
    //Verificando exec. lancadas pelo roteador
    new notfoud($ex->getMessage());
}