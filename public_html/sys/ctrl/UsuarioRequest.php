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
        $utils->mensagem("Usu�rio adicionado com sucesso!");
        $utils->direciona(HTTP_ADMIN."usuario/listar");
        break;

    
    
    case "Editar":

        $usuario->setAll($_POST['usuario']);
        $_POST["senha"] == "" ? $usuario->setUsu_senha($_POST["senhaAntiga"]) : $usuario->setUsu_senha(md5($_POST["senha"]));
        $usuario->editarUsuario($usuario);
        $utils->mensagem("Usu�rio editado com sucesso!");
        $utils->direciona(HTTP_ADMIN."usuario/listar");
        break;

        
    default:
        echo "Request Error: Opera��o n�o definida para a entidade Usuario()";
        break;
}
include("inc/footer.inc.php");
?>