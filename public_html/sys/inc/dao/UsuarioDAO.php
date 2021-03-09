<?
/** 
 * @package DAO
 * @category usuario
 */

/**
 * Classe usuarioDAO
 *
 * @todo
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
class usuarioDAO {

    private $dao;
    private $pu;

    public function __construct() {
        $this->dao  = new DAO("usuario","id_usuario");
        $this->pu   = new PU();
    }
    
    public function adicionarUsuario($objeto) {
        return $this->dao->adicionar($objeto);
    }

    public function editarUsuario($objeto) {
        return $this->dao->editar($objeto); 
    }
    
    public function apagarUsuario($id) {
        return $this->dao->apagar($id);
    }

    public function selecionarTodosUsuarios($orderBy) {
        return $this->dao->selecionarTodos($orderBy);
    }

    public function selecionarUsuarioPorId($Idusuario) {
        return $this->dao->selecionarPorId($Idusuario);
    }

    /**
     * Metodo Editar Usuário pelo Email
     *
     * @param $objeto: objeto da entidade
     * @return boolean true: se ediatdo, false: se não editado
     *
     * <code>
     * <?php
     *  $usuario    = new usuario();
     * 	$usuarioDAO = new usuarioDAO();
     * 	$usuario->setEmail($_POST[UsuEmail]);
     * 	$usuario->setSenha($utils->criaSenhaRandomica(md5($_POST[UsuSenha])));
     * 	$usuarioDAO->editarusuario($usuario);
     * ?>
     * </code>
     *
     * @version 2.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function editarUsuarioPorEmail($objeto) {

        $this->pu->abreConexao();
        $retorno = $this->pu->update("usuario",$objeto, "usu_email = '".$objeto->getEmail()."'");
        $this->pu->fechaConexao();
        return $retorno ? true : false;
        
    }

    /**
     * Metodo Selecionar usuario pelo Email e Senha
     *
     * @param $email: string contendo o email do usuario
     * @param $senha: string conteudo a senha do usuari
     * @return $objeto: objeto realizado atraves do fetchObject()
     *
     * <code>
     * <?php
     * 	$usuarioDAO = new usuarioDAO();
     * 	$usuario    = $usuarioDAO->selecionarusuarioPorEmailSenha($_POST[UsuEmail],$_POST[UsuSenha]);
     * 	$usuario->UsuNome;
     * ?>
     * </code>
     *
     * @version 2.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarUsuarioPorEmailSenha($email,$senha) {
        $senhaMD5 = md5($senha);
        $this->pu->abreConexao();
        $array = $this->pu->select("usuario","usu_email = '$email' AND usu_senha = '$senhaMD5'","0","1");
        $this->pu->fechaConexao();
        return $array ? $array : false;
        
    }

    /**
     * Metodo Selecionar usuario pelo Email
     *
     * @param $email: email do usuario que será seleciona
     * @return $objeto: se achar o usuario, false: se não achar o usuario
     *
     * <code>
     * <?php
     * 	$usuarioDAO = new usuarioDAO();
     * 	$usuario    = $usuarioDAO->selecionarusuarioPorEmail($_GET[usu_email]);
     * 	echo $usuario->UsuNome
     * ?>
     * </code>
     *
     * @version 2.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. MEE
     */
    public function selecionarUsuarioPorEmail($email) {

        $this->pu->abreConexao();
        $array = $this->pu->select("usuario","usu_email = '$email'","0","1");
        $this->pu->fechaConexao();
        return $array ? $array : false;
        
    }
    
}
?>