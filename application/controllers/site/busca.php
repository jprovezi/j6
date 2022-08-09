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
class Busca extends Controller {

    
    public function __construct() {

        parent::__construct();
        
    }

    public function main() {
        $this->detalhes();
    }

    public function detalhes($idString = ""){
        //Dados de configuração
        $config = $this->objModelConfig->getByid(1);        
        $dados["row"] = array();
        $this->loadView("templates/{$config['template']}}/busca-site",$dados);
    }
    

}
