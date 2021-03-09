<?php
/**
 * @package Model
 * @category Email
 */

/**
 * @author DM - Tecnologia da Informação <dev@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
/*
  -- Estrutura da tabela `Email`
  CREATE TABLE IF NOT EXISTS `email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDENTIFICACAO DO EMAIL',
  `ema_formato` enum('html','text') NOT NULL COMMENT 'FORMATO EM HTML OU TEXTO DO EMAIL',
  `ema_corpo` text NOT NULL COMMENT 'CORPO DO EMAIL',
  `ema_nome` varchar(100) NOT NULL COMMENT 'NOME DO EMAIL PARA IDENTIFICAÃ?Ã?O',
  PRIMARY KEY (`id_email`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
 */
class Email {

    private $emailDAO;
    public $IdEmail;
    public $EmaFormato;
    public $EmaCorpo;
    public $EmaNome;
    private $EmaIp;

    public function __construct() {
        $this->emailDAO = new EmailDAO();
        $this->setEmaIp($_SERVER['REMOTE_ADDR']);
    }

    public function setAll($array) {
        $this->setIdEmail($array['IdEmail']);
        $this->setEmaFormato($array['EmaFormato']);
        $this->setEmaCorpo($array['EmaCorpo']);
        $this->setEmaNome($array['EmaNome']);
    }

    public function getAll() {
        return get_object_vars(get_class($this));
    }

    public function getIdEmail() {
        return $this->IdEmail;
    }

    public function setIdEmail($IdEmail) {
        $this->IdEmail = $IdEmail;
    }

    public function getEmaFormato() {
        return $this->EmaFormato;
    }

    public function setEmaFormato($EmaFormato) {
        $this->EmaFormato = $EmaFormato;
    }

    public function getEmaCorpo() {
        return $this->EmaCorpo;
    }

    public function setEmaCorpo($EmaCorpo) {
        $this->EmaCorpo = $EmaCorpo;
    }

    public function getEmaNome() {
        return $this->EmaNome;
    }

    public function setEmaNome($EmaNome) {
        $this->EmaNome = $EmaNome;
    }

    public function getEmaIp() {
        return $this->EmaIp;
    }

    public function setEmaIp($EmaIp) {
        $this->EmaIp = $EmaIp;
    }

    public function adicionarEmail($objeto) {
        return $this->emailDAO->adicionarEmail($objeto);
    }

    public function editarEmail($objeto) {
        return $this->emailDAO->editarEmail($objeto);
    }

    public function apagarEmail($id) {
        return $this->emailDAO->apagarEmail($id);
    }

    public function selecionarEmailPorId($id) {
        $this->setAll($this->emailDAO->selecionarEmailPorId($id));
    }

    public function selecionarTodosEmail($orderBy) {
        return $this->emailDAO->selecionarTodosEmail($orderBy);
    }

    public function enviarEmailContato($msg, $assunto, $de) {
        $email = $this->carregaHeader();
        $email .= $msg;
        $email .= $this->carregaFooter();
        $this->enviarEmail(EMAIL_TO_EMAIL, $de, $assunto, $email, "", "html");
    }

