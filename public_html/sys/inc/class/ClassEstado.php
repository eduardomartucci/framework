<?php
class Estado {

   private $estadoDAO;

   public $id_estado;
   public $est_nome;
   public $est_sigla;

   function __construct(){ 
       $this->estadoDAO =  new EstadoDAO();
   }

   public function setAll($array){
       $this->setId_estado($array['id_estado']); 
       $this->setEst_nome($array['est_nome']); 
       $this->setEst_sigla($array['est_sigla']); 
   }

   public function getAll(){
       return (get_object_vars($this));
   }

   public function getId() { return $this->id_estado;} 
   public function setId($id_estado) { $this->id_estado = $id_estado;} 
   public function getId_estado() { return $this->id_estado;} 
   public function setId_estado($id_estado) { $this->id_estado = $id_estado;} 
   public function getEst_nome() { return $this->est_nome;} 
   public function setEst_nome($est_nome) { $this->est_nome = $est_nome;} 
   public function getEst_sigla() { return $this->est_sigla;} 
   public function setEst_sigla($est_sigla) { $this->est_sigla = $est_sigla;} 

//METODOS - PADRAO - CRUD
   public function selecionarEstadoPorId($id){ $this->setAll($this->estadoDAO->selecionarEstadoPorId($id));}
   public function selecionarTodosEstado($orderBy){ return $this->estadoDAO->selecionarTodosEstado($orderBy); }
}
?>