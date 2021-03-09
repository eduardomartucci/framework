<?php
require_once("/home/base/public_html/sys/inc/config.inc.php");

// INSTANCIA A CLASSE LOGIN E VERIFICA SE O USUARIO ESTA LOGADO (SESSAO REGISTRADA)
$utils   = new Utils();
$usuario = new Usuario();

if(!$usuario->usuarioLogado() && $_SERVER['SCRIPT_FILENAME'] != PATH_ADMIN . "index.php" && $_SERVER['SCRIPT_FILENAME'] != PATH_ADMIN . "usuario_nova_senha.php") {
    $utils->direciona("index.php?erro=2");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="<?= SYS_CHARSET ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= SYS_DESCRIPTION ?>" />
        <meta name="keywords" content="<?= SYS_KEYWORDS ?>" />
        <title><?= SYS_TITLE ?></title>
        <!-- Componentes --> 
        <link href="<?= HTTP_ADMIN ?>assets/css/componentes.min.css" rel="stylesheet">  
        <link href="<?= HTTP_ADMIN ?>assets/css/estilos.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body>
    <!-- Conteudo -->
    <div id="wrapper">
        <?php
        include("inc/nav.inc.php");
        ?>
        <div id="page-wrapper">
            

