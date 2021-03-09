<?

/**
 * @package Model
 * @category Log
 */
/*
  -- Estrutura da tabela `Log`
  CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDENTIFICACAO DO LOG',
  `id_usuario` int(11) NOT NULL COMMENT 'IDENTIFICACAO DO USUARIO',
  `log_codigo` varchar(255) NOT NULL COMMENT 'CODIGO DO ERRO',
  `log_ip` varchar(16) NOT NULL COMMENT 'IP DO USUARIO',
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'DATA E HORA DO ERRO',
  `log_browser` varchar(255) NOT NULL COMMENT 'BROWSER DO USUARIO',
  `log_post` longtext NOT NULL COMMENT 'VAR_DUMP DO VETOR SUPER GLOBAL POST',
  `log_get` text NOT NULL COMMENT 'VAR_DUMP DO VETOR SUPER GLOBAL GET',
  `log_session` text NOT NULL COMMENT 'VAR_DUMP DO VETOR SUPER GLOBAL SESSION',
  `log_sql` text NOT NULL COMMENT 'SQL EXECUTADO PELO PDO',
  `log_msg` varchar(255) NOT NULL COMMENT 'MENSAGEM GERADO PELO PDO',
  `log_arquivo` varchar(255) NOT NULL COMMENT 'QUAL O ARQUIVO QUE PROVOCOU O ERRO',
  `log_linha` varchar(255) NOT NULL COMMENT 'A LINHA DO ARQUIVO QUE PROVOCOU O ERRO',
  `log_fluxo` text NOT NULL COMMENT 'FLUXO DE EXECUCAO DO SCRIPT PARA TER GERADO O ERRO',
  `log_erro` text NOT NULL COMMENT 'MENSAGEM GERADO PELO ERRO',
  PRIMARY KEY (`id_log`),
  KEY `id_usuario` (`id_usuario`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 */

class Log {

    public $id_log;
    public $id_usuario;
    public $log_codigo;
    public $log_timestamp;
    public $log_browser;
    public $log_post;
    public $log_get;
    public $log_session;
    public $log_sql;
    public $log_msg;
    public $log_arquivo;
    public $log_linha;
    public $log_fluxo;
    public $log_erro;
    private $logDAO;

    public function __construct() {

        $this->logDAO = new LogDAO();
    }

    public function setAll($array) {

        $this->id_usuario = $_SESSION[NOME_SESSAO]['id_usuario'];
        $this->log_ip = $_SERVER['REMOTE_ADDR'];
        $this->log_codigo = $array["LogCodigo"];
        $this->log_timestamp = date("Y-m-d H:i:s");
        $this->log_browser = $_SERVER['HTTP_USER_AGENT'];
        $this->log_post = var_export($_POST, TRUE);
        $this->log_get = var_export($_GET, TRUE);
        $this->log_session = var_export($_SESSION, TRUE);
        $this->log_sql = $GLOBALS["sql"];
        $this->log_msg = $array["LogMsg"];
        $this->log_arquivo = $array["LogArquivo"];
        $this->log_linha = $array["LogLinha"];
        $this->log_fluxo = $array["LogFluxo"];
        $this->log_erro = $array["LogErro"];
    }

    public function getAll() {
        return get_object_vars($this);
    }

    public function setId($log) {
        $this->IdLog = $log;
    }

    public function getId() {
        return $this->IdLog;
    }

