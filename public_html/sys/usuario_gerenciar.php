<?php
include 'inc/header.inc.php';
?>

            <div class="row">
                <div class="col-lg-12">                     
                    <h1 class="page-header">
                        <span class="fa fa-plus-circle fa-1x"> Usuários</span> 
                    </h1>                    
                </div>                
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            * campo obrigatório
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form"  action="<?=HTTP_ADMIN?>ctrl/usuario/request" method="post" >


                                        <div class="form-group">
                                            <label>*Nome</label>
                                            <input type="text" required name="usuario[usu_nome]" class="form-control"  title="Digite o nome" />
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>*Email</label>
                                            <input type="email" required name="usuario[usu_email]" class="form-control"  title="Digite o email" />
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>*Senha</label>
                                            <input type="password" required name="senha" class="form-control"  title="Digite a senha" />
                                            <p class="help-block"></p>
                                        </div>
                                        <input type="hidden" name="acao" value="Adicionar"  />
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->


                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


<?php
include 'inc/footer.inc.php';
?>
 