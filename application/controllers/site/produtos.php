<?php

class Produtos extends Controller {

    public function __construct() {

        parent::__construct();
        
    }

    public function main() {
        $dados["nomeControlador"] = "produtos"; //servicos ou produtos {enviar uma das duas strings}
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/listagem-itens",$dados);
    }

    public function detalhes($idString = ""){
        $dados["nomeControlador"] = "produtos"; //servicos ou produtos {enviar uma das duas strings}
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/itens-detalhes",$dados);
    }
    
  
    
}
