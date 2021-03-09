<?php
require_once("/home/orbitive6/public_html/sys/inc/config.inc.php");
?>
<section id="corpo" class="containers wrap border-n1">
    <header class="border-n1">
        <h3 class="display-inline-block">Gerar Sistema (Parte 3)</h3>
    </header>
    <div class="cont_conteudo">
        <?
         $gerador = new geradora();
         $retorno = $gerador->create($_POST);
         var_dump($retorno);
        ?> 
    </div>
</section>
<!-- INIT JAVASCRIPT -->
<script type="text/javascript">
    js.corner.init();
</script>
<?
include("inc/footer.php");
?>