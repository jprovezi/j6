<?php
include VENDOR_PATH."/easyphpthumbnail/easyphpthumbnail.class.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe para trabalhar com as imagens do sistema, salvar, criar thumbs etc
 *
 * @author João
 */
class imagem extends easyphpthumbnail{
    
    public function __construct($dirSaveImage, $nomeImagem) {
        parent::__construct();
        $this->setDirSaveImage($dirSaveImage);
        $this->setNomeImagem($nomeImagem);
    }
    
    private $nomeImagem;
    private $dirSaveImage;

    public function setNomeImagem($nomeImagem){
        $this->nomeImagem = $nomeImagem;
    }
    
    public function getNomeImagem(){
        return $this->nomeImagem;
    }
    
    public function setDirSaveImage($dirSaveImage){
        $this->dirSaveImage = $dirSaveImage;
    }
    
    public function getDirSaveImage(){
        return $this->dirSaveImage;
    }
    
    /**
     * Retorno o tipo de extensão do arquivo
     * @return string
     */
    public function getExtension(){
        $arrString = explode(".", $this->nomeImagem);
        $arrString = array_slice($arrString,-1);
        return $arrString[0];
    }
    
    /**
     * Se a extensão passada, for uma extensão de imagem válida retorna verdadeiro
     * @param string $extensao
     * @return boolean
     */
    public function extensoesValidas($extensao){
        $retornoExtensao = false;
        $arrExtValidas = array(
            "jpg","JPG","JPGE","png","PNG","bmp","BMP","TIFF","tiff","GIF","gif",
            "pdf","eps","svg","SVG","EPS","PDF", "jpeg"
        );
        
        foreach( $arrExtValidas as $valor ){
            if( $extensao == $valor ){
                $retornoExtensao = true;
            }
        }
        
        return $retornoExtensao;
        
    }
    
    /**
     * Retorna um nome único para a imagem
     * @return string
     */
    public function nomeUnico(){
        return md5(date('d/m/y h:i:s').$this->getNomeImagem()).".".$this->getExtension();
    }
    
    /**
     * Salva a imagem no servidor se for uma extensão válida de imagem
     * @param string $dirTempImage
     * @return bool / String nome único da imagem
     */
    public function saveImage($dirTempImage){
        if( $this->extensoesValidas($this->getExtension()) ){
            $nomeImagem = Common::removeEspacoAcento($this->getNomeImagem());
            if(move_uploaded_file($dirTempImage, $this->dirSaveImage.$nomeImagem)){
                return $nomeImagem;
            }else{
                return false;
            }                 
        }else{
            return false;
        }
    }
    
    /**
     * Função para criar thumbnail das imagens e crop
     *
     * @param [int] $tamanho Tamanho do thumb
     * @param [string] $pathImage Local onde será salvo o thumb
     * @param boolean $crop Se é para cropar a imagem
     * @param array $valoresCrop Se passar um array com os valores de crop, ele crop de forma especifica
     * @return void
     */
    public function criarThumb($tamanho, $pathImage, $crop = false, $valoresCrop = array()){
        $this->Thumbsize = $tamanho;
        $this->Thumbprefix = "thumb".$tamanho."_";
        $this->Thumblocation = $this->getDirSaveImage();
        if($crop == true){
            if( empty($valoresCrop)){
                $this->Cropimage = array(3,0,0,0,0,0);
            }else{
                $this->Cropimage = $valoresCrop;
            }
        }
        $this->Createthumb($pathImage,'file');
    }
    
}
