<?php

/**
 * Roteador. Responsável por incluir o controlador e executar o seu respectivo
 * método informado
 **/
class Router {
    
    public static function run(Request $request){
        
        //obtendo os parametros da URL
        $controlador = $request->get_controlador();
        $metodo      = $request->get_metodo();
        $args        = $request->get_args();
        
        //Monta o caminho do controlador para inclusão
        $arquivo = CONTROLLER_PATH . '/admin/' . $controlador . '.php';

        //Se não encontrar o arquivo procura nos controladores single
        if(!file_exists($arquivo)){
            $arquivo = CONTROLLER_PATH . '/site/' . $controlador . '.php';
        }
        
        //verificando se o controlador existe
        if(file_exists($arquivo) ){
            
            //require do controlador
            require_once($arquivo);
            
            //Instancia o controlador para que o método main ou outro seja executado
            if(class_exists($controlador) ){
                $controlador = new $controlador();
            }else{
                //encontrou o arquivo do controlador mas o nome da classe nao existe
                self::error("Classe - A classe <strong>".$controlador."</strong> não foi encontrada!");
            }
                        
            //verificando se metodo da URL existe, se sim useo se nao dispara um erro no framework
            if( !is_callable(array($controlador, $metodo)) ){
                self::error("Método - O método <strong>".$request->get_metodo()."</strong> não foi encontrado!");
            }
            
            //verificando se foi passado parametros adicionais
            if(!empty($args)){
                //chama o método passado para ele os argumentos adicionais
                call_user_func_array(array($controlador, $metodo),$args);
            }else{
                call_user_func(array($controlador,$metodo));
            }
            
        }else{
            
            //Controlador não encontrado, lança a exceção
            Common::redir();
        }
        
    }
    
    /**
     * @method $msg string
     */
    protected static function error($msg){
        throw new Exception($msg);
    }
    
}