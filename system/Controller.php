<?php

/**
 * Controlador base, ele será estentido por todos os controladores da aplicação
 *
 * @author João
 * @access public
 */
class Controller {
    
    protected $session;
    
    /**
     * Método construtor
     * @access public
     * @return void
     */
    public function __construct() {
        //Inicializa a sessão
        Session::inicializar();
    }
    
    /**
     * Carrega um arquivo de view
     * @access public
     * @param String $nome Nome da view a ser carregada
     * @param Array $vars Array de dados a serem enviados para a view
     * @return Void
     */
    protected function loadView( $nome, $vars = null ){
        
        //Exporta os dados do array para variáveis dinâmicas
        if(is_array($vars) && count($vars) > 0 ){
            //extrai as variáveis
            extract($vars, EXTR_PREFIX_SAME, 'data');
        }
        
        //Caminho para o arquivo chamado da view
        $arquivo = VIEW_PATH . '/' . $nome . '.phtml';
        
        //exit(var_dump($arquivo));
        
        //Verificando se o arquivo existe no server
        if( !file_exists($arquivo) ){
            //lançando exeção se arquivo não existir
            $this->error("Houve um erro. Essa View {$nome} não existe");
        }
        
        //include o arquivo
        require_once($arquivo);
        
    }
    
    /**
     * Carrega um modelo
     * @access public
     * @param String $nome Nome do modelo a ser carregado
     * @return Void
     */
    protected function loadModel($nome){
        
        //Caminho do arquivo do modelo no server
        $arquivo = MODEL_PATH . '/' . $nome . '.php';
        
        //verificando se o arquivo existe
        if( !file_exists($arquivo) ){
            //dispara o erro
            $this->error("Houve um erro. Esse Modelo <strong>{$nome}</strong> nao existe");
        }
        
        //inclui o arquivo do modelo
        require_once($arquivo);
        
        //nome da classe do modelo
        $classe_nome = ucfirst($nome);
        
        //Verificando se a classe realmente existe
        if( class_exists($classe_nome) ){
            
            //Cria dinamicamente uma propriedade com a instância desse modelo (objeto)
            $this->$classe_nome = new $classe_nome;

        }else{
            //Erro para classe inexistente
            $this->error("A classe {$classe_nome} não foi encontrada no modelo {$nome}");
        }
        
    }
    
    /**
     * Dispara um erro
     * @access protected
     * @param String $msg
     * @throws Exception
     * @return Void
     */
    protected function error($msg){
        throw new Exception($msg);
    }
    
}
