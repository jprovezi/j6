<?php
/**
 * Recupera o erro da exceção do PHP e informa na tela de view
 * error/erro
 *
 * @author João
 */
class Notfound extends Controller{
    
    
    public function __construct() {
        
        parent::__construct();
        
        //Abre a view erro e envia para ela a mensagem do erro
        $config = $this->objModelConfig->getByid(1);

        $this->loadView("templates/{$config['template']}/404");
        
    }
    
}
