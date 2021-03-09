<?php
include './inc/header.inc.php';

$usuario = new Usuario();
$usuario->selecionarUsuarioPorId($_GET['id']);
?>

            <div class="row">
                <div class="col-lg-12">                     
                    <h1 class="page-header">
                        <span class="fa fa-edit fa-1x"> Usuários</span> 
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
                                    <form role="form"  action="<?=HTTP_ADMIN?>/ctrl/usuario/request" method="post" >


                                       <div class="form-group">
                                            <label>*Nome</label>
                                            <input type="text" value="<?=$usuario->getUsu_nome()?>" required name="usuario[usu_nome]" class="form-control"  title="Digite o nome" />
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>*Email</label>
                                            <input type="email" value="<?=$usuario->getUsu_email()?>" required name="usuario[usu_email]" class="form-control"  title="Digite o email" />
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>Nova senha</label>
                                            <input type="password" name="senha" class="form-control"  title="Digite a senha" placeholder="Caso não queira alterar a senha deixe esse campo em branco" />
                                            <p class="help-block"></p>
                                        </div>


                                        <input type="hidden" name="acao" value="Editar"/>
                                        <input type="hidden" name="usuario[id_usuario]" value="<?=$usuario->getId()?>"/>
                                        <input type="hidden" name="senhaAntiga" value="<?=$usuario->getUsu_senha()?>"/>
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
include './inc/footer.inc.php';
?>
 