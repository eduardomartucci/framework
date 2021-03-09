<?php
class EstadoDAO {

  private $dao;
  private $pu;

  public function __construct() {
      $this->dao  = new DAO('estado','id_estado');
      $this->pu   = new PU();
  }

  public function adicionarEstado($objeto){
      return $this->dao->adicionar($objeto);
  }

  public function editarEstado($objeto){
      return $this->dao->editar($objeto);
  }

  public function selecionarTodosEstado($orderBy){
      return $this->dao->selecionarTodos($orderBy);
  }

  public function selecionarEstadoPorId($id){
      return $this->dao->selecionarPorId($id);
  }

  public function apagarEstado($id){
      return $this->dao->apagar($id);
  }

}
?>