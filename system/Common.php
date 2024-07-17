<?php

use PHPMailer\PHPMailer\PHPMailer;

class Common
{

    private function __construct()
    {
        //Construtor privado, classe nao pode ser instanciada
    }

    public static function limpaCaracteresEstranhos($string)
    {
        $remover = array("????????", "????");
        $trocar = array("", "");
        return str_replace($remover, $trocar, $string);
    }


    public static function limpaTagsHtml($string)
    {

        // ----- remove HTML TAGs ----- 
        $string = preg_replace ('/<[^>]*>/', ' ', $string); 
        
        // ----- remove control characters ----- 
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space
        
        // ----- remove multiple spaces ----- 
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        
        return $string;

    }

  

    /**
     * Retorna o padrão URL produto-categoria para produto categoria
     *
     * @param [string] $url
     * @return string
     */
    public static function getUrltoString($url)
    {
        return str_replace("-", " ", urldecode($url));
    }

    /**
     * Recebe uma string produto categoria e retorna o padrão de url produto-categoria
     *
     * @param [string] $url
     * @return string
     */
    public static function getStringtoUrl($url)
    {
        return str_replace(" ", "-", urldecode($url));
    }

    /**
     * Retorna a partir do mês atual, o nome, mes e ano dos ultimos 3 meses
     *
     * @return array
     */
    public static function getUltimos3Meses()
    {

        $mesAtual = date("n");
        $anoAtual = date("Y");

        //Mês Atual
        $arrMeses[0]["nome"] = Common::getNomeMes($mesAtual);
        $arrMeses[0]["mes"] = (int) $mesAtual;
        $arrMeses[0]["ano"] = (int) $anoAtual;

        //1 Mês atrás
        $numeroMes = $mesAtual - 1;
        $numeroMes = ($numeroMes == 0) ? 12 : $numeroMes;
        $arrMeses[1]["nome"] = Common::getNomeMes($numeroMes);
        $arrMeses[1]["mes"] = (int) $numeroMes;
        $arrMeses[1]["ano"] = ($numeroMes == 12) ? (int) $anoAtual - 1 : (int) $anoAtual;

        //2 Meses atrás
        $numeroMes = $numeroMes - 1;
        $numeroMes = ($numeroMes == 0) ? 12 : $numeroMes;
        $arrMeses[2]["nome"] = Common::getNomeMes($numeroMes);
        $arrMeses[2]["mes"] = (int) $numeroMes;
        $arrMeses[2]["ano"] = ($numeroMes == 11) ? (int) $anoAtual - 1 : (int) $anoAtual;

        return $arrMeses;
    }

    /**
     * Retorna o link de chamada do whatsapp já formatado
     *
     * @param [string] $telefone
     * @return string
     */
    public static function linkWhatsapp($telefone)
    {
        $url = "https://api.whatsapp.com/send?phone=55";
        $telefone = str_replace("-", "", $telefone);
        $telefone = str_replace(" ", "", $telefone);
        return $url . $telefone;
    }

    /**
     * Retorna o primeiro nome da pessoa
     *
     * @param string $nome
     * @return string
     */
    public static function PrimeiroNome(string $nome)
    {
        $nomeQuebrado = explode(" ", $nome);
        return $nomeQuebrado[0];
    }

    /**
     * Recebe uma string e retorna em formato de slug para url
     *
     * @param string $string
     * @return string
     */
    public static function slug(string $string)
    {

        //Deixa tudo minúsculo
        $string = strtolower($string);

        //Trocando caracteres
        $string = str_replace(" ", "-", $string);
        $string = str_replace(",", "", $string);
        $string = str_replace("?", "", $string);
        $string = str_replace("!", "", $string);
        $string = str_replace("@", "", $string);
        $string = str_replace(".", "", $string);
        $string = str_replace(";", "", $string);
        $string = str_replace("/", "", $string);
        $string = str_replace("*", "", $string);
        $string = str_replace("+", "", $string);
        $string = str_replace("=", "", $string);
        $string = str_replace("&", "e", $string);
        $string = str_replace("$", "S", $string);
        $string = str_replace("#", "", $string);
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $string = str_replace("º", "", $string);
        $string = str_replace("®", "", $string);

        //Remove os acentos
        $string = Common::removeEspacoAcento($string);

        return $string;
    }

