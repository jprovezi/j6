<?php

//config da aplicacao
require_once('./config.php');

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