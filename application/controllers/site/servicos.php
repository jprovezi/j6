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
class Servicos extends Controller {

    
    public function __construct() {
        
    }

    public function main() {
        $config = $this->objModelConfig->getByid(1);
        $dados["nomeControlador"] = "servicos"; //servicos ou produtos {enviar uma das duas strings}
        $this->loadView("templates/{$config['template']}/listagem-itens",$dados);
    }

    public function detalhes($idString = ""){
        $dados["nomeControlador"] = "servicos"; //servicos ou produtos {enviar uma das duas strings}
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/itens-detalhes",$dados);
    }
    
  
    
}
