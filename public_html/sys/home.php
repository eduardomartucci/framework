<?php
include 'inc/header.inc.php';
$data = new Data();
?>

<!-- /.row titulo da página-->
<div class="row">
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <h1 class="page-header"> <span class="fa fa-home fa-1x" > Home</span></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>                                                                                                                
<!-- /.row -->



<!-- /.row sistema em números-->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">6</div>
                        <div>Administradores</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Visualizar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">4</div>
                        <div>Faturas Abertas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Visualizar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>Novos Clientes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Visualizar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Chamados Abertos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Visualizar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->




<!-- /.row -->
<div class="row">  
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Inscrições nos Seminários
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-bar-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Perfil do Associado
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->


<!-- /.row gráficos -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Modalidade Seminário
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-pie-chart"></div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Modalidade Seminário
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-pie-chart2"></div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>    



<!-- /.row logs do sistema -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Logs do Sistema
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="timeline">
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge info"><i class="fa fa-save"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>


<?php
include("inc/footer.inc.php");
?>