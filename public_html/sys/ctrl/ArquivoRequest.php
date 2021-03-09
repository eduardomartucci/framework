<?php

/**
 * @package Control
 * @category FranquiaFoto
 */
require_once("/home/base/public_html/sys/inc/config.inc.php");

// INSTACIA AS ENTIDADES
$arquivo = new Arquivo();
$utils = new Utils();
$a_arquivo = new AuxilioArquivo();

switch ($_POST['acao']) {

    // ADICIONAR
    case "Adicionar":


        $a_arquivo->setAll($_POST['a_arquivo']);
        $a_arquivo->setAArArquivo($arquivo->adicionarArquivoOpcional(PATH_AUXILIO_ARQUIVO, $_FILES['arquivo']['name'], $_FILES['arquivo']['tmp_name']));
        $a_arquivo->adicionarAuxilioArquivo($a_arquivo);

        $utils->mensagem("Arquivo adicionado com sucesso!");
        $utils->direciona("/intranet/auxilio-arquivo/lista");

        break;

    // EDITAR
    case "Editar":

        $a_arquivo->setAll($_POST['franquiaFoto']);

        if ($_FILES['FotImagem']['name'] != NULL) {
            $a_arquivo->setFotImagem($arquivo->editarArquivoOpcional(PATH_FOTO, $_FILES['FotImagem']['name'], $_FILES['FotImagem']['tmp_name'], $_POST['FotImagemAtual']));
        }


        $a_arquivo->editarFranquiaFoto($a_arquivo);
        $utils->mensagem("FranquiaFoto editado com sucesso!");
         $utils->direciona("/intranet/galeria/fotos");

        break;

    // APAGAR VARIOS
    case "ApagarVarios":

        if (isset($_POST['franquiaFoto'])) {
            foreach ($_POST['franquiaFoto'] as $id) {
                $a_arquivo->selecionarFranquiaFotoPorId($id);

                //APAGAR IMG SE ESTIVER CADASTRADO
                if ($a_arquivo->getFotImagem() != null) {
                    $arquivo->apagarArquivo(PATH_FOTO . $a_arquivo->getFotImagem());
                }

                if (!$a_arquivo->apagarFranquiaFoto($a_arquivo->getId())) {
                    $utils->mensagem("Request Error: FranquiaFoto nуo apagado!");
                }
                $a_arquivo = new FranquiaFoto();
            }
            $utils->mensagem("FranquiaFoto(s) apagado(s) com sucesso!");
        }
        $utils->direciona("/intranet/galeria/fotos");

        break;

    // DEFAULT
    default:
        echo "Request Error: Operaчуo nуo definida para a entidade FranquiaFoto()";
        break;
}
?>