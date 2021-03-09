<?php 
require_once("/home/orbitive6/public_html/sys/inc/config.inc.php");
?>
<section id="corpo" class="containers wrap border-n1">
    <header class="border-n1">
        <h3 class="display-inline-block">Gerar Sistema (Parte 2)</h3>
    </header>
    <div class="cont_conteudo">  
        <form name="form" method="post" action="GerarSysParte3.php">
            <br/>
            <fieldset>
                <legend>Adicionar / Editar</legend>

                <div class="coluna-1-1">
                    <table class="tabela">
                        <thead class="table-header border-n1">
                            <tr role="row" class="text-color-n1">
                                <th class="coluna-4-16">Aux</th>
                                <th class="coluna-4-16">Campo</th>
                                <th class="coluna-4-16">Tipo</th>
                                <th class="coluna-4-16 text-center">Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $gerador = new geradora();
                            $colunas = $gerador->pre_create($_POST['tabela']);

                            if ($colunas != NULL) {
                                foreach ($colunas as $coluna) {

                                    $tipo = "NAO SETADO";
                                    $detalhes = "";
                                    $nome_coluna = "NAO SETADO";

                                    $selected = NULL;
                                    
                                    //SEPARAR OS TIPOS        
                                    //INT
                                    if ($coluna["native_type"] == 'LONG') {
                                        $tipo = "INT";
                                        $selected = 'text';
                                    }

                                    if ($coluna["native_type"] == 'DATE') {
                                        $tipo = "DATE";
                                        $selected = 'text';
                                    }
                                    
                                    if ($coluna["native_type"] == 'TIMESTAMP') {
                                        $tipo = "TIMESTAMP";
                                        $selected = 'text';
                                    }

                                    if ($coluna["native_type"] == 'FLOAT') {
                                        $tipo = "FLOAT";
                                        $selected = 'text';
                                    }

                                    if ($coluna["native_type"] == 'VAR_STRING') {
                                        $tipo = "STRING";
                                        $selected = 'text';
                                    }

                                    if ($coluna["native_type"] == 'BLOB') {
                                        $tipo = "TEXT";
                                        $selected = 'textarea';
                                    }

                                    if ($coluna["native_type"] == 'STRING') {
                                        $tipo = "ENUM";
                                        $selected = 'enum';
                                    }
                                    
                                    
                                    if($tipo == "NAO SETADO"){
                                       $tipo .= " - ".$coluna["native_type"]; 
                                    }
                                    
                                    $nome_coluna = $coluna["name"];
                                    
                                    
                                    if ($coluna['flags'] != NULL) {
                                        foreach ($coluna['flags'] as $flag) {
                                            $detalhes .= $flag . "/";


                                            if ($flag == 'multiple_key') {
                                             $selected = 'select';  
                                            }
                                        }
                                    }
                                    $aux++;
                                    ?>
                                    
                                    <tr class="border-n2" style="background-color: bisque;">
                                        <td class="coluna-4-16">#<?= $aux ?></td>
                                        <td class="coluna-4-16"><?= $nome_coluna ?></td>
                                        <td class="coluna-4-16"><?= $tipo ?></td>
                                        <td class="coluna-4-16 text-center"><?= $detalhes ?></td>
                                    </tr>
                                    
                                    
                                    
                                    <tr class="border-n1">
                                        <td class="coluna-4-16"><input type="text" name="<?=$nome_coluna?>[label]"  class="coluna-1-1"  placeholder="Digite o titulo da label" /> </td>
                                        <td class="coluna-4-16"><input type="text" name="<?=$nome_coluna?>[id]"  class="coluna-1-1"  placeholder="Digite o id para esse input" /></td>
                                        <td class="coluna-4-16"><input type="text" name="<?=$nome_coluna?>[class]"  class="coluna-1-1"  placeholder="Digite o nome das classes desse campo" /></td>
                                        <td class="coluna-4-16 text-center"><span style="margin-right: 10px;">Required:<input name="<?=$nome_coluna?>[required]" type="checkbox" value="<?=$nome_coluna?>" data-tooltip title="Selecione para marcar como required"></span> <span>Visivel :<input name="<?=$nome_coluna?>[visivel]" type="checkbox" value="<?=$nome_coluna?>" data-tooltip title="Selecione para criar um input desse campo"></span></td>
                                    </tr>
                                    
                                    <tr class="border-n1">
                                        <td class="coluna-5-16" colspan="4">
                                            <select name="<?=$nome_coluna?>[tipo]" class="coluna-1-1" >
                                                <option value="">Selecione o tipo do input</option>
                                                <option value="text" <?=($selected == 'text')? 'selected="selected"' : ''?> >text</option>
                                                <option value="textarea" <?=($selected == 'textarea')? 'selected="selected"' : ''?>>textarea</option>
                                                <option value="enum" <?=($selected == 'enum')? 'selected="selected"' : ''?>>enum(Radio Buttons)</option>
                                                <option value="select" <?=($selected == 'select')? 'selected="selected"' : ''?>>select (Recomendado para Foreign Key)</option>
                                            </select>   
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr class="border-n1">
                                        <td class="coluna-4-16 text-center"><span style="margin-right: 10px;">Listar esse campo:  <input name="<?=$nome_coluna?>[listar]" type="checkbox" value="<?=$nome_coluna?>" data-tooltip title="Selecione caso queira que esse campo apareça na listagem"></span></td>
                                        <td class="coluna-4-16"><input type="text" name="<?=$nome_coluna?>[label_header_tabela]"  class="coluna-1-1"  placeholder="Título do header (table)" /> </td>
                                        <td class="coluna-4-16" colspan="2"><input type="text" name="<?=$nome_coluna?>[tamanho_coluna]"  class="coluna-1-1"  placeholder="Coluna-X-16 (tamanho TOTAL máximo = 14)" /></td>
                                        <!--<td class="coluna-4-16"><input type="text" name="<?=$nome_coluna?>[class]"  class="coluna-1-1"  placeholder="Digite o nome das classes desse campo" /></td>-->
                                    </tr>
                                    
                           <?
                                }
                            } else {
                                ?>
                                <tr class="border-n2">
                                    <td class="coluna-1-1">Não foi possível encontrar nenhum registro.</td>
                                </tr>
                            <? }
                            ?>
                        </tbody>
                    </table>
            </fieldset>    
            <br />

            <div class="coluna-1-1">
                <input type="hidden" name="tabela" value="<?=$_POST['tabela']?>">
                <input type="submit" name="botao" class="btn-degrade-cinza float-right" value="Finalizar >>" />
            </div>
        </form>    
    </div>
</section>
<!-- INIT JAVASCRIPT -->
<script type="text/javascript">
    js.corner.init();
</script>
<?
include("inc/footer.php");
?>
 <?