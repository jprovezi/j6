<?php
            class fazendobiscoitos extends Controller {
            
                protected $crud;
            
                public function __construct() {
                    parent::__construct();
                    $this->loadModel('crud');
                    $this->crud = new Crud();
                }
            
                public function main() {
                    $this->crud->setTabela('single_url');
                    $dados = $this->crud->getByControlador(Common::getControlador());
                    $this->crud->setTabela($dados['tabela']);
                    $arrDados['single'] = $this->crud->getByid($dados['id_busca']);
                    $config = $this->objModelConfig->getByid(1);
                    $this->loadView("templates/{$config['template']}/".$dados['view'],$arrDados);
                }
            }
            