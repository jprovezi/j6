<?php

/**
 * Funções comuns do framework
 *
 * @author João
 * @access public
 */
class Common {
    
    private function __construct() {
        //Construtor privado, classe nao pode ser instanciada
    }

    /**
     * Verifica se a imagem existe no servidor, se não existir retorna um caminho de imagem default
     * @path pasta/nomefoto.jpg
     * $catImg 'default' - 'user'
     */
    public static function getImg($path, $catImg = "default"){

        if(file_exists( STATIC_PATH."/img/".$path )){
            return IMG_URL."/".$path;
        }else{
            if($catImg == "default"){
                return IMG_URL."/1-notfounds/default.jpg";
            }else if($catImg == "user"){
                return IMG_URL."/1-notfounds/user.jpg";
            }
        }
    }
    
    /**
     * Retorna em dias a diferença entre duas datas
     * @param string $data_inicio 2016-07-10
     * @param string $data_fim 2017-07-10
     * @return string
     */
    public static function diferencaData($data_inicio, $data_fim){
        $data_inicio = new DateTime($data_inicio);
        $data_fim = new DateTime($data_fim);

        // Resgata diferença entre as datas
        $dateInterval = $data_inicio->diff($data_fim);
        if($data_inicio < $data_fim){
            return "-".$dateInterval->days;
        }else{
            return "".$dateInterval->days;
        }
        
    }
    
    
    /**
     * 
     * @param 1.500,25 $num
     * @return string retorna R$100.000,50
     */
    public static function moedaValorReal($num){
        return number_format($num, 2, ',', '.');        
    }
    /**
     * 
     * @param 1.500,25 $num
     * @return string retorna R$100.000,50
     */
    public static function moedaValorBanco($num){
        return number_format(str_replace(",",".",str_replace(".","",$num)), 2, '.', '');      
    }
    
    
    /**
     * Valida se o dado está em branco
     * @access public
     * @param String $dado
     * @return Boolean
     */
    public static function validarEmBranco($dado){
        return empty($dado);
    }
    
    /**
    * Valida um e-mail.
    * @access public
    * @param String $email E-mail.
    * @return Boolean
    */
    public static function validarEmail($email)
    {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }
    
    /**
     * Válida o número mínimo de caracteres
     * @param string $string
     * @param int $numeroCaracteres
     * @return Boolean
     */
    public static function validarMinimo($string, $numeroCaracteres){
        return strlen($string) < $numeroCaracteres;
    }
    
    /**
     * Verifica o número máximo de caracteres
     * @param string $string
     * @param int $numeroCaracteres
     * @return type
     */
    public static function validarMaximo($string, $numeroCaracteres){
        return strlen($string) > $numeroCaracteres;
    }
    
    /**
     * Se campo1 for iguao a campo2 retorna verdadeiro
     * @param string $campo1
     * @param string $campo2
     * @return Bool
     */
    public static function validarCamposIguais($campo1, $campo2){
        return $campo1 == $campo2;
    }
    
    /**
     * Redireciona uma url
     * @access public
     * @param String $url URL a ser requisitada
     * return void
     */
    public static function redir($url = ""){
        header('location: ' . SITE_URL . '/' . $url);
        exit;
    }
    
    /**
     * Retorna um array com a soma e o resultado de dois numeros aleatorios de 1 a 9
     * @return array
     */
    public static function getNotRobot(){
        $numero1 = rand(1, 9);
        $numero2 = rand(1, 9);
        $resultado = $numero1+$numero2;
        
        return array(
            "somaUsuario" => $numero1."+".$numero2,
            "resultado" => $numero1+$numero2
        );
    }
        

    /**
     * Retorna a URL completa do sistema
     * @return string
     */
    public static function getURL(){
       return SITE_URL.$_SERVER["REDIRECT_URL"];
    }
    
    /**
     * Verifica os indices internos de uma matriz, comparando com o valor, caso o encontre retorna esse array
     * @param array matriz $arrayMatriz
     * @param string $indiceInterno
     * @param string $valor
     * @return array
     */
    public static function verificaOcorrenciaArrayMatriz($arrayMatriz, $indiceInterno, $valor){
        $arrRetorno = array();
        foreach( $arrayMatriz as $array ){
            if( $array[$indiceInterno] == $valor ){
                $arrRetorno = $array;
            }
        }
        return $arrRetorno;
    }
    
