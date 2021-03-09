<?php
include 'inc/header.inc.php';

$usuario = new Usuario();
$usuarios = $usuario->selecionarTodosUsuarios("usu_nome ASC");
?>

            <div class="row">
                <div class="col-lg-12">                     
                    <h1 class="page-header">
                        <span class="fa fa-file-text fa-1x"> Usuários</span> 
                        <a href="<?=HTTP_ADMIN?>usuario/adicionar" style="color: white;" >
                            <button type="button" class="btn btn-success pull-right ">Adicionar Usuário</button>
                        </a>
                    </h1>                    
                </div>                
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr >
                                            <th class="col-lg-10">Nome</th>                                         
                                            <th class="col-lg-1">Atualizar</th> 
                                            <th class="col-lg-1">Remover</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        if($usuarios != null){
                                            foreach($usuarios as $usuario){
                                                ?>
                                                <tr>                                                    
                                                    <td class="col-lg-10"><?=$usuario->getUsu_nome()?></td>
                                                    <td class="col-lg-1"><a href="<?=HTTP_ADMIN?>usuario/editar/<?=$usuario->getId()?>" class="link_white" style="color:white" ><button type="button" class="btn btn  btn-info btn-block" >Atualizar</button></a></td>                                            
                                                    <td class="col-lg-1"><a href="<?=HTTP_ADMIN?>usuario/remover/<?=$usuario->getId()?>" class="link_white" style="color:white" ><button type="button" class="btn btn  btn-danger btn-block" >Remover</button></a></td>                                            
                                                </tr>                                                                                
                                                <?
                                            }
                                        }
                                        ?>                                        
                                    </tbody>
                                </table>
                            </div>
                           
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
 