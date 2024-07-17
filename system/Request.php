<?php

/**
 * Classe responsável por obter os segmentos da URL informada
 *
 * @author João
 * @access public
 */
class Request {
    
    private $_controlador = "index";
    private $_metodo      = "main";
    private $_args        = array();
    
    public function __construct() {
        
        //verifica se algum controlador foi informado na URL se nao foi,
        //ele manter o contrador index
        if( !isset($_SERVER["REQUEST_URI"]) ) return false;
        
        //explode os segmentos da URL e os armazena em um array
        $segmentos = explode('/',$_SERVER["REQUEST_URI"]);
        
        //Remove string vazia do array
        unset($segmentos[0]);  
        
        //se o controlador foi realmente definido, retorna o nome dele.
        $this->_controlador = ( $c = str_replace("-", "", array_shift($segmentos)) ) ? $c : 'index';
        
        //Se um método foi realmente requisitado, retorna o nome do metodo
        $this->_metodo = ($m = str_replace("-", "", array_shift($segmentos)) ) ? $m : 'main';
        
        //Se argumentos adicionais foram definidos, os retorna em um array
        $this->_args = (isset($segmentos[0])) ? $segmentos : array();
        
    }
    
    /**
     * Retorna o nome do controlador
     * @access public
     * @return String
     */
    public function get_controlador() {
        return $this->_controlador;
    }

    /**
     * Retorna o nome do método
     * @access public
     * @return String
     */
    public function get_metodo() {
        return $this->_metodo;
    }

    /**
     * Retorna um array contendo os argumentos adicionais
     * @access public
     */
    public function get_args() {
        return $this->_args;
    }


    
}
