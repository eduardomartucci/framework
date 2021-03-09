<? 
/**
 * @package Model
 * @category usuario
 */

/**
 * Classe usuario
 *
 * @todo metodo enviar nova senha e retirar do Request
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */

class usuario {

    private $chave;
    private $ip;
    private $usuarioDAO;

    public $id_usuario;
    public $usu_nome;
    public $usu_email;
    public $usu_senha;

    public function __construct() {

        $this->setChave("fgsdfjtgwu3gjhGHGJHGjhfgjfsgfi7w34fksdlvsdshgahgdfayh3w5fday32dfeu36fdualjoih");
        $this->setIp($_SERVER['REMOTE_ADDR']);
        $_SESSION[NOME_SESSAO]['chave'] = $this->getChave();
        $_SESSION[NOME_SESSAO]['ip']    = $this->getIp();
        $this->usuarioDAO               = new usuarioDAO();               
    }

    public function setAll($array) {
        $this->setId_usuario($array["id_usuario"]);
        $this->setUsu_nome($array["usu_nome"]);
        $this->setUsu_email($array["usu_email"]);
        $this->setUsu_senha($array["usu_senha"]);
    }

    public function getAll() {
        return get_object_vars(get_class($this));
    }
    
    function getId() {
        return $this->id_usuario;
    }
    
    function setId($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function getChave() {
        return $this->chave;
    }

    function getIp() {
        return $this->ip;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getUsu_nome() {
        return $this->usu_nome;
    }

    function getUsu_email() {
        return $this->usu_email;
    }

    function getUsu_senha() {
        return $this->usu_senha;
    }

    function setChave($chave) {
        $this->chave = $chave;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setUsu_nome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    function setUsu_email($usu_email) {
        $this->usu_email = $usu_email;
    }

    function setUsu_senha($usu_senha) {
        $this->usu_senha = $usu_senha;
    }

    
    public function adicionarUsuario($objeto) {
        return $this->usuarioDAO->adicionarUsuario($objeto);
    }

    public function editarUsuario($objeto) {
        return $this->usuarioDAO->editarUsuario($objeto);
    }

    public function apagarUsuario($Idusuario) {        
        return $this->usuarioDAO->apagarUsuario($Idusuario);
    }

    public function selecionarUsuarioPorId($Idusuario) {
        $this->setAll($this->usuarioDAO->selecionarUsuarioPorId($Idusuario));
    }

    public function selecionarTodosUsuarios($orderBy) {
        return $this->usuarioDAO->selecionarTodosUsuarios($orderBy);
    }

    /**
     * Metodo Autenticar usuario por Email e Senha
     *
     * @param $email: string conteudo o email do usuario
     * @param $senha: string conteudo a senha do usuario
     *
     * @return boolean true: se autenticado, false: caso contrário
     *
     * <code>
     * <?php
     * 	$usuario = new usuario();
     * 	$usuario->autenticarusuarioPorEmailSenha($_POST[login],$_POST[$xsenha])
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function autenticarUsuarioPorEmailSenha($email,$senha) {
        if (getenv("REQUEST_METHOD") == "POST") {
            $array = $this->usuarioDAO->selecionarUsuarioPorEmailSenha($email,$senha);
            if ($array) {
                $this->setAll($array);
                $_SESSION[NOME_SESSAO]['id_usuario']	= $this->getId_usuario();
                $_SESSION[NOME_SESSAO]['chave']         = $this->getChave();
                $_SESSION[NOME_SESSAO]['ip']            = $this->getIp();
                $_SESSION[NOME_SESSAO]['usu_nome']	= $this->getUsu_nome();
                $_SESSION[NOME_SESSAO]['usu_email']	= $this->getUsu_email();
                $_SESSION[NOME_SESSAO]['usu_senha']	= $this->getUsu_senha();
                $_SESSION[NOME_SESSAO]['chavePublica'] = md5($_SESSION[NOME_SESSAO]['usu_email'] . $_SESSION[NOME_SESSAO]['chave'] . $_SESSION[NOME_SESSAO]['ip'] . $_SESSION[NOME_SESSAO]['usu_senha']);
                return true;
            } else {
                return false;
            }
        }        
    }

    /**
     * Metodo Usuario Logado
     *
     * @param null
     *
     * @return boolean true: se estiver logado, false: caso contrário
     *
     * <code>
     * <?php
     * $usuario = new usuario();
     * if(!$usuario->UsuarioLogado()){
     * 	$utils = new Utils();
     * 	$utils->direciona("index.php?erro=2");
     * 	exit;
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function UsuarioLogado() {

        if( $_SESSION[NOME_SESSAO]['chavePublica'] != md5($_SESSION[NOME_SESSAO]['usu_email'] . $_SESSION[NOME_SESSAO]['chave'] . $_SESSION[NOME_SESSAO]['ip'] . $_SESSION[NOME_SESSAO]['usu_senha']) ) {
            return false;
        }

        return true;
    }

    /**
     * Metodo Selecionar Usuario pelo Email e Senha
     *
     * @param $email: string contendo o email do Usuario
     * @param $senha: string conteudo a senha do usuari
     * @return $array: array realizado atraves do fetch()
     *
     * <code>
     * <?php
     * 	$usuarioDAO = new usuarioDAO();
     * 	$usuario    = $usuarioDAO->selecionarUsuarioPorEmailSenha($_POST[UsuEmail],$_POST[UsuSenha]);
     * 	$usuario->UsuNome;
     * ?>
     * </code>
     *
     * @version 2.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function selecionarUsuarioPorEmailSenha($email,$senha) {
        return $this->setAll($this->usuarioDAO->selecionarUsuarioPorEmailSenha($email,$senha));
    }

}
?>