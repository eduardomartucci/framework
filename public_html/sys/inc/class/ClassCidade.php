<?php
class Cidade {

   private $cidadeDAO;

   public $id_cidade;
   public $id_estado;
   public $cid_nome;

   function __construct(){ 
       $this->cidadeDAO =  new CidadeDAO();
   }

   public function setAll($array){
       $this->setId_cidade($array['id_cidade']); 
       $this->setId_estado($array['id_estado']); 
       $this->setCid_nome($array['cid_nome']); 
   }

   public function getAll(){
       return (get_object_vars($this));
   }

   public function getId() { return $this->id_cidade;} 
   public function setId($id_cidade) { $this->id_cidade = $id_cidade;} 
   public function getId_cidade() { return $this->id_cidade;} 
   public function setId_cidade($id_cidade) { $this->id_cidade = $id_cidade;} 
   public function getId_estado() { return $this->id_estado;} 
   public function setId_estado($id_estado) { $this->id_estado = $id_estado;} 
   public function getCid_nome() { return $this->cid_nome;} 
   public function setCid_nome($cid_nome) { $this->cid_nome = $cid_nome;} 

//METODOS - PADRAO - CRUD
   public function selecionarCidadePorId($id){ $this->setAll($this->cidadeDAO->selecionarCidadePorId($id));}
   public function selecionarTodosCidade($orderBy){ return $this->cidadeDAO->selecionarTodosCidade($orderBy); }
   public function selecionarCidadesPorIdEstado($idEstado){ return $this->cidadeDAO->selecionarCidadesPorIdEstado($idEstado); }   
}
?>