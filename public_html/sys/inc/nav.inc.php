<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand img-responsive" href="<?= HTTP_ADMIN ?>home"><img src="<?= HTTP_ADMIN ?>img/logo.png"></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="#">

                        <div>Não foi possível encontrar registros</div>
                    </a>
                </li>
                <li class="divider"></li>

                <li>
                    <a class="text-center" href="#">
                        <strong>Leia todos as mensagens</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->


        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="<?= HTTP_ADMIN ?>administrador"><i class="fa fa-user fa-fw"></i> Dados do usuário</a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="<?= HTTP_ADMIN ?>logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="home"><i class="fa fa-home fa-fw"></i>Painel</a>
                </li>
                <li id="usuario">
                    <a href="#"><i class="fa fa-user fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= HTTP_ADMIN ?>usuario/adicionar">Adicionar</a>
                        </li>
                        <li>
                            <a href="<?= HTTP_ADMIN ?>usuario/listar">Listar</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li class="divider"></li>
                <li id="associado">
                    <a href="#"><i class="fa fa fa-users fa-fw"></i> Associados<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= HTTP_ADMIN ?>usuario/adicionar">Adicionar</a>
                        </li>
                        <li>
                            <a href="<?= HTTP_ADMIN ?>usuario/listar">Listar</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                
                <!-- /.nav terceiro nivel -->
                <li class="">
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Financeiro<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li>
                            <a href="<?= HTTP_ADMIN ?>periodicidade/listar">Periodicidade</a>
                        </li>

                        <li>
                            <a href="#">Grupo de Custo<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse" aria-expanded="true">
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>grupo_custo/listar">Todos</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>grupo_custo/listar/receber">Receber</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>grupo_custo/listar/pagar">Pagar</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>



                        <li>
                            <a href="#">Centro de Custo<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse" aria-expanded="true">
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>centro_custo/listar">Todos</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>centro_custo/listar/receber">Receber</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>centro_custo/listar/pagar">Pagar</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                        
                        
                        <li>
                            <a href="<?= HTTP_ADMIN ?>conta_receber/listar">Contas a receber</a>
                        </li>


                         <li>
                            <a href="#">Fatura<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse" aria-expanded="true">
                                 <li>
                                    <a href="<?= HTTP_ADMIN ?>fatura/buscar">Gerar Faturas</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>fatura/listar">Todas</a>
                                </li>
                                <li>
                                    <a href="<?= HTTP_ADMIN ?>fatura/aberta">Abertas</a>
                                </li>
                                <li>
                                      <a href="<?= HTTP_ADMIN ?>fatura/fechada">Fechadas</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>




                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="home"><i class="fa fa-crop fa-fw"></i>Sair</a>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