    function getId_log() {
        return $this->id_log;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getLog_codigo() {
        return $this->log_codigo;
    }

    function getLog_timestamp() {
        return $this->log_timestamp;
    }

    function getLog_browser() {
        return $this->log_browser;
    }

    function getLog_post() {
        return $this->log_post;
    }

    function getLog_get() {
        return $this->log_get;
    }

    function getLog_session() {
        return $this->log_session;
    }

    function getLog_sql() {
        return $this->log_sql;
    }

    function getLog_msg() {
        return $this->log_msg;
    }

    function getLog_arquivo() {
        return $this->log_arquivo;
    }

    function getLog_linha() {
        return $this->log_linha;
    }

    function getLog_fluxo() {
        return $this->log_fluxo;
    }

    function getLog_erro() {
        return $this->log_erro;
    }

    function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setLog_codigo($log_codigo) {
        $this->log_codigo = $log_codigo;
    }

    function setLog_timestamp($log_timestamp) {
        $this->log_timestamp = $log_timestamp;
    }

    function setLog_browser($log_browser) {
        $this->log_browser = $log_browser;
    }

    function setLog_post($log_post) {
        $this->log_post = $log_post;
    }

    function setLog_get($log_get) {
        $this->log_get = $log_get;
    }

    function setLog_session($log_session) {
        $this->log_session = $log_session;
    }

    function setLog_sql($log_sql) {
        $this->log_sql = $log_sql;
    }

    function setLog_msg($log_msg) {
        $this->log_msg = $log_msg;
    }

    function setLog_arquivo($log_arquivo) {
        $this->log_arquivo = $log_arquivo;
    }

    function setLog_linha($log_linha) {
        $this->log_linha = $log_linha;
    }

    function setLog_fluxo($log_fluxo) {
        $this->log_fluxo = $log_fluxo;
    }

    function setLog_erro($log_erro) {
        $this->log_erro = $log_erro;
    }

    /**
     * Metodo Adicionar Log
     *
     * @param $objeto: objeto da entidade
     * @return boolean true: se inserido ou false: se não inserido
     *
     * <code>
     * <?php
     * 	$log = new Log();
     * 	$log->setAll($array);
     * 	$log->adicionarLog($log)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionarLog($objeto) {
        return $this->logDAO->adicionarLog($objeto);
    }

    /**
     * Metodo Exibir dados do Log
     *
     * <code>
     * <?php
     * 	$log = new Log();
     * 	$log->exibirLog();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function exibirLog() {

        
        var_dump($this->getLog_codigo());
        
        switch ($this->getLog_codigo()) {
            
            case 23000:
                $utils = new Utils();
                $utils->mensagem('Não foi possível realizar essa operação pois essa entidade possui depedências, por favor verifique as outras entidades relacionadas a ela',false, 'erro');
                break;

            default:
                echo '<div class="row">';
                echo '<div class="col-lg-12">';
                echo "<b>Mensagem:</b> " . $this->getLog_msg() . "<br /><hr />";
                echo "<b>Arquivo:</b> " . $this->getLog_arquivo() . "<br /><hr />";
                echo "<b>Linha:</b> " . $this->getLog_linha() . "<br /><hr />";
                echo "<b>Fluxo do Erro:</b> <pre>" . $this->getLog_fluxo() . "</pre><br /><hr />";
                echo "<b>Código Erro:</b> <pre>" . $this->getLog_codigo() . "</pre><br /><hr />";
                echo "<b>PDO ErrorInfo:</b><br /><pre>";
                echo $this->getLog_erro();
                echo "</pre><hr />";
                echo "<b>SQL:</b><br /><pre>";
                echo $this->getLog_sql();
                echo "<b>POST:</b><br /><pre>";
                echo $this->getLog_post();
                echo "</pre><hr />";
                echo "<b>GET:</b><br /><pre>";
                echo $this->getLog_get();
                echo "</pre><hr />";
                echo "<b>SESSION:</b><br /><pre>";
                echo $this->getLog_session();
                echo "</pre><hr />";
                echo "</div>";
                echo "</div>";
                break;
        }
        
    }

    /**
     * Metodo Enviar Log Por E-mail
     *
     * @param $id: Integer contendo Identificação do log
     *
     * <code>
     * <?php
     * 	$log = new Log();
     * 	$log->enviarEmailLog($_POST[Logid]);
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function enviarEmailLog($id) {

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=ISO-8859-1\n";
        $headers .= "From: " . SYS_NOME . " <" . SYS_EMAIL . ">\n";
        //$headers .= "Cc: dev@kimera.com.br\n";
        $headers .= "Reply-To: <" . SYS_EMAIL . ">\n";
        //$headers .= 'X-Mailer: PHP/' . phpversion() ."\n";
        $headers .= "X-Sender: <" . SYS_EMAIL . ">\n";
        $headers .= "X-IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
        $headers .= "Return-Path: <" . SYS_EMAIL . ">\n";

        $log = $this->getAll();

        $usuario = new Usuario();
        $usuario = $usuario->selecionarUsuarioPorId($log["id_usuario"]);

        $msg = "<b>Informações do Usuário:</b><br />";
        $msg .= "<b>IP:</b> " . $log["LogIp"] . "<br />";
        $msg .= "<b>Browser:</b> " . $log["LogBrowser"] . "<br />";
        $msg .= "<b>Data / Hora:</b> " . date("d/m/Y - H:i:s") . "<br />";
        $msg .= "<b>Nome:</b> " . $usuario->getUsu_nome() . "<br />";
        $msg .= "<b>E-mail:</b> " . $usuario->getUsu_email() . "<br /><hr />";
        $msg .= "<b>LOG:</b> " . $id . "<br /><hr />";
        $msg .= "<b>Mensagem:</b> " . $log["LogMsg"] . "<br /><hr />";
        $msg .= "<b>Arquivo:</b> " . $log["LogArquivo"] . "<br /><hr />";
        $msg .= "<b>Linha:</b> " . $log["LogLinha"] . "<br /><hr />";
        $msg .= "<b>Fluxo do Erro:</b><br /><pre> " . $log["LogFluxo"] . "</pre><hr />";
        $msg .= "<b>PDO ErrorInfo:</b><br /><pre> " . $log["LogErro"] . "</pre><hr />";
        $msg .= "<b>SQL:</b><br /><pre> " . $log["LogSql"] . "</pre><hr />";
        $msg .= "<b>POST:</b><br /><pre> " . $log["LogPost"] . "</pre><hr />";
        $msg .= "<b>GET:</b><br /><pre> " . $log["LogGet"] . "</pre><hr />";
        $msg .= "<b>SESSION:</b><br /><pre> " . $log["LogSession"] . "</pre><hr />";

        mail(EMAIL_LOG, SYS_NOME . " - " . $log["LogMsg"], $msg, $headers);
    }

}

?>