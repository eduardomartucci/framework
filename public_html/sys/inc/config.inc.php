<?
/*
Projeto.: DM Tecnologia de Informa��o
Autor...: Orbitive Ag�ncia Digital
Ano.....: 2019
E-mail..: atendimento@orbitive.com.br
Site....: http://www.orbitive.com.br
Nota....: "� expressamente proibida a reprodu��o ou utiliza��o deste c�digo sem a permiss�o do autor"
*/

define(SYS_DOMINIO,     "http://base.orbitive.com.br/");
define(PATH_ROOT,       "/home/base/");
define(PATH_PUBLICO,    PATH_ROOT       . "public_html/");
define(BD_TIPO,         "mysql");
define(BD_HOST,         "localhost");
define(BD_USUARIO,      "base_root");
define(BD_SENHA,        ".b^}pfBM?ZP6");
define(BD_BANCO,        "base_db");

// Defini��o de Variaveis do Sistema
define (SYS_NOME,           "Orbitive Ag�ncia Digital");
define (SYS_EMAIL,          "atendimento@orbitive.com.br");
define (SYS_TITLE,          "Orbitive Ag�ncia Digital");
define (SYS_CHARSET,        "windows-1252");
define (SYS_DESCRIPTION,    "Orbitive Ag�ncia Digital");
define (SYS_KEYWORDS,       "ag�ncia Digital");
define (SYS_AUTHOR,         "Orbitive Ag�ncia Digital");
define (SYS_AUTHOR_EMAIL,   "atendimento@orbitive.com.br");

// Defini��o dos Path
define (PATH_ADMIN,             PATH_PUBLICO    . "sys/");
define (PATH_IMG,               PATH_PUBLICO    . "img/");

// Defini��o dos endere�os HTTP
define (HTTP_ADMIN,             SYS_DOMINIO     . "sys/");
define (HTTP_IMG,               SYS_DOMINIO     . "img/");


// Defini��o de E-mails
define (EMAIL_LOG,          "dev@dmti.com.br");
define (EMAIL_FROM_NOME,    "Atendimento - Orbitive");
define (EMAIL_FROM_EMAIL,   "atendimento@orbitive.com.br");
define (EMAIL_CONTATO,      "atendimento@orbitive.com.br");

//Define Nome da Sess�o
define (NOME_SESSAO, "orbitiveAdmin");
define (NOME_SESSAO_CLIENTE, "orbitiveCliente");

$GLOBALS["sql"];

//Defini��o de E-mails
define (EMAIL_LOG,                  "atendimento@orbitive.com.br");
define (EMAIL_FROM_NOME,            "Orbitive");
define (EMAIL_FROM_NOREPLAY,        "noreply@orbitive.com.br");
define (EMAIL_TO_EMAIL,             "noreply@orbitive.com.br");


$GLOBALS["sql"];

// PERSISTENCE UNIT
require_once(PATH_ADMIN . "inc/PU.php");

// DAO GENERICO
require_once(PATH_ADMIN . "inc/dao/DAO.php");

//INCLUDECLASS
require_once(PATH_ADMIN . "inc/class/ClassCidade.php");
require_once(PATH_ADMIN . "inc/class/ClassEstado.php");
require_once(PATH_ADMIN . "inc/class/ClassEmail.php");
require_once(PATH_ADMIN . "inc/class/ClassUsuario.php");
require_once(PATH_ADMIN . "inc/class/ClassArquivo.php");
require_once(PATH_ADMIN . "inc/class/ClassData.php");
require_once(PATH_ADMIN . "inc/class/ClassLog.php");
require_once(PATH_ADMIN . "inc/class/ClassUtils.php");
require_once(PATH_ADMIN . "inc/class/ClassGeradora.php");


//INCLUDEDAO
require_once(PATH_ADMIN . "inc/dao/CidadeDAO.php");
require_once(PATH_ADMIN . "inc/dao/EstadoDAO.php");
require_once(PATH_ADMIN . "inc/dao/EmailDAO.php");
require_once(PATH_ADMIN . "inc/dao/UsuarioDAO.php");
require_once(PATH_ADMIN . "inc/dao/DAO.php");
require_once(PATH_ADMIN . "inc/dao/LogDAO.php");

// STARTA A SESSAO DO USUARIO
session_start();
?>
