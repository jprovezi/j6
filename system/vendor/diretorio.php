<?php

/**
 * Trabalha com os diretórios do sistema
 *
 * @author João
 */
class diretorio {

    private $nomeDiretorio;
    private $pathDiretorio;
    private $pathDiretorioFinal; //Caminho final do diretorio

    /**
     * @param string $nomeDiretorio nome final da pasta
     * @param string $pathDiretorio caminho até a pasta
     */

    public function __construct($nomeDiretorio, $pathDiretorio) {
        $this->setNomeDiretorio($nomeDiretorio);
        $this->setPathDiretorio($pathDiretorio);
        $this->setPathDiretorioFinal($this->getPathDiretorio() . "/" . $this->getNomeDiretorio());
    }

    public function setNomeDiretorio($nomeDiretorio) {
        $this->nomeDiretorio = $nomeDiretorio;
    }

    public function getNomeDiretorio() {
        return $this->nomeDiretorio;
    }

    public function setPathDiretorio($pathDiretorio) {
        if(!file_exists($pathDiretorio)){
            mkdir($pathDiretorio, 0777);
        }
        $this->pathDiretorio = $pathDiretorio;
    }

    public function getPathDiretorio() {
        return $this->pathDiretorio;
    }

    public function setPathDiretorioFinal($pathDiretorioFinal) {
        $this->pathDiretorioFinal = $pathDiretorioFinal;
    }

    public function getPathDiretorioFinal() {
        return $this->pathDiretorioFinal;
    }

    /**
     * Cria o diretorio no sistema com permissão de escrita caso não exista
     * @return Bool
     */
    public function criarDiretorio() {
        //Se não existir o diretorio ele cria
        if (!is_dir($this->getPathDiretorioFinal())) {
            return mkdir($this->getPathDiretorio() . "/" . $this->getNomeDiretorio(), 0777);
        }
    }

    /**
     * Retorna lista de nome diretorio se ele existir
     * @param array $arrRemover lista de itens para remover da lista que iniciam com essa string
     * @return array
     */
    public function lerDiretorio($arrRemover = array()) {
        
        if (is_dir($this->getPathDiretorioFinal())) {

            //indices padrões para remover
            $arrRemover[] = ".";
            $arrRemover[] = "..";

            //lendo dir
            $arrDir = scandir($this->getPathDiretorioFinal());

            //Removendo indices que começam com o arraylist da função
            foreach ($arrRemover as $indiceRemover => $valorRemover) {
                foreach ($arrDir as $indice => $valor) {
                    if (substr($valor, 0, strlen($valorRemover)) == $valorRemover) {
                        if (isset($arrDir[$indice])) {
                            unset($arrDir[$indice]);
                        }
                    }
                }
            }
            //retorna resetando indices do array
            return array_values($arrDir);
        }else{
            return array();
        }
    }
    
    /**
     * Se tiver a imagem no diretorio ele excluir
     * @param String $nomeImagem
     * @return bool
     */
    public function removerImagemDir($nomeImagem){
        if(is_file($this->getPathDiretorioFinal()."/".$nomeImagem) ){
            return unlink($this->getPathDiretorioFinal()."/".$nomeImagem);
        }
    }
    
    /**
     * Remove diretorio do sistema
     * @return Boolean
     */
    public function removerDiretorio($dir) {
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? $this->removerDiretorio("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
    }

}
