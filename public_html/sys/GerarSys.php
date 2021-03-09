<?php
require_once("/home/orbitive6/public_html/sys/inc/config.inc.php");
?>
<section id="corpo" class="containers wrap border-n1">
    <header class="border-n1">
        <h3 class="display-inline-block">Gerar Sistema</h3>
    </header>
    <div class="cont_conteudo">
        <form id="form" action="GerarSysParte2.php" method="post" class="form form-horizontal center">
            <?
            $gerador = new geradora();
            $tabelas = $gerador->tabelas_geradas();

            if ($tabelas != NULL) {
                ?>
                <div class="form-row">
                    <label class="form-label" for="tabela">Tabela: </label>
                    <div class="form-controls">
                        <select id="tabela" name="tabela" required class="coluna-1-1">
                            <option value="">Por favor Selecione um tabela</option>
                            <?
                            foreach ($tabelas as $aux) {
                                ?>
                                <option value="<?= $aux['table'] ?>"><?= $aux['table'] ?> <?= $aux['implementado'] ?></option>    
                                <?
                            }
                            ?>
                        </select> 
                    </div>
                </div>

                <?
            }
            ?>
         
            
            <div class="form-row">
                <span class="form-label"></span>
                <div class="form-controls">
                   <input type="submit" name="botao" value="Próximo >>" id="botao" class="btn btn-primary" />
                </div>
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