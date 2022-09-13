<?php
header("Content-type: text/html; charset=utf-8");
/* 
 * Constantes de configuração do framework
 */


//BANCO DE DADOS
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'j6');
define('DB_USER', 'root');
define('DB_PASS', '');

//URLS DO SISTEMA
define('SITE_DESENVOLVEDORA','http://local.j6.net.br');
define('SITE_URL','http://local.j6.net.br');
define('STATIC_URL',SITE_URL.'/static');
define('IMG_URL',SITE_URL.'/static/img');
define('TEMPLATE_CHARLES', STATIC_URL."/templates/charles");
define('TEMPLATE_HEXZY', STATIC_URL."/templates/hexzy/assets");
define('TEMPLATE_MONIZ', STATIC_URL."/templates/moniz/assets");
define('TEMPLATE_INOVEX', STATIC_URL."/templates/inovex/assets");


//URLS FIXAS DAS PASTAS DO SISTEMA
define('SITE_PATH',  realpath(dirname(__FILE__)).'/');
define('STATIC_PATH',  realpath(dirname(__FILE__)).'/static');
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/application/controllers'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/application/views'));
define('MODEL_PATH', realpath(dirname(__FILE__) . '/application/models'));
define('VENDOR_PATH', realpath(dirname(__FILE__) . '/system/vendor'));

//DADOS DE SMTP
define('EMAIL_HOST','smtplw.com.br');
define('EMAIL_PORT',587);
define('EMAIL_SEGURANCA','tls');
define('EMAIL_USERNAME','qportais01');
define('EMAIL_PASSWORD','SWGswigW8265');

//DADOS DO SISTEMA
date_default_timezone_set('America/Sao_Paulo');
define('TITULO_FRAMEWORK','J6 Soluções Digitais');

//ERROR REPORTER PHP
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ERROR);






