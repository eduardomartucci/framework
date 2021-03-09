<?php
require_once("/home/base/public_html/sys/inc/config.inc.php");
session_destroy();
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

                            <!-- INICIO MSG ERRO -->

                                <? if ($_GET[erro] == '0') { ?>
                                <div id="mensagem" class="alert alert-danger">
                                    <small>Verifique seu usu&aacute;rio e/ou sua senha.</small>
                                </div>

                                    <?
                                }
                                if ($_GET[erro] == '1') {

                                    ?>                                
                                    <div id="mensagem" class="alert alert-danger">
                                        <small>Entre com email e senha novamente.</small>
                                    </div>
                                    <?
                                }
                                if ($_GET[erro] == '2') {

                                    ?>
                                    <div id="mensagem" class="alert alert-danger">                                    
                                        <small>Você não tem permissão para acessar esta página!</small>
                                    </div>
                                <? }

                                if ($_GET[erro] == '3') {

                                    ?>                                
                                    <div id="mensagem" class="alert alert-danger">
                                        <small>Sua sessão foi encerrada, entre novamente.</small>
                                    </div>
                                    <?
                                }
                                ?>
                            <!-- FIM MSG ERRO -->
                            <fieldset>
                                <legend class="text-color-n1" >Dados de acesso</legend>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="login" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Mantenha-me conectado">Mantenha-me conectado
                                    </label>
                                </div>
                                <input type="hidden" name="acao" value="Login" />
                                <button  class="btn btn-lg btn-success btn-block">Entrar</button>
                            </fieldset>
                            <div class="row text-center">
                                <hr>
                                <p><a href="recuperar-senha"><i class="glyphicon glyphicon-question-sign"></i> Esqueceu a senha ?</a></p>
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
    
