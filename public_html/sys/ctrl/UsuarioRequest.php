<?php
include("inc/header.inc.php");

// INSTACIA AS ENTIDADES
$utils      = new Utils();
$usuario    = new Usuario();

switch($_POST[acao]) {

    case "Adicionar":

        $usuario->setAll($_POST['usuario']);
        $usuario->setUsu_senha(md5($_POST['senha']));
        $usuario->adicionarUsuario($usuario);
        $utils->mensagem("Usuсrio adicionado com sucesso!");
        $utils->direciona(HTTP_ADMIN."usuario/listar");
        break;

    
    
    case "Editar":

        $usuario->setAll($_POST['usuario']);
        $_POST["senha"] == "" ? $usuario->setUsu_senha($_POST["senhaAntiga"]) : $usuario->setUsu_senha(md5($_POST["senha"]));
        $usuario->editarUsuario($usuario);
        $utils->mensagem("Usuсrio editado com sucesso!");
        $utils->direciona(HTTP_ADMIN."usuario/listar");
        break;

        
    default:
        echo "Request Error: Operaчуo nуo definida para a entidade Usuario()";
        break;
}
include("inc/footer.inc.php");
?>