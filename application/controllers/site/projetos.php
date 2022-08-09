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
class Projetos extends Controller {

    
    public function __construct() {

        parent::__construct();
        
    }

    public function main() {
        $dados["nomeControlador"] = "projetos";
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/listagem-itens",$dados);
    }

    public function detalhes($idString = ""){
        $dados["nomeControlador"] = "projetos";
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/itens-detalhes-2",$dados);
    }
    

}
