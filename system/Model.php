<?php

/**
 * Modelo base para os modelos da aplicação
 *
 * @author João
 * @access public
 */
class Model {
    
    public $db;
    protected static $dbInstance;
            
    function __construct() {
        //Cria na propriedade 'db' o o objeto da classe Database
       $this->db = $this->getDb();
    }
    
    protected function getDb(){
        if(!self::$dbInstance){
            
            self::$dbInstance = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }
        
        return self::$dbInstance;
    }


}
