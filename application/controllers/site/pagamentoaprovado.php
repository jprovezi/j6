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
class PagamentoAprovado extends Controller {

    
    public function __construct() {
        parent::__construct();
    }

    public function link($nomeUrl, $valor = "") {
        $dados["nomeURL"] = $nomeUrl;
        $dados["valor"] = $valor;
        $config = $this->objModelConfig->getByid(1);
        $this->loadView("templates/{$config['template']}/pagamentoaprovado",$dados);
    }
  
    
}
