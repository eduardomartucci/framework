<?
include ("inc/header.inc.php");
?>
            <div class="row">
                <div class="col-lg-12">                     
                    <h1 class="page-header">
                        <span class="fa fa-sign-out fa-1x"> Logout</span> 
                    </h1>                    
                </div>                
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Saindo do sistema...
                        </div>
                        <?php
                        session_destroy();
                        ?>
                        <div class="panel-body">
                            <p>
                                Sua conexão foi encerrada com sucesso !
                            </p>
                            <p>
                                Você será direcionado em 5 segundos...
                            </p>
                            <p>
                                <strong>Obrigado por utilizar o sistema.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
<?php
include ("inc/footer.inc.php");
$utils = new Utils();
$utils->direciona(HTTP_ADMIN,5);
?>