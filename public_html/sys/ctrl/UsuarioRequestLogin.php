<?php
/**
 * @package Control
 * @category Franquia
 */
require_once("/home/base/public_html/sys/inc/config.inc.php");

// INSTACIA AS ENTIDADES
$utils = new Utils();
$usuario = new usuario();


switch ($_POST[acao]) {

    // LOGIN
    case "Login":

        if (empty($_SESSION[NOME_SESSAO]['chavePublica'])) {

            $xlogin = $_POST[login];
            $xsenha = $_POST[senha];

            if (isset($xlogin) && isset($xsenha)) {

                $xlogin = str_replace("'", "", $xlogin);
                $xlogin = str_replace(" or ", "", $xlogin);
                $xlogin = str_replace(" ", "", $xlogin);
                $xlogin = str_replace("\r", "", $xlogin);
                $xlogin = str_replace("\n", "", $xlogin);
                $xlogin = str_replace("=", "", $xlogin);
                $xlogin = str_replace(">", "", $xlogin);
                $xlogin = str_replace("<", "", $xlogin);
                $xlogin = str_replace("!=", "", $xlogin);

                $xsenha = str_replace("'", "", $xsenha);
                $xsenha = str_replace(" or ", "", $xsenha);
                $xsenha = str_replace(" ", "", $xsenha);
                $xsenha = str_replace("\r", "", $xsenha);
                $xsenha = str_replace("\n", "", $xsenha);
                $xsenha = str_replace("=", "", $xsenha);
                $xsenha = str_replace(">", "", $xsenha);
                $xsenha = str_replace("<", "", $xsenha);
                $xsenha = str_replace("!=", "", $xsenha);

                if ($usuario->autenticarUsuarioPorEmailSenha($xlogin, $xsenha)) {

                    $utils->direciona("/sys/home");
                    exit;
                } else {
                    $utils->direciona("../index.php?erro=0");
                    exit;
                }
            } else {
                $utils->direciona("../index.php?erro=1");
                exit;
            }
        } else {
            session_destroy();
            $utils->direciona("../index.php?erro=3");
            exit;
        }
        break;

    case "NovaSenha":

        $usuario->setEmail($_POST[UsuEmail]);

        $usuarioNovo = $usuario->selecionarUsuarioPorEmail($usuario->getEmail());

        if ($usuarioNovo) {

            $novaSenha = $utils->criaSenhaRandomica();

            $usuario->setSenha(md5($novaSenha));

            $usuario->editarUsuarioPorEmail($usuario);

            // MONTA O E-MAIL
            $email = new Email();
            $senha = $email->carregaHeader();
            $senha .= $email->selecionarNovaSenha();
            $senha = $utils->substitueConstantePorVariavel("SENHA_NOME", $usuarioNovo->UsuNome, $senha);
            $senha = $utils->substitueConstantePorVariavel("SENHA_EMAIL", $usuarioNovo->UsuEmail, $senha);
            $senha = $utils->substitueConstantePorVariavel("SENHA_NOVA_SENHA", $novaSenha, $senha);
            $senha = $utils->substitueConstantePorVariavel("SENHA_SYS", HTTP_ADMIN, $senha);
            $senha = $utils->substitueConstantePorVariavel("SYS_NOME", SYS_NOME, $senha);
            $senha .= $email->carregaFooter();

            $assunto = SYS_NOME . " - Nova Senha";
            // ENVIA O EMAIL DE CONFIMAÇÂO DA NOVA SENHA
            $email->enviarEmail($_POST[UsuEmail], EMAIL_CONTATO, $assunto, $senha, "eduardo.martucci@gmail.com", "html");

            $utils->alerta("Sua senha foi alterada e enviada com sucesso ! Por favor, verifique seu e-mail.");
            $utils->direciona(HTTP_ADMIN . "index.php");
        } else {

            $utils->alerta("O e-mail $_POST[email] não foi encontrado !");
            $utils->direciona(HTTP_ADMIN . "usuario_nova_senha.php");
            exit();
        }


        break;


    // DEFAULT
    default:
        echo "Request Error: Operação não definida para a entidade Usuario()";
        break;
}
?>