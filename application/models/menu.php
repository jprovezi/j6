<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe para criar o menu do sistema
 *
 * @author joao
 */
class Menu extends Model{
    
    private $tabela = "menu";

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Retorna um array com todos os menus do sistema, cadastrados no banco de dados
     * @return array
     */
    public function getMenuSistema(){
                
        //Recebendo menu categoria pai
        $query = "SELECT * FROM {$this->tabela} WHERE categoria = :categoria ORDER BY ordem ASC";
        $dataWhere = array(":categoria" => "pai");
        $arrMenu["pai"] = $this->db->select($query, $dataWhere);
        
        //Criando menu filhos
        foreach($arrMenu["pai"] as $indicePai => $valor){
            $query = "SELECT * FROM {$this->tabela} WHERE idFilho = :id ORDER BY ordem ASC";
            $dataWhere = array(":id" => $valor["id"]);
            $arrMenu["pai"][$indicePai]["filhos"] = $this->db->select($query, $dataWhere);

            //Acessando Menu Netos
            foreach($arrMenu["pai"][$indicePai]["filhos"] as $indice => $valor){
                $query = "SELECT * FROM {$this->tabela} WHERE idFilho = :id ORDER BY ordem ASC";
                $dataWhere = array(":id" => $valor["id"]);
                $arrMenu["pai"][$indicePai]["filhos"][$indice]["filhos"] = $this->db->select($query, $dataWhere);
            }

        }

        //Recebendo menu de configurações
        $query = "SELECT * FROM {$this->tabela} WHERE categoria = :categoria ORDER BY ordem ASC";
        $dataWhere = array(":categoria" => "config");
        $arrMenu["config"] = $this->db->select($query, $dataWhere);        
        
        return $arrMenu;
        
    }
    
    
    
    
    
}
