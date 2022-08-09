<?php

/**
 * Classe para trabalhar com o banco de dados usando PDO
 * trabalhando em cima da CRUD (Creat Read Update Delete)
 *
 * @author João
 * @access public
 */
class Database extends PDO{
    
    /**
     * Inicializa a conexão com o banco de dados
     * @param String $DB_TYPE
     * @param String $DB_HOST
     * @param String $DB_NAME
     * @param String $DB_USER
     * @param String $DB_PASS
     * @return Void
     */
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASS);
    }
    
    
    /**
     * Select no banco de dados
     * @access public
     * @param String $sql Comando SQL
     * @param Array $array Filtragem de dados a serem retornados
     * @param Boolean $all Usar fetchAll() ou apenas fetch()
     * @param variant $fetchMode Define o tipo de retorno, por padrão é um array associativo
     * @return Array
     */
    public function select( $sql, $array = array(), $all = TRUE, $fetchMode = PDO::FETCH_ASSOC ){
        
        //prepara a query
        $sth = $this->prepare($sql);
        
        //Define os dados do Where, se existirem
        if(!empty($array)){
            foreach( $array as $key => $value ){
                //Filtra os dados se for um int como PARAM_INT, se nao usa o PARAM_STR
                $tipo = (is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;

                //definindo os dados
                $sth->bindValue("$key", $value, $tipo);
            }
        }
        
        //Executa
        $sth->execute();
        
        //Verificando se é para retornar uma matriz de dados ou apenas uma linha
        if($all){
            //retorna coleção de dados
            return $sth->fetchAll($fetchMode);
        }else{
            //retorna apenas uma linha
            return $sth->fetch($fetchMode);
        }
        
    }
    
    /**
     * Insere um dado no banco de dados
     * @access public
     * @param String $table Nome da tabela
     * @param Array $data Campos e seus respectivos valores
     * @return Integer
     */
    public function insert($table, $data){
        
        //Ordena
        ksort($data);
        
        //Campos e valores
        $camposNomes = implode('`, `', array_keys($data));
        $camposValores = ':' . implode(', :', array_keys($data));
        
        //Prepara a Query
        $sth = $this->prepare("INSERT INTO $table (`$camposNomes`) VALUES ($camposValores)");
        
        //Define o dado
        foreach( $data as $key => $value ){
            //Filtra os dados se for um int como PARAM_INT, se nao usa o PARAM_STR
            $tipo = (is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            
            //definindo os dados
            $sth->bindValue(":$key", $value, $tipo);
        }
        
        //Executa
        $sth->execute();
        
        //Retorna o ID desse item inserido
        return $this->lastInsertId();
        
    }
    
    /**
     * Atualiza um dado no banco de dados
     * @access public
     * @param String $table Nome da tabela
     * @param Array $data Campos e seus respectivos valores
     * @param String $where Condição de atualização
     * @return Boolean
     */
    public function update( $table, $data, $where ){
        
        //Ordena
        ksort($data);
        
        //Define os dados que serão atualizados
        $novosDados = NULL;
        
        foreach( $data as $key => $value ){
            $novosDados .= "`$key`=:$key,";
        }
        
        $novosDados = rtrim($novosDados, ',');
        
        //Prepara a Query
        $sth = $this->prepare("UPDATE $table SET $novosDados WHERE $where");
        
        //Define os dados
        foreach( $data as $key => $value ){
            //Se o tipo do dado for inteiro, usa o PDO::PARAM_INT, se nao for usa a const de string PARAM_STR
            $tipo = (is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
            
            //Define o dado
            $sth->bindValue(":$key", $value, $tipo);
        }
        
        //Retorna sucesso ou falha
        return $sth->execute();
        
    }
    
    /**
     * Deleta um dado da tabela
     * @access public
     * @param String $table Nome da tabela
     * @param String $where Condição de atualização
     * @return Integer
     */
    public function delete( $table, $where){
        //Deleta
        return $this->exec("DELETE FROM $table WHERE $where");
    }
    
}
