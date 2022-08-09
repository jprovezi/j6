<?php

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
class Clientes extends Controller {

    
    public function __construct() {

        parent::__construct();
        
    }

    public function main() {
        //Dados de configuração
        $config = $this->objModelConfig->getByid(1);        
        $dados["nomeControlador"] = "clientes";
        $this->loadView("templates/{$config['template']}/clientes-parceiros",$dados);
    }    

}
