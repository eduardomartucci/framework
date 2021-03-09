<?php
class CidadeDAO {

  private $dao;
  private $pu;

  public function __construct() {
      $this->dao  = new DAO('cidade','id_cidade');
      $this->pu   = new PU();
  }




  public function selecionarTodosCidade($orderBy){
      return $this->dao->selecionarTodos($orderBy);
  }

  public function selecionarCidadePorId($id){
      return $this->dao->selecionarPorId($id);
  }
  
  public function selecionarCidadesPorIdEstado($idEstado){
      $this->pu->abreConexao();
        $stmt = $this->pu->select("cidade"," id_estado = ".$idEstado,"cid_nome");
        $i=0;
        while ($array = $stmt->fetch()) {
            $objetos[$i] = new Cidade();
            $objetos[$i]->setAll($array);
            $i++;
        }
        $this->pu->fechaConexao();
        return $objetos;
  }


}
?>