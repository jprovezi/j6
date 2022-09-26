<?php 
namespace App\Helpers;

class Seo
{

    /**
     * Retorna o metadescription no formato de SEO
     *
     * @param string $var
     * @return string
     */
    public static function metaDescription(String $var = "")
    {
        $var = strip_tags($var);
        $var = preg_replace('/\s/',' ',$var);
        $var = preg_replace("/\s+/", " ",$var);
        return substr($var, 0, 160);
    }

    /**
     * Retorna o title do SEO no tamanho certo e sem formatação HTML
     *
     * @param string $var
     * @return string
     */
    public static function title(String $var = "")
    {
        $var = strip_tags($var);
        $var = preg_replace('/\s/',' ',$var);
        $var = preg_replace("/\s+/", " ",$var);
        return substr($var, 0, 70);
    }

}