    /**
     * Metodo Gerar Headers do corpo do Email
     *
     * @param $para: String contendo o endereço eletronico da pessoa que vai receber o e-mail
     * @param $de: String contendo o endereço eletronico da pessoa que enviou o email
     * @param $assunto: String contendo o assunto do email
     * @param $tipo: String contendo se é html (para envio de html no email) ou plain para envio so texto
     * @return $header: retorna string contendo os dados do header
     *
     * <code>
     * <?php
     *  $email = new Email();
     * 	$email->gerarHeader($noticia);
     * ?>
     * </code>
     *
     * @version 1.0
     * @author DMTI - DM Tecnologia de Informação <atendimento@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    function gerarHeader($para, $de, $assunto, $conteudo, $comcopia = false) {

        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/" . $conteudo . "; charset=ISO-8859-1\r\n";
        $header .= "Message-Id: <" . date('YmdHis') . "." . md5(microtime()) . "." . strtoupper($de) . "> \r\n";
        $header .= "From: " . $de . " \r\n";
        $header .= "To: <" . $para . "> \r\n";

        if ($comcopia != false)
            $header .= "Bcc: " . $comcopia . " \r\n";

        $header .= "Date: " . date('D, d M Y H:i:s O') . " \r\n";
        $header .= "X-MSMail-Priority: High \r\n";
        $header .= "Reply-To: " . $de . "\n";
        $header .= "X-Sender: " . $de . "\n";
        $header .= "X-IP: " . $this->EmaIp . "\n";
        $header .= "Return-Path: <" . $de . ">\n";
        
        return $header;
    }

    /**
     * Metodo enviar e-mail
     *
     * @param $para: String contendo o endereço eletronico da pessoa que vai receber o e-mail
     * @param $de: String contendo o endereço eletronico da pessoa que enviou o email
     * @param $assunto: String contendo o assunto do email
     * @param $mensagem: String contendo o corpo do email
     * @param $autenticacao: Boolean true para autenticar ou false sem autenticação
     * @param $tipoConteudo: String contendo se é html (para envio de html no email) ou plain para envio so texto
     * @param $tipoEnvio: String contendo se é smtp (para envio smtp) ou via função php mail()
     * @return boolean true: se enviado, false: se não enviado
     *
     * <code>
     * <?php
     *  $email = new Email();
     * 	$email->enviarEmail("suporte@dmti.com.br","suporte@dmti.com.br","teste",true,"plain","mail");
     * ?>
     * </code>
     *
     * @version 1.1
     * @author DMTI - DM Tecnologia de Informação <atendimento@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME

     */
    function enviarEmail($para, $de, $assunto, $mensagem, $comcopia = false, $conteudo = 'plain', $envio = 'mail', $autenticacao = true) {

        if ($envio == "smtp") {
            $this->abrirConexao();
            if ($autenticacao == true)
                $this->autenticacao();

            $this->setValor("MAIL FROM: " . $de);
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar o comando MAIL FROM" . "<br/ >";

            $this->setValor("RCPT TO: " . $para);
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar o comando RCPT TO" . "<br/ >";

            $this->setValor("DATA");
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar o comando DATA" . "<br/ >";

            $this->setValor($this->gerarHeader($para, $de, $comcopia, $assunto, $conteudo));
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar as HEADERS" . "<br/ >";

            $this->setValor("\r\n");
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar o comando NEWLINE" . "<br/ >";

            $this->setValor($mensagem);
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar a MENSAGEM" . "<br/ >";

            $this->setValor(".");
            if ($this->getValor() != 334)
                $erro = "Falha ao tentar enviar a SENHA" . "<br/ >";

            if ($this->getValor() != 250)
                return false;
            else
                return true;

            $this->fecharConexao();
        }

        if ($envio == "mail") {
            return mail($email, $assunto, $mensagem, $this->gerarHeader($para, $de, $assunto, $conteudo, $comcopia));
        }
    }

    /**
     * Header genercio do e-mail
     *
     * @return retorna o header do email generico
     *
     * <code>
     * <?php
     *  $email = new Email();
     * 	$email->header();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author DMTI - DM Tecnologia de Informação <atendimento@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function carregaHeader() {

        $header = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                 <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=windows-1552" />
                    <title>'. SYS_NOME .'</title>
                 </head>
                 <body style="text-align:center;margin:0;padding:0;">
                    <div style="width:600px; margin:auto;text-align:left;">
                        <div style="height:100px;">
                            <img src="' . HTTP_IMG . 'header-email.jpg" width="600" height="100" alt="" />
                        </div>
                    <div style="padding:10px;">
                 ';

        return $header;
    }

    /**
     * Footer generico do e-mail
     *
     * @return retorna o footer do email generico
     *
     * <code>
     * <?php
     *  $email = new Email();
     * 	$email->footer();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author DMTI - DM Tecnologia de Informação <atendimento@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function carregaFooter() {

        $footer .= '
                    </div>
                    <div style="text-align:center; padding:20px;font-family:Arial, Helvetica, sans-serif;font-size:12px; border-top:1px solid #d7d7d7;">
                        <p><a href="' . SYS_DOMINIO . '">' . SYS_DOMINIO . '</a></p>
                    </div>
            </div>
        </body>
    </html>';
        return $footer;
    }
    
}
?>