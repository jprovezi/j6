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
        
        //Configurações
        $config = $this->objModelConfig->getByid(1);

        //SEO
        $dados["seo"] = $this->objModelSeo->getByid(2);

        $this->loadView("templates/{$config['template']}/404", $dados);
        exit;
        
    }
    
}