    public static function removerCaracteresEspeciais(string $string)
    {

        //Trocando caracteres
        $string = str_replace(",", "", $string);
        $string = str_replace("?", "", $string);
        $string = str_replace("!", "", $string);
        $string = str_replace("@", "", $string);
        $string = str_replace(".", "", $string);
        $string = str_replace(";", "", $string);
        $string = str_replace("/", "", $string);
        $string = str_replace("*", "", $string);
        $string = str_replace("+", "", $string);
        $string = str_replace("=", "", $string);
        $string = str_replace("&", "e", $string);
        $string = str_replace("$", "S", $string);
        $string = str_replace("#", "", $string);
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $string = str_replace("º", "", $string);
        $string = str_replace("®", "", $string);
        $string = str_replace("1", "Um", $string);$string = str_replace("2", "Dois", $string);$string = str_replace("3", "Tres", $string);
        $string = str_replace("4", "Quatro", $string);$string = str_replace("5", "Cinco", $string);$string = str_replace("6", "Seis", $string);
        $string = str_replace("7", "Sete", $string);$string = str_replace("8", "Oito", $string);$string = str_replace("9", "Nove", $string);

        return $string;
    }
    

    public static function slugClass($slug){
        $nomeClasse = "";
        $arrSlug = explode("-",$slug);
        foreach($arrSlug as $valor){
            $nomeClasse .= ucfirst($valor);
        }
        return $nomeClasse;
    }

    public static function slugNomeArquivo($slug){
        return str_replace("-", "", $slug);
    }
    

    /**
     * Envia email através do sistema
     *
     * @param [string] $emailDestino //Email para quem será enviado o email
     * @param [string] $nomeDestino //Nome de quem recebe o email
     * @param [array] $emailsCopia //Cópias que o email será enviado, se não tiver passar array vazio
     * @param [string] $tituloEmail //Titulo do email
     * @param [string] $corpoEmailHtml //montagem do corpo do email
     * @return void
     */
    public static function enviarEmail($emailDestino, $nomeDestino, $emailsCopia, $tituloEmail, $corpoEmailHtml)
    {

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Configurações do servidor de email
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = EMAIL_HOST; //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0; //to view proper logging details for success and error messages
        $mail->Username = EMAIL_USERNAME; //email
        $mail->Password = EMAIL_PASSWORD; //16 character obtained from app password created
        $mail->Port = EMAIL_PORT; //SMTP port
        $mail->SMTPSecure = EMAIL_SEGURANCA;

        //Informações de quem envia o email
        $mail->setFrom(EMAIL_REMETENTE, NOME_REMETENTE);

        //receiver email address and name
        $mail->addAddress($emailDestino, $nomeDestino);

        //Criando cópias para enviar o email
        foreach ($emailsCopia as $valor) {
            $mail->addCC($valor);
        }

        //Monta a mensagem a ser enviada
        $mail->isHTML(true);
        $mail->Subject = $tituloEmail;
        $mail->Body    = $corpoEmailHtml."<br><br>[Mensagem enviada via sistema. Não responder!]";
        // Envia o email
        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }

        //Fecha a conexão com o servidor
        $mail->smtpClose();
    }

    /**
     * Verifica se a imagem existe no servidor, se não existir retorna um caminho de imagem default
     * @path pasta/nomefoto.jpg
     * $catImg 'default' - 'user'
     */
    public static function getImg($path, $catImg = "default")
    {
        if (file_exists(STATIC_PATH . "/img/" . $path)) {
            return IMG_URL . "/" . $path;
        } else {
            if ($catImg == "default") {
                return IMG_URL . "/1-notfounds/default.png";
            } else if ($catImg == "user") {
                return IMG_URL . "/1-notfounds/user.png";
            } else if ($catImg == "blog") {
                return IMG_URL . "/1-notfounds/blog-default.png";
            }
        }
    }

    /**
     * Retorna em dias a diferença entre duas datas
     * @param string $data_inicio 2016-07-10
     * @param string $data_fim 2017-07-10
     * @return string
     */
    public static function diferencaData($data_inicio, $data_fim)
    {
        $data_inicio = new DateTime($data_inicio);
        $data_fim = new DateTime($data_fim);

        // Resgata diferença entre as datas
        $dateInterval = $data_inicio->diff($data_fim);
        if ($data_inicio < $data_fim) {
            return "-" . $dateInterval->days;
        } else {
            return "" . $dateInterval->days;
        }
    }


    /**
     * 
     * @param 1.500,25 $num
     * @return string retorna R$100.000,50
     */
    public static function moedaValorReal($num)
    {
        return number_format($num, 2, ',', '.');
    }
    /**
     * 
     * @param 1.500,25 $num
     * @return string retorna R$100.000,50
     */
    public static function moedaValorBanco($num)
    {
        return number_format(str_replace(",", ".", str_replace(".", "", $num)), 2, '.', '');
    }


    /**
     * Valida se o dado está em branco
     * @access public
     * @param String $dado
     * @return Boolean
     */
    public static function validarEmBranco($dado)
    {
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
    public static function validarMinimo($string, $numeroCaracteres)
    {
        return strlen($string) < $numeroCaracteres;
    }

    /**
     * Verifica o número máximo de caracteres
     * @param string $string
     * @param int $numeroCaracteres
     * @return type
     */
    public static function validarMaximo($string, $numeroCaracteres)
    {
        return strlen($string) > $numeroCaracteres;
    }

    /**
     * Se campo1 for iguao a campo2 retorna verdadeiro
     * @param string $campo1
     * @param string $campo2
     * @return Bool
     */
    public static function validarCamposIguais($campo1, $campo2)
    {
        return $campo1 == $campo2;
    }

    /**
     * Redireciona uma url
     * @access public
     * @param String $url URL a ser requisitada
     * return void
     */
    public static function redir($url = "")
    {
        header('location: ' . SITE_URL . '/' . $url);
        exit;
    }

    /**
     * Retorna um array com a soma e o resultado de dois numeros aleatorios de 1 a 9
     * @return array
     */
    public static function getNotRobot()
    {
        $numero1 = rand(1, 9);
        $numero2 = rand(1, 9);
        $resultado = $numero1 + $numero2;

        return array(
            "somaUsuario" => $numero1 . "+" . $numero2,
            "resultado" => $numero1 + $numero2
        );
    }


    /**
     * Retorna a URL completa do sistema
     * @return string
     */
    public static function getURL()
    {
        return SITE_URL . $_SERVER["REDIRECT_URL"];
    }

    /**
     * Verifica os indices internos de uma matriz, comparando com o valor, caso o encontre retorna esse array
     * @param array matriz $arrayMatriz
     * @param string $indiceInterno
     * @param string $valor
     * @return array
     */
    public static function verificaOcorrenciaArrayMatriz($arrayMatriz, $indiceInterno, $valor)
    {
        $arrRetorno = array();
        foreach ($arrayMatriz as $array) {
            if ($array[$indiceInterno] == $valor) {
                $arrRetorno = $array;
            }
        }
        return $arrRetorno;
    }

    /**
     * Retorna o nome do controlador
     * @return string
     */
    public static function getControlador()
    {
        $objRequest = new Request();
        return $objRequest->get_controlador();
    }

    /**
     * Retorna o nome do método acessado no momento
     *
     * @return void
     */
    public static function getMetodo()
    {
        $objRequest = new Request();
        return $objRequest->get_metodo();
    }

    /**
     * Retorna data padrão MÁQUINA para padrão Mundo
     * @param string $data 2018-11-19
     * @return string
     */
    public static function converteData($data)
    {
        $arrData = explode("-", $data);
        return $arrData[2] . "/" . $arrData[1] . "/" . $arrData[0];
    }

    /**
     * Converte o timestamp para formato Humano
     * 
     * @param [bool] $apenasData - Se estiver true ele retorna apenas a data
     * @param [string] $timestamp
     * @return string
     */
    public static function converteTimestamp($timestamp, $apenasData = false)
    {
        //Recebe o timestamp e separa a data
        $arrTimestamp = explode(" ", $timestamp);

        //Arruma a data para humana
        $dataHumana = Common::converteData($arrTimestamp[0]);

        //Retorna timestamp humano
        if ($apenasData) {
            return $dataHumana;
        } else {
            return $dataHumana . " " . $arrTimestamp[1];
        }
    }

    /**
     * Retorna o nome do dia da semana pela data, formato time
     * @param string $data 2018-11-20
     * @return string
     */
    public static function getDiaSemana($data = "")
    {

        if (empty($data)) {
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
    public static function getNomeMes($mes = 0)
    {

        //Se não for passado o numero do mes, ele pega o mês atual
        if ($mes == 0) {
            $mes = date("n");
        }

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

        return $arrMes[$mes];
    }

    /**
     * converte data humana para data banco, 2019-10-01
     * @param string $data 17/12/2018
     * @return string
     */
    public static function dateBanco($data = "", $caracterLimitador = "/")
    {
        if (empty($data)) {
            $data = date("d/m/Y");
        }

        $arrData = explode($caracterLimitador, $data);
        return $arrData[2] . "-" . $arrData[1] . "-" . $arrData[0];
    }

    /**
     * verifica se a data é correta
     * @param string $data 17/12/2018
     * @return boolean
     */
    public static function validarData($data = "")
    {
        if (empty($data)) {
            $data = date("d/m/Y");
        }

        $arrData = explode("/", $data);

        return checkdate($arrData[1], $arrData[0], $arrData[2]);
    }

    public static function addHttp($string)
    {
        $retorno = NULL;
        $arrString = explode("http://", $string);

        if (count($arrString) > 1) {
            $retorno = $string;
        } else {
            $retorno = "http://" . $string;
        }
        return $retorno;
    }

    public static function removeEspacoAcento($string)
    {
        return str_replace(" ", "_", preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($string))));
    }

    public static function limparAcentos($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }

    public static function somarDias($dias)
    {
        $dateTime = new DateTime("now +$dias days");
        return date("d/m/Y", $dateTime->getTimestamp());
    }

    /**
     * Retorna o timestamp atual
     *
     * @return string
     */
    public static function getTimeStamp()
    {
        return date("Y-m-d H:i:s");
    }

    public static function subtrairDias($dias)
    {
        $dateTime = new DateTime("now -$dias days");
        return date("d/m/Y", $dateTime->getTimestamp());
    }

    /**
     * Retorna a palavra com acento caso ache no dicionario
     * @param $palavra String
     */
    public static function colocaAcento($palavra)
    {
        $arrDicionario = array(
            "macarrao" => "macarrão",
            "servicos" => "Serviços",
            "servico" => "Serviço",
        );
        //Verificando no dicionário a palavra sem acento
        foreach ($arrDicionario as $indice => $valor) {
            if ($palavra == $indice) {
                $palavra = $valor;
            }
        }
        return $palavra;
    }

    public static function converteUrlParaString($url)
    {
        $arrUrl = explode("-", $url);
        $saida = "";
        foreach ($arrUrl as $valor) {
            $saida .= $valor . " ";
        }
        return $saida;
    }

    public static function converteValorURL($valor)
    {
        $arrUrl = explode("?", $valor);
        return "R$" . $arrUrl["0"];
    }

    /**
     * Gera uma senha aleatória
     *
     * @param [int] $tamanho
     * @param [bool] $maiusculas
     * @param [bool] $minusculas
     * @param [bool] $numeros
     * @param [bool] $simbolos
     * @return string
     */
    public static function gerarSenha($tamanho)
    {
        $letras = "abcdefghijklmnopqrstuvyxwz";
        $numeros = "0123456789";
        $senha = "";

        //embaralhando as letras
        $senha .= str_shuffle($letras);

        //Embaralhando os numeros
        $senha .= str_shuffle($numeros);

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        $novasenha =  substr(str_shuffle($senha), 0, $tamanho);

        return $novasenha;
    }

    /**
     * 
     *  Recebe o número e formata para o padrão do CPF ou CNPJ
     *  CPF: 000.000.000-00
     *  CNPJ: 00.000.000/0000-00
     *
     * @param [type] $cpf_cnpj
     * @return void
     */
    public static function formataCpfCnpj($cpf_cnpj)
    {

        ## Retirando tudo que não for número.
        $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
        $tipo_dado = NULL;
        if (strlen($cpf_cnpj) == 11) {
            $tipo_dado = "cpf";
        }
        if (strlen($cpf_cnpj) == 14) {
            $tipo_dado = "cnpj";
        }
        switch ($tipo_dado) {
            default:
                $cpf_cnpj_formatado = "Não foi possível definir tipo de dado";
                break;

            case "cpf":
                $bloco_1 = substr($cpf_cnpj, 0, 3);
                $bloco_2 = substr($cpf_cnpj, 3, 3);
                $bloco_3 = substr($cpf_cnpj, 6, 3);
                $dig_verificador = substr($cpf_cnpj, -2);
                $cpf_cnpj_formatado = $bloco_1 . "." . $bloco_2 . "." . $bloco_3 . "-" . $dig_verificador;
                break;

            case "cnpj":
                $bloco_1 = substr($cpf_cnpj, 0, 2);
                $bloco_2 = substr($cpf_cnpj, 2, 3);
                $bloco_3 = substr($cpf_cnpj, 5, 3);
                $bloco_4 = substr($cpf_cnpj, 8, 4);
                $digito_verificador = substr($cpf_cnpj, -2);
                $cpf_cnpj_formatado = $bloco_1 . "." . $bloco_2 . "." . $bloco_3 . "/" . $bloco_4 . "-" . $digito_verificador;
                break;
        }
        return $cpf_cnpj_formatado;
    }

    /**
     * Reduz o tamanho do texto e adicionar (...)
     *
     * @param [string] $texto
     * @param integer $tamanho
     * @return string
     */
    public static function reduzirTexto($texto, $tamanho = 50)
    {
        if (strlen($texto) <= $tamanho) {
            $continua = "";
        } else {
            $continua = "";
        }
        return substr($texto, 0, $tamanho) . $continua;
    }


    /**
     * Retorna um array contendo a paginação
     * @param int $totalRows
     * @param string $url
     * @return array
     */
    public static function getPageView($totalRows, $page, $url = "", $busca = "", $limit = 10)
    {
        $totalPaginas = ceil($totalRows / $limit);
        $arrRetorno = array();
        for ($i = 1; $i <= $totalPaginas; $i++) {
            //Verificando página ativa
            if ($page == $i) {
                $arrRetorno[] = array(
                    "page_number" => $i,
                    "url" => SITE_URL . "/" . $url . "/" . $i . "/" . $busca,
                    "active" => "class='active'"
                );
            } else {
                $arrRetorno[] = array(
                    "page_number" => $i,
                    "url" => SITE_URL . "/" . $url . "/" . $i . "/" . $busca,
                    "active" => ""
                );
            }
        }
        return $arrRetorno;
    }

    /**
     * Retorna o valor do Offset referente ao limite de linhas do banco
     * @param int $page
     * @return int
     */
    public static function getOffsetPage($page, $limit = 10)
    {
        return ($page - 1) * $limit;
    }
}
