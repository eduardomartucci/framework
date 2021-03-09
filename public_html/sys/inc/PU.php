<?php
/**
 * @package PU
 * @category PU
 */
/**
 * Classe PU
 *
 * @todo
 *
 * @version 2.0
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
class PU {

    private $PDO;

    private $tipo;
    private $host;
    private $usuario;
    private $senha;
    private $banco;


    // Metodo construtor
    public function __construct() {

        $this->tipo	= BD_TIPO;
        $this->host	= BD_HOST;
        $this->usuario 	= BD_USUARIO;
        $this->senha    = BD_SENHA;
        $this->banco    = BD_BANCO;
    }

    // Metodo fechar conexao
    public function abreConexao() {

        try {

            switch ($this->tipo) {
                case "mysql":
                    $this->PDO = new PDO("mysql:host=$this->host;port=3306;dbname=$this->banco",$this->usuario,$this->senha);
                    break;
                case "pgsql":
                    $this->PDO = new PDO("pgsql:dbname={$this->banco};user={$this->usuario};password={$this->senha};host=$this->host");
                    break;
                case "ibase":
                    $this->PDO = new PDO("firebird:dbname={$this->host}:{$this->banco}",$this->usuario,$this->senha);
                    break;
                case "mssql":
                    $this->PDO = new PDO("mssql:host={$this->host},1433;dbname={$this->banco}",$this->usuario,$this->senha);
                    break;
            }

            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->PDO->beginTransaction();

        } catch (PDOException $e) {

            echo "Não foi possível estabelecer a conexão com o banco de dados <br />";
            die();

        }
    }

     // Metodo fechar conexao
    public function fechaConexao() {
        $this->PDO = NULL;
    }


    public function gerarSQL($dados,$tipo){

        if($tipo != "ambos") $sql = " ( ";

        // verifica se os dados é um array
        if( is_array($dados) ) {
           // Verifica o número de campos que serão atualizados
           $count=0;
           $i=1;
           foreach($dados as $campo => $valor) {
                if($valor != NULL) $count++;
            }
            foreach($dados as $campo => $valor) {
                if($valor != NULL){
                    if($tipo == "valor") $sql .= "'" . $valor . "'";
                    if($tipo == "campo") $sql .= '`' . $campo . "`";
                    if($tipo == "ambos") $sql .= '`' . $campo . "` = '". $valor . "'";
                    if($count > $i){
                        $sql .= " , ";
                        $i++;
                    }
                }
            }
        }
        // verifica se os dados é um objeto
        if( is_object($dados) ) {
           // Verifica o número de campos que serão atualizados
           $count=0;
           $i=1;
           foreach(get_object_vars($dados) as $nome => $valor) {
                if($valor != NULL) $count++;
            }
            foreach(get_object_vars($dados) as $campo => $valor) {
                if($valor != NULL){
                    if($tipo == "valor") $sql .= "'". $valor .  "'";
                    if($tipo == "campo") $sql .= '`' . $campo . '`';
                    if($tipo == "ambos") $sql .= '`' . $campo . "` = '". $valor . "'";
                    if($count > $i){
                        $sql .= " , ";
                        $i++;
                    }
                }
            }
        }

        if($tipo != "ambos") $sql .= " ) ";

        return $sql;
    }


    /**
     * Metodo Select
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $where: string, opcional, contendo a condição da consulta SQL
     * @param $order: string, opcional, contendo a ordenação da consulta SQL
     * @param $fo: integer, opcional, 0 para retornar a query 1 para retornar o objeto
     *
     * @return objeto gerado pela consulta SQL ou a query da consulta SQL;
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->select("usuario")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function select($tabela, $where = 0, $order = 0, $fo = 0) {

        try {

            $sql = 'SELECT * FROM ' . $tabela ;

            if($where != '0') $sql .= ' WHERE ' . $where ;
            if($order != '0') $sql .= ' ORDER BY '. $order ;

            //echo $sql;
            $GLOBALS["sql"] = $query;

            $stmt = $this->PDO->query($sql);

            return $fo != '0' ? $stmt->fetch() : $stmt;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }

    }

    /**
     * Metodo Select
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $objeto: objeto, instancia da classe
     *
     * @return boolean $id se inserido, false se não inserido
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->insert("usuario",$usuarioPU)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function insert($tabela, $objeto) {

        try {

            $query = "INSERT INTO " . $tabela;
            $query .= $this->gerarSQL($objeto,"campo");
            $query .= "VALUES";
            $query .= $this->gerarSQL($objeto,"valor");

            //echo  $query;

            $GLOBALS["sql"] = $query;
            
            
            
            
            $this->PDO->query($query);

            $id 	= $this->PDO->lastInsertId();
            $retorno 	= $this->PDO->commit();

            // Retorna ou o id da inserção ou falso
            return $retorno ? $id : $retorno ;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            $id = $log->adicionarLog($log);
           
        }

    }

    /**
     * Metodo Update
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $objeto: objeto, instancia da classe
     * @param $where: string, opcional, contendo a condição da consulta SQL
     *
     * @return boolean true se atualizado, false se não atualizado
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->update("usuario",$objeto,"id_usuario = '$_GET[usuario_id]'")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function update($tabela,$objeto,$where) {

        try {

            $query = "UPDATE " . $tabela . " SET ";
            $query .= $this->gerarSQL($objeto,"ambos");
            $query .= " WHERE " . $where ;

            //echo $query;
            $GLOBALS["sql"] = $query;

            $this->PDO->exec($query);
            $retorno = $this->PDO->commit();

            return $retorno;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }

    }

     /**
     * Metodo Update para tabela Pai e Filho (Especialização)
     *
     * @param $tabelaPai : tabela Pai
     * @param $tabelaFilho: Tabela filho
     * @param $arrayPai: array contendo os atributos da tabela Pai
     * @param $objetoFilho: objeto com os atributos da tabela filha
     * @param $where : Id(Registro a ser modificado) Comum para as duas tabelas
     * @return boolean $id se inserido, false se não inserido
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->updateSpecialization("tabelaPai","tabelaFilho","atributosPai","atributosFilho","idComum");
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hido Shimizu Higa
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function updateSpecialization($tabelaPai, $tabelaFilho, $arrayPai, $objetoFilho, $where) {

        try {
            
            $query = "UPDATE " . $tabelaPai . " SET ";                                 
            $query .= $this->gerarSQL($arrayPai,"ambos");
            $query .= " WHERE " . $where ;
            //echo $query;
            
            $GLOBALS["sql"] = $query;
            $this->PDO->exec($query);

            $query = "UPDATE " . $tabelaFilho . " SET ";
            $query .= $this->gerarSQL($objetoFilho,"ambos");
            $query .= " WHERE " . $where ;
            //echo $query;

            $GLOBALS["sql"] = $query;
            $this->PDO->exec($query);

            $retorno = $this->PDO->commit();

            return $retorno;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }
    }

    /**
     * Metodo Delete
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $where: string, opcional, contendo a condição da consulta SQL
     *
     * @return boolean true se apagado, false se não apagado
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->delete("usuario","id_usuario = '$_GET[usuario_id]'")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function delete($tabela, $where = 0) {

        try {

            $sql = 'DELETE FROM ' . $tabela ;

            if($where != '0') $sql .= ' WHERE ' . $where ;

            //echo $sql;
            $GLOBALS["sql"] = $sql;

            $this->PDO->exec($sql);
            $retorno = $this->PDO->commit();

            return $retorno;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            $id = $log->adicionarLog($log);
           
        }
    }


    /**
     * Metodo Select Distinct
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $where: string, opcional, contendo a condição da consulta SQL
     *
     * @return boolean true se apagado, false se não apagado
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->delete("usuario","id_usuario = '$_GET[usuario_id]'")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selectDistinct($campos, $tabela, $where = 0, $order = 0, $fo = 0) {

        try {

            $sql = 'SELECT DISTINCT ' . $campos . ' FROM ' . $tabela ;

            if($where != '0')
                $sql .= ' WHERE ' . $where ;

            if($order != '0')
                $sql .= ' ORDER BY '. $order ;

            //echo $sql;
            $GLOBALS["sql"] = $sql;

            $stmt = $this->PDO->query($sql);

            return $fo != '0' ? $stmt->fetch() : $stmt;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }
    }

    /**
     * Metodo Select Join
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $tabelaJoin: string contendo a segunda tabela a ser selecionada
     * @param $idLigacao: string contendo o id que liga duas tabelas
     * @param $order: string, opcional, contendo a ordenação da consulta SQL
     * @param $fo: integer, opcional, 0 para retornar a query 1 para retornar o objeto
     * @param $where: string, opcional, contendo a condição da consulta SQL
     *
     * @return objeto gerado pela consulta SQL ou a query da consulta SQL;
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->selectJoin("usuario","pessoa","id_pessoa","id_usuario = '$_GET[usuario_id]'","0","1");
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selectJoin($tabela, $tabelaJoin, $idLigacao, $where, $order = 0, $fo = 0) {

        try {

            $sql = 'SELECT * FROM ' . $tabela ;

            $sql.= ' INNER JOIN ' . $tabelaJoin . ' ON (' . $tabela . '.' . $idLigacao . '=' .$tabelaJoin . '.' . $idLigacao.')';

            if($where != '0') $sql .= ' WHERE ' . $where ;
            if($order != '0') $sql .= ' ORDER BY '. $order ;

            //echo $sql;
            $GLOBALS["sql"] = $sql;

            $stmt = $this->PDO->query($sql);

            return $fo != '0' ? $stmt->fetch() : $stmt;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }
    }

    /**
     * Metodo Insert para tabela Pai e Filho (Especialização)
     *
     * @param $tabelaPai : tabela Pai
     * @param $tabelaFilho: Tabela filho
     * @param $arrayPai: array contendo os atributos da tabela Pai
     * @param $objetoFilho: objeto com os atributos da tabela filha
     * @return boolean $id se inserido, false se não inserido
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->insertArray("usuario",$usuarioPU)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function insertSpecialization($tabelaPai, $tabelaFilho, $arrayPai, $objetoFilho) {

        try {

            $query = "INSERT INTO " . $tabelaPai;
            $query .= $this->gerarSQL($arrayPai, "campo");
            $query .= "VALUES";
            $query .= $this->gerarSQL($arrayPai, "valor");

           //echo  $query;

            $GLOBALS["sql"] = $query;
            $this->PDO->exec($query);

            $ids["IdPai"] = $this->PDO->lastInsertId();
            $objetoFilho->setIdPai($ids["IdPai"]);

            $query = "INSERT INTO " . $tabelaFilho;
            $query .= $this->gerarSQL($objetoFilho, "campo");
            $query .= "VALUES";
            $query .= $this->gerarSQL($objetoFilho, "valor");

           // echo  $query;

            $GLOBALS["sql"] = $query;
            $this->PDO->exec($query);

            $ids["IdFilho"] = $this->PDO->lastInsertId();

            $retorno = $this->PDO->commit();

            // Retorna ou o id da inserção ou falso
            return $retorno ? $ids : false ;


        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }
    }

    /**
     * Metodo Update Array
     *
     * @param $tabela: string contendo a tabela a ser selecionada
     * @param $array: array, contendo os campos e valores
     *
     * @return boolean $id se inserido, false se não inserido
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->updateArray("usuario",$usuarioPU)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    function updateArray($tabela,$array,$where) {

        try {
            $query = "UPDATE " . $tabela . " SET ";
            $query .= $this->gerarSQL($array, "ambos");
            $query .= " WHERE " . $where ;

            //echo $query;
            $GLOBALS["sql"] = $query;

            $this->PDO->exec($query);
            $retorno = $this->PDO->commit();

            return $retorno;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }
    }

    /**
     * Metodo Query.
     *
     * @param $query : String com a consulta SQL
     * @param $fo : String contendo o tipo de retorno desejado.
     *
     * @return objeto gerado pela consulta SQL ou a query da consulta SQL;
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->query("select * from usuario")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function query($query,$fo = 0) {

        try {

            $sql = $query;

            //echo $query;

            $GLOBALS["sql"] = $query;
            $stmt = $this->PDO->query($sql);

            return $fo != '0' ? $stmt->fetch() : $stmt;

        } catch (PDOException $e) {

            $array["LogMsg"]        = $e->getMessage();
            $array["LogCodigo"]     = $e->getCode();
            $array["LogArquivo"]    = $e->getFile();
            $array["LogLinha"]      = $e->getLine();
            $array["LogFluxo"]      = $e->__toString();
            $array["LogErro"]       = var_export($this->PDO->errorInfo(),TRUE);

            $this->PDO->rollback();
            $this->PDO = NULL;

            $log = new Log();
            $log->setAll($array);
            $log->exibirLog();
            //$id = $log->adicionarLog($log);
           
        }

    }

    /* Metodo Query.
     *
     * @param $query : String com a consulta SQL
     * @param $fo : String contendo o tipo de retorno desejado.
     *
     * @return objeto gerado pela consulta SQL ou a query da consulta SQL;
     *
     * <code>
     * <?php
     * 	$PU = new PU();
     * 	$PU->query("select * from usuario")
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    function seach($query,$order = 0,$fo = 0) {

        try {

            if($order != '0') $query .= ' ORDER BY '. $order ;
            //echo $query;
            //die();
            $GLOBALS["sql"] = $query;

            $stmt = $this->PDO->query($query);

            return $fo != '0' ? $stmt->fetch() : $stmt;

        } catch (PDOException $e) {

            $this->PDOGerenciarErro($e);
        }

    }


}
?>
