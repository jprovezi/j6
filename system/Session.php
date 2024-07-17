<?php

/**
 * Classe para trabalhar com dados de sessão
 *
 * @author João
 * @access public
 */
class Session {
    
    /**
     * Inicializa a sessão
     * @access public
     * @return void
     */
    public static function inicializar(){
        session_start();
        session_regenerate_id();
    }
    
    /**
     * Grava uma informação na sessão
     * @access public
     * @param String $key
     * @param String $value
     * @return void
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    /**
     * Retorna um dado de sessão
     * @param String $key
     */
    public static function get($key){
        if( isset($_SESSION[$key]) ){
            return $_SESSION[$key];
        }
    }
    
    /**
     * Retorna a chave da sessão e deleta o mesmo
     * @param string $key
     * @return array
     */
    public static function getAndDelete($key){
        if( isset($_SESSION[$key]) ){
            return $_SESSION[$key];
            self::delete($key);
        }
    }
    
    /**
     * Deleta um dado de sessão
     * @param String $key
     * @return Void
     */
    public static function delete($key){
        unset($_SESSION[$key]);
    }

        /**
     * Destroi todos os dados da sessão aberta
     * @access public
     * @return void
     */
    public static function destroy(){
        session_destroy();
    }
    
}
