<?php
/**
 * @package DAO
 * @category DAO
 */
/**
 * Classe DAO
 *
 * @todo
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
class DAO {
    private $pu;
    private $tabela;
    private $id;
    private $tabelaJoin;
    private $idJoin;

    public function __construct($tabela,$id,$tabelaJoin=false,$idJoin=false) {
        $this->pu = new PU();
        $this->setTabela($tabela);
        $this->setId($id);
        $this->setTabelaJoin($tabelaJoin);
        $this->setIdJoin($idJoin);
    }

    public function getTabela() {
        return $this->tabela;
    }

    public function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTabelaJoin() {
        return $this->tabelaJoin;
    }

    public function setTabelaJoin($tabelaJoin) {
        $this->tabelaJoin = $tabelaJoin;
    }

    public function getIdJoin() {
        return $this->idJoin;
    }

    public function setIdJoin($idJoin) {
        $this->idJoin = $idJoin;
    }

    /**
     * Método Adicionar
     *
     * @param $objeto: objeto da entidade..
     * @return boolean true: se inserido, false: se não inserido.
     *
     * <code>
     * <?php
     *  $DAO = new DAO();
     * 	$DAO->setAll($_POST[DAO]);
     * 	$DAO->adicionar($DAO)
     * ?>
     * </code>>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionar($objeto) {
        
        
        $this->pu->abreConexao();

        
        
        $retorno = $this->pu->insert($this->getTabela(),$objeto);
        $this->pu->fechaConexao();
        return $retorno ? $retorno : false;
    }

    /**
     * Metodo para adicionar a especialização(Pai e filho)
     *
     * @param $arrayPai : array contendo os atributos da tabela Pai.
     * @param $objetoFilho : Objeto contendo os atributos da tabela filho.
     * @return boolean true: se ediatdo, false: se não editado
     *
     * <code>
     * <?php
     *  $DAO = new DAO();
     *  $DAO->setAll($_POST[DAO]);
     *  $DAO->adicionarEspecializacao($DAO)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa<amaury@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionarEspecializacao($arrayPai, $objetoFilho) {
        $this->pu->abreConexao();
        $retorno = $this->pu->insertSpecialization($this->getTabelaJoin(), $this->getTabela(), $arrayPai, $objetoFilho);
        $this->pu->fechaConexao();
        return $retorno ? $retorno : false;
    }

    /**
     * Metodo para editar a especialização(Pai e filho)
     *
     * @param $arrayPai : array contendo os atributos da tabela Pai.
     * @param $objetoFilho : Objeto contendo os atributos da tabela filho.
     * @return boolean true: se ediatdo, false: se não editado
     *
     * <code>
     * <?php
     *  $DAO = new DAO();
     *  $DAO->setAll($_POST[DAO]);
     *  $DAO->editarEspecializacao($DAO)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa<amaury@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function editarEspecializacao($arrayPai, $objetoFilho) {
        $this->pu->abreConexao();
        $retorno = $this->pu->updateSpecialization($this->getTabelaJoin(), $this->getTabela(), $arrayPai, $objetoFilho, $this->idJoin . " = '".$objetoFilho->getId()."'");
        $this->pu->fechaConexao();
        return $retorno ? $retorno : false;
    }


    /**
     * Metodo Editar DAO
     *
     * @param $objeto: objeto da entidade
     * @return boolean true: se ediatdo, false: se não editado
     *
     * <code>
     * <?php
     *  $DAO = new DAO();
     *  $DAO->setAll($_POST[DAO]);
     *  $DAO->editarDAOr($DAO)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public  function editar($objeto) {
        $this->pu->abreConexao();
        $retorno = $this->pu->update($this->getTabela(), $objeto, $this->getId() . " = '".$objeto->getId()."'");
        $this->pu->fechaConexao();
        return $retorno ? true : false;
    }
    /**
     * Metodo que apaga a especialização (Pai e Filho).
     *
     * @param $id: string contendo o Id dos registros.
     * @return $retorno: Boolean True --> apagado com sucesso False --> não foi possível apagar o registro.
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	$DAO->apagarEspecializacao("27");
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function apagarEspcializacao($id) {

        $this->pu->abreConexao();
        $retorno = $this->pu->delete($this->getTabelaJoin() ,$this->getIdJoin()." = '$id'");
        $this->pu->fechaConexao();
        return $retorno ? true : false;
    }

    /**
     * Metodo Apagar DAO
     *
     * @param $objeto: objeto da entidade
     * @return boolean true: se apagado, false: se não apagado
     *
     * <code>
     * <?php
     *  $DAO      = new DAO();
     * 	$DAO->setId($_POST[IdDAO]);
     * 	$DAO->apagarDAO($DAO->getId());
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function apagar($id) {
        $this->pu->abreConexao();
        $retorno = $this->pu->delete($this->getTabela(), $this->getId() . " = '$id'");
        $this->pu->fechaConexao();
        return $retorno ? true : false;
    }
    /**
     * Metodo Selecionar DAO pelo ID
     *
     * @param $id: identificação do DAO que será seleciona
     * @return $array: array realizado atraves do fetch() para utilizar no setAll() da Classe
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	$DAO->selecionarDAOPorId($_GET[DAO_id]);
     * 	$DAO->getTexTitulo();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarPorId($id) {
        $this->pu->abreConexao();
        $array = $this->pu->select($this->getTabela(), $this->getId() . " = '$id'","0","1");
        $this->pu->fechaConexao();
        return $array ? $array : false;
    }



    /**
     * Metodo Selecionar Todas DAOs
     *
     * @param $orderBy: String contento o atributo e a forma de ordenação
     * @return $array: Array contendo os objetos instanciados da classe
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	foreach ($DAO->selecionarTodosDAOs("MaiTitulo ASC") as $objetos){
     * 	<tr>
     *      <td><?=$objetos->getTexTitulo()?></td>
     *	</tr>
     * 	}
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarTodos($orderBy,$where="0") {
        $this->pu->abreConexao();
        $stmt = $this->pu->select($this->getTabela(),$where,"$orderBy");
        $i=0;
        while ($array = $stmt->fetch()) {
            $objetos[$i] = new $this->tabela();
            $objetos[$i]->setAll($array);
            $i++;
        }
        $this->pu->fechaConexao();
        return $objetos;
    }

    /**
     * Metodo Selecionar Todas e Converter o resultado para o formato JSON.
     *
     * @param $orderBy: String contento o atributo e a forma de ordenação
     * @return $json: String codificado para formato JSON.
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	objJson = $DAO->selecionarTodosDAOs("MaiTitulo ASC")
     * 	echo objJson;
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarTodosConverterJson($orderBy,$where="0") {
        $this->pu->abreConexao();
        $stmt = $this->pu->select($this->getTabela(),$where,"$orderBy",'0');
        $json = $stmt->fetchAll();
        $json = json_encode($json);
        $this->pu->fechaConexao();
        return $json;
    }

    /**
     *
     * Metodo Selecionar união de duas tabelas DAOs.
     *
     * @param $orderBy: String contento o atributo e a forma de ordenação.
     * @param $where: String contendo a restrição.
     * @return $objetos: Array contendo os objetos.
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	foreach ($DAO->selecionarUniaoTodos("Status = 1","MaiTitulo ASC") as $objetos){
     * 	<tr>
     *      <td><?=$objetos->getTexTitulo()?></td>
     *	</tr>
     * 	}
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shumizu Higa <amaury@dmti.com>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function selecionarUniaoTodos($where,$orderBy) {

        $this->pu->abreConexao();
        $stmt = $this->pu->selectJoin($this->getTabela(), $this->getTabelaJoin(), $this->getIdJoin(), $where, $orderBy);
        $i=0;
        while ($array = $stmt->fetch()) {
            $objetos[$i] = new $this->tabela();
            $objetos[$i]->setAll($array);
            $i++;
        }
        $this->pu->fechaConexao();
        return $objetos;
    }

    /**
     * Metodo Selecionar união de duas tabelas DAOs Por ID
     *
     * @param $where String contendo a restrição.
     * @return $array: Array contendo os atributos das 2 tabelas (Pai e Filho)
     *
     * <code>
     * <?php
     * 	$DAO = new DAO();
     * 	foreach ($DAO->selecionarTodosDAOs("MaiTitulo ASC") as $objetos){
     * 	<tr>
     *      <td><?=$objetos->getTexTitulo()?></td>
     *	</tr>
     * 	}
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarUniaoPorId($id) {
        $this->pu->abreConexao();
        $array = $this->pu->selectJoin($this->getTabelaJoin(),$this->getTabela(), $this->getIdJoin(), $this->id." = ".$id,"0","1");
        $this->pu->fechaConexao();
        return $array ? $array : false;
    }

    /**
     * Metodo Selecionar Ultimo Noticia Inserido
     *
     * @param $orderBy: String ordernar os Noticias pelo ID pegando sempre a ultimo Noticia
     * @return $array: array realizado atraves do fetch() para utilizar no setAll() da Classe
     *
     * <code>
     * <?php
     * 	$Noticia = new Noticia();
     * 	$Noticia->selecionarUltimoNoticia("IdNoticia DESC");
     * 	echo $Noticia->getNotTitulo;
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarUltimo($campo) {

        $this->pu->abreConexao();
        $array = $this->pu->select($this->getTabela(),"$campo LIMIT 0,1","0");
        $this->pu->fechaConexao();
        return $array ? $array : false;

    }

    /**
     * Metodo Selecionar Ultimo Noticia Inserido
     *
     * @param $orderBy: String ordernar os Noticias pelo ID pegando sempre a ultimo Noticia
     * @return $array: array realizado atraves do fetch() para utilizar no setAll() da Classe
     *
     * <code>
     * <?php
     * 	$Noticia = new Noticia();
     * 	$Noticia->selecionarUltimoNoticia("IdNoticia DESC");
     * 	echo $Noticia->getNotTitulo;
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarPrimeiro($campo) {

        $this->dao->abreConexao();
        $array = $this->dao->select($this->getTabela(),"$campo ASC LIMIT 0,1","1");
        $this->dao->fechaConexao();
        return $array ? $array : false;

    }
    /**
     * Metodo Verificar se ja existe Email cadastrado.
     *
     * @param $email: String contendo o atributo da busca
     * @return $total: Integer contendo as informações dos registros encontrados
     *
     * <code>
     * <?php
     * $mailing = new DAO();
     * if($boletim->verificaEmailExistente($_POST[email])){
     *     $mailing->adicionarDAO($mailing)
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function numerosRegistros($campo) {

        $this->pu->abreConexao();
        $stmt = $this->pu->select($this->getTabela(),$this->getId() . " = '$campo'");
        $this->pu->fechaConexao();
        return $stmt->rowCount();
    }
}
?>
