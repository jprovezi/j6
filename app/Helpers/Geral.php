<?php

namespace App\Helpers;
use Illuminate\Support\Arr;


class Geral
{

    /**
     * Divide o array em duas partes e retorna um array
     *
     * @param Array $array
     * @param bool $sortear
     * @return array
     */
    public static function dividirArray(Array $array, $sortear = false)
    {
        $tamanhoArr = count($array);
        $metadeArr = $tamanhoArr/2;

        //1 metade do array
        for ($i=0; $i < floor($metadeArr); $i++) {
            $arr1[] = $array[$i];
        }

        //2 metade do array
        for ($i=$metadeArr; $i < $tamanhoArr; $i++) {
            $arr2[] = $array[$i];
        }

        $arr = [$arr1, $arr2];

        if( !$sortear ){
            return $arr;
        }else{
            return Arr::shuffle($arr);
        }


    }

    /**
     * Retorna um array sorteado pela quantidade escolhida
     *
     * @param integer $qt
     * @param array $arr
     * @return array
     */
    public static function sortearArray(int $qt = 1, array $arr = null)
    {
        foreach (array_rand($arr,$qt) as $key => $value) {
            $arrRetorno[] = $arr[$value];
        }
        return $arrRetorno;
    }

}
