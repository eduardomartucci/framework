<?php 
/**
* @package DAO
* @category Email
*/
/**
* @author DM - Tecnologia da Informaчуo <dev@dmti.com.br>
* @copyright Copyright (c) 2009 DM Produчѕes Ltda. ME
*/

class EmailDAO {

	 private $dao;
	 private $pu;


	public function __construct() {
		$this->dao = new DAO('Email','IdEmail');
		$this->pu = new PU();
	}

	public function adicionarEmail($objeto) {
		return $this->dao->adicionar($objeto);
	}

	public function editarEmail($objeto) {
		return $this->dao->editar($objeto);
	}

	public function apagarEmail($id) {
		return $this->dao->apagar($id);
	}

	public function selecionarEmailPorId($id) {
		return $this->dao->selecionarPorId($id);
	}

	public function selecionarTodosEmail($orderBy) {
		return $this->dao->selecionarTodos($orderBy);
	}

}
?>