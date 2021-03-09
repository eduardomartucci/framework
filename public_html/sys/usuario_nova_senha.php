<?php
require_once("/home/base/public_html/sys/inc/config.inc.php");
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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">

                    <p style="text-align: center;padding: 0px; margin-top: 25px " ><img src="<?=HTTP_ADMIN?>img/logo.png" /></p>                                
                    <div class="panel-body">
                        <form role="form" action="ctrl/usuario/login" method="post" > 
                            <fieldset>
                                <legend class="text-color-n1" >Solicitar nova senha</legend>
                                <div class="form-group">
                                    <label for="usu_email">Digite seu e-mail de cadastro</label>
                                    <input class="form-control" placeholder="E-mail" name="usu_email" type="text" autofocus>
                                </div>
                                <input type="hidden" name="acao" value="NovaSenha" />
                                <button  class="btn btn-lg btn-success btn-block">Solicitar</button>
                            </fieldset>
                            <div class="row text-center">
                                <hr>
                                <p>
                                    Será enviado um e-mail automaticamente pelo sistema com a nova senha gerada.
                                    Caso não encontre o email verifique a caixa de "Lixo Eletronico" ou "Spam.
                                </p>
                                <hr>
                                <a href="javascript:history.back()" class="">
                                    <i class="glyphicon glyphicon-chevron-left"></i> Voltar para a página de acesso
                                </a>
                                 <hr>
                                <p>&COPY; Orbitive Agência Digital</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Componentes -->
    <script src="assets/js/componentes.min.js"></script>
</body>
</html>