    /**
     * Retorna o nome do controlador
     * @return string
     */
    public static function getControlador(){
        $objRequest = new Request();
        return $objRequest->get_controlador();
    }
    
    /**
     * Retorna data padrão MÁQUINA para padrão Mundo
     * @param string $data 2018-11-19
     * @return string
     */
    public static function converteData($data){
        $arrData = explode("-", $data);
        return $arrData[2]."/".$arrData[1]."/".$arrData[0];
    }
    
    /**
     * Retorna o nome do dia da semana pela data, formato time
     * @param string $data 2018-11-20
     * @return string
     */
    public static function getDiaSemana($data = ""){
        
        if(empty($data)){
            $data = date("Y-m-d");
        }
        
        $arrDiaSemana = array(
                    'Domingo',
                    'Segunda-feira',
                    'Terça-feira',
                    'Quarta-feira',
                    'Quinta-feira',
                    'Sexta-feira',
                    'Sábado'
            );
        $diasemana_numero = date('w', strtotime($data));
        return $arrDiaSemana[$diasemana_numero];
    }
    
    /**
     * Retorna o nome do mês atual
     * @return string
     */
    public static function getNomeMes(){
        
        $arrMes[1] = "Janeiro";
        $arrMes[2] = "Fevereiro";
        $arrMes[3] = "Março";
        $arrMes[4] = "Abril";
        $arrMes[5] = "Maio";
        $arrMes[6] = "Junho";
        $arrMes[7] = "Julho";
        $arrMes[8] = "Agosto";
        $arrMes[9] = "Setembro";
        $arrMes[10] = "Outubro";
        $arrMes[11] = "Novembro";
        $arrMes[12] = "Dezembro";
        
        return $arrMes[date("n")];
        
    }
    
    /**
     * converte data humana para data banco, 2019-10-01
     * @param string $data 17/12/2018
     * @return string
     */
    public static function dateBanco($data = "", $caracterLimitador = "/"){
        if(empty($data)){
            $data = date("d/m/Y");
        }
        
        $arrData = explode($caracterLimitador, $data);
        return $arrData[2]."-".$arrData[1]."-".$arrData[0];
        
    }
    
    /**
     * verifica se a data é correta
     * @param string $data 17/12/2018
     * @return boolean
     */
    public static function validarData($data = ""){
        if(empty($data)){
            $data = date("d/m/Y");
        }

        $arrData = explode("/", $data);
        
        return checkdate($arrData[1], $arrData[0], $arrData[2]);
        
    }
    
    public static function addHttp($string){
        $retorno = NULL;
        $arrString = explode("http://", $string);
        
        if(count($arrString) > 1){
            $retorno = $string;
        }else{
            $retorno = "http://".$string;
        }
        return $retorno;
    }
    
    public static function removeEspacoAcento($string){
        return str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($string))));
    }
    
    public static function somarDias($dias){
        $dateTime = new DateTime("now +$dias days");
        return date("d/m/Y", $dateTime->getTimestamp());
    }
    
    public static function subtrairDias($dias){
        $dateTime = new DateTime("now -$dias days");
        return date("d/m/Y", $dateTime->getTimestamp());
    }

    /**
     * Retorna a palavra com acento caso ache no dicionario
     * @param $palavra String
     */
    public static function colocaAcento($palavra){
        $arrDicionario = array(
            "macarrao" => "macarrão",
            "servicos" => "Serviços",
            "servico" => "Serviço",
        );
        //Verificando no dicionário a palavra sem acento
        foreach( $arrDicionario as $indice => $valor ){
            if($palavra == $indice){
                $palavra = $valor;
            }
        }
        return $palavra;
    }

    public static function converteUrlParaString($url){
        $arrUrl = explode("-",$url);
        $saida = "";
        foreach($arrUrl as $valor){
            $saida .= $valor." ";
        }
        return $saida;
    }

    public static function converteValorURL($valor){
        $arrUrl = explode("?",$valor);
        return "R$".$arrUrl["0"];
    }

}
