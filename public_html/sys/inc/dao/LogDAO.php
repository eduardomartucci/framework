<?
/** 
 * @package DAO
 * @category Log
 */
/**
 * Classe LogDAO
 *
 * @todo
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
class LogDAO {

  private $dao;
    private $pu;

    //Metodo Construtor
    public function __construct() {

        $this->dao  = new DAO("log","id_log");
        $this->pu   = new PU();

    }

    /**
     * Metodo Adicionar Log
     *
     * @param $objeto: objeto da entidade
     * @return boolean true: se inserido ou false: se não inserido
     *
     * <code>
     * <?php
     * 	$logDAO = new LogDAO();
     * 	$logDAO->setAll($array);
     * 	$logDAO->adicionar($usuario)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionarLog($objeto) {
           return $this->dao->adicionar($objeto);
    }

}
?>