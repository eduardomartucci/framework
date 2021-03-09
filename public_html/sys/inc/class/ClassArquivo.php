<?php
/**
 * @package Model
 * @category Arquivo
 */

/**
 * Classe Arquivo
 *
 * @todo metodo atualizado para redimencionar imagem
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */

class Arquivo {

    private $utils;

    function __construct() {
        $this->utils = new Utils();
    }

    /**
     * Metodo Adicionar Arquivo
     *
     * @param $destino: string contendo o path (destino) do arquivo
     * @param $imagemNome: string contendo o nome da imagem que foi enviada
     * @param $imagemTemporario: string contendo o nome temporario da imagem que foi enviada
     *
     * @return boolean true: se enviado, false: se não inserido
     *
     * <code>
     * <?php
     * $arquivo 	= new Arquivo();
     * $destino 	= PATH_IMAGENS_NOTICIAS . $_FILES['imagem']['name'];
     * if( $arquivo->adicionarArquivo($destino,$_FILES['imagem']['name'],$_FILES['imagem']['tmp_name']) ){
     * 	..outros comandos..
     * }else {
     * 	echo("Request Error: Não foi possivel inserir o arquivo!");
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionarArquivo($path,$arquivoNome,$arquivoTemporario) {

        if( is_uploaded_file($arquivoTemporario) ) {
            if( move_uploaded_file($arquivoTemporario,$path . $arquivoNome) ) {
                return true;
            }else {
                $this->utils->mensagem("Erro ao enviar a arquivo!","erro");
                return false;
            }

        }
    }

    /**
     * Metodo Adicionar Arquivo Opcional
     *
     * @param $path: string contendo o path (destino) do arquivo
     * @param $logoNome: string contendo o nome da imagem que foi enviada
     * @param $logoTemporario: string contendo o nome temporario da imagem que foi enviada
     *
     * @return boolean true: se enviado, false: se não inserido
     *
     * <code>
     * <?php
     * $arquivo = new Arquivo();
     * $destino = PATH_LOGO_CLIENTE . $_FILES['logo']['name'];
     * if( $arquivo->adicionarArquivo($destino,$arquivoNome,$arquivoTemporario) ){
     * 	..outros comandos..
     * }else {
     * 	echo("Request Error: Não foi possivel inserir o logo!");
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Rodrigo Fabiano Xavier <rodrigo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function adicionarArquivoOpcional($path,$arquivoNome,$arquivoTemporario) {

        if(isset($arquivoNome)) {
            $time = time();
            $arquivoNome = $this->utils->limpaString($time."_".$arquivoNome);
            if( $this->adicionarArquivo($path,$arquivoNome,$arquivoTemporario) ) {
                return $arquivoNome;
            } else {
                $this->utils->mensagem("Request Error: Não foi possivel enviar o arquivo!","erro");
            }
        }

    }

    /**
     * Metodo Apagar Arquivo
     *
     * @param $arquivo: string contendo o nome do arquivo a ser apagado
     *
     * @return boolean true: se apagado, false: se não inserido
     *
     * <code>
     * <?php
     * $arquivo 	= new Arquivo();
     * $arq 		= PATH_IMAGENS_NOTICIAS . $noitica->not_imagem;
     * if( $arquivo->apagarArquivo($arq) ){
     * 	echo "Arquivo apagado com sucesso !";
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function apagarArquivo($arquivo) {

        if( unlink($arquivo) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Metodo Editar Arquivo
     *
     * @param $path: string contendo caminho real (caminho) da pasta do arquivo
     * @param $arquivoNome: string contendo o nome do arquivo que foi enviado
     * @param $arquivoTemporario: string contendo o nome temporario do arquivo que foi enviado
     * @param $arquivoAtual: string contendo o nome do arquivo atual que será editado
     *
     * @return boolean true: se enviado, false: se não inserido
     *
     * <code>
     * <?php
     * $arquivo 	= new Arquivo();
     * $path 	= PATH_IMAGENS_NOTICIAS;
     * if( $arquivo->editarArquivo($path, $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name'], $_POST['imagem_atual']) ){
     * 	..outros comandos..
     * }else {
     * 	echo("Request Error: Não foi possivel editar o arquivo!");
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function editarArquivo($path,$arquivoNome,$arquivoTemporario,$arquivoAtual) {

        // Inseri o novo arquivo
       if( $this->adicionarArquivo($path,$arquivoNome,$arquivoTemporario) ) {
            // Apaga o arquivo antigo
            if( !$this->apagarArquivo($path . $arquivoAtual) ) {
                $this->utils->mensagem("Error ao apagar arquivo !","erro");
            }
            return $arquivoNome;
        } else {
            $this->utils->mensagem("Error ao enviar a arquivo !","erro");
            return false;
        }
    }

    /**
     * Metodo Editar Arquivo Opcional
     *
     * @param $path: string contendo caminho real (caminho) da pasta do arquivo
     * @param $arquivoNome: string contendo o nome do arquivo que foi enviado
     * @param $arquivoTemporario: string contendo o nome temporario do arquivo que foi enviado
     * @param $arquivoAtual: string contendo o nome do arquivo atual que será editado
     *
     * @return boolean true: se enviado, false: se não inserido
     *
     * <code>
     * <?php
     * $arquivo = new Arquivo();
     * $path 	= PATH_LOGO_CLIENTE;
     * if( $arquivo->editarArquivoOpcional($path,$arquivoNome,$arquivoTemporario,$arquivoAtual]) ){
     * 	..outros comandos..
     * }else {
     * 	echo("Request Error: Não foi possivel editar o logo!");
     * }
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Rodrigo Fabiano Xavier <rodrigo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function editarArquivoOpcional($path,$arquivoNome,$arquivoTemporario,$arquivoAtual) {
        $time = time();
        if($arquivoNome != "") {
            $arquivoNome = $this->utils->limpaString($time."_".$arquivoNome);
            if( $this->editarArquivo($path,$arquivoNome, $arquivoTemporario, $arquivoAtual) ) {
                return $arquivoNome;
            } else {
                $this->utils->mensagem("Novo arquivo não enviado");
            }
        } else {
            return $arquivoAtual;
        }
    }

	/*
	  *************************************************************
	  Objetivo : Redimencionar Imagem
	  **************************************************************
	  Entradas :
			$src = original image location
			$dst = destination image location
			$dstx = user defined width of image
			$dsty = user defined height of image

	  Saídas :
		- (sem saida)

	  Variáveis Internas:
		- (sem variaveis)
	*************************************************************
	*/

    public function redimencionarImagem($src, $dst, $dstx, $dsty) {

        $allowedExtensions = 'jpg jpeg gif png';

        $name = explode(".", $src);
        $currentExtensions = $name[count($name)-1];
        $extensions = explode(" ", $allowedExtensions);

        // Verifica se a extensão é válida
        for($i=0; count($extensions)>$i; $i=$i+1) {
            if($extensions[$i]==strtolower($currentExtensions)) {
                $extensionOK = 1;
                $fileExtension=strtolower($extensions[$i]);
                break;
            }
        }

        if($extensionOK) {
            $size = getImageSize($src);
            $width = $size[0];
            $height = $size[1];
            if($width >= $dstx AND $height >= $dsty) {
                $proportion_X = $width / $dstx;
                $proportion_Y = $height / $dsty;
                if($proportion_X > $proportion_Y ) {
                    $proportion = $proportion_Y;

                } else {
                    $proportion = $proportion_X ;
                }

                $target['width'] = $dstx * $proportion;
                $target['height'] = $dsty * $proportion;
                $original['diagonal_center'] =
                    round(sqrt(($width*$width)+($height*$height))/2);
                $target['diagonal_center'] =
                    round(sqrt(($target['width']*$target['width'])+
                    ($target['height']*$target['height']))/2);
                $crop = round($original['diagonal_center'] - $target['diagonal_center']);

                if($proportion_X < $proportion_Y ) {
                    $target['x'] = 0;
                    $target['y'] = round((($height/2)*$crop)/$target['diagonal_center']);
                } else {
                    $target['x'] =  round((($width/2)*$crop)/$target['diagonal_center']);
                    $target['y'] = 0;
                }

                if($fileExtension == "jpg" OR $fileExtension=='jpeg') {
                    $from = ImageCreateFromJpeg($src);

                } elseif ($fileExtension == "gif") {
                    $from = ImageCreateFromGIF($src);

                } elseif ($fileExtension == 'png') {
                    $from = imageCreateFromPNG($src);
                }

                $new = ImageCreateTrueColor ($dstx,$dsty);
                imagecopyresampled ($new,  $from,  0, 0, $target['x'],
                    $target['y'], $dstx, $dsty, $target['width'], $target['height']);

                if($fileExtension == "jpg" OR $fileExtension == 'jpeg') {
                    imagejpeg($new, $dst);
                }
                elseif ($fileExtension == "gif") {
                    imagegif($new, $dst);
                }
                elseif ($fileExtension == 'png') {
                    imagepng($new, $dst);
                }
            }

        }

    }


	/*
	  *************************************************************
	  Objetivo : Redimencionar Imagem
	  **************************************************************
	 <img src="/path/to/thumbnail.php?gd=N&src=/path/to/image.EXT&maxw=NNN" />

	 where N = the GD library version (supported values are 1 and 2)
	 EXT = the file extension of the image file
	 (supported values are gif (if gd = 2), jpg and png)
	 NNN = the desired maximum width of the thumbnail


	  Entradas :
			$src = original image location
			$dst = destination image location
			$dstx = user defined width of image
			$dsty = user defined height of image

	  Saídas :
		- (sem saida)

	  Variáveis Internas:
		- (sem variaveis)
	*************************************************************
	*/


    private function ErrorImage ($text) {
        global $maxw;
        $len = strlen ($text);
        if ($maxw < 154) $errw = 154;
        if ($maxw < 70) $errw = 70;
        $errh = 30;
        $chrlen = intval (5.9 * $len);
        $offset = intval (($errw - $chrlen) / 2);
        $im = imagecreate ($errw, $errh); /* Create a blank image */
        $bgc = imagecolorallocate ($im, 153, 63, 63);
        $tc = imagecolorallocate ($im, 255, 255, 255);
        imagefilledrectangle ($im, 0, 0, $errw, $errh, $bgc);
        imagestring ($im, 2, $offset, 7, $text, $tc);
        header ("Content-type: image/jpeg");
        imagejpeg ($im);
        imagedestroy ($im);
        exit;
    }

    //thumbnail ($_GET["gd"], $_GET["src"], $_GET["maxw"]);
    public function thumbnail ($gdver, $src, $maxw=190) {

        $gdarr = array (1,2);
        for ($i=0; $i<count($gdarr); $i++) {
            if ($gdver != $gdarr[$i]) $test.="|";
        }
        $exp = explode ("|", $test);
        if (count ($exp) == 3) {
            ErrorImage ("Incorrect GD version!");
        }

        if (!function_exists ("imagecreate") || !function_exists ("imagecreatetruecolor")) {
            ErrorImage ("No image create functions!");
        }

        $size = @getimagesize ($src);
        if (!$size) {
            ErrorImage ("sem foto");
        } else {

            if ($size[0] > $maxw) {
                $newx = intval ($maxw);
                $newy = intval ($size[1] * ($maxw / $size[0]));
            } else {
                $newx = $size[0];
                $newy = $size[1];
            }

            if ($gdver == 1) {
                $destimg = imagecreate ($newx, $newy );
            } else {
                $destimg = @imagecreatetruecolor ($newx, $newy ) or die (ErrorImage ("Cannot use GD2 here!"));
            }

            if ($size[2] == 1) {
                if (!function_exists ("imagecreatefromgif")) {
                    ErrorImage ("Cannot Handle GIF Format!");
                } else {
                    $sourceimg = imagecreatefromgif ($src);

                    if ($gdver == 1)
                        imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
                    else
                        @imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));

                    header ("content-type: image/gif");
                    imagegif ($destimg);
                }
            }
            elseif ($size[2]==2) {
                $sourceimg = imagecreatefromjpeg ($src);

                if ($gdver == 1)
                    imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
                else
                    @imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));

                header ("content-type: image/jpeg");
                imagejpeg ($destimg);
            }
            elseif ($size[2] == 3) {
                $sourceimg = imagecreatefrompng ($src);

                if ($gdver == 1)
                    imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
                else
                    @imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));

                header ("content-type: image/png");
                imagepng ($destimg);
            }
            else {
                ErrorImage ("Image Type Not Handled!");
            }
        }

        imagedestroy ($destimg);
        imagedestroy ($sourceimg);
    }

    /**
     * ABRE ARQUIVO DE IMAGEM DE ACORDO COM A EXTENSAO
     *
     * @param string $file
     * @return imagem
     */

    public function open_image ($file) {
        $im = @imagecreatefromjpeg($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromgif($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefrompng($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromgd($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromgd2($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromwbmp($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromxbm($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromxpm($file);
        if ($im != false) { return $im; }
        $im = @imagecreatefromstring(file_get_contents($file));
        if ($im != false) { return $im; }
        return false;
    }

    /**
     * REDIMENSIONA IMAGEM (SEM CORTAR IMAGEM)
     *
     * @param string $im
     * @param integer $la
     * @param integer $al
     */

    public function redimensionaImage($im, $la='50%', $al = '0') {
    //Seta todas as strings como 'string'
        settype($la, "string");
        settype($al, "string");
        // Carrega Imagem
        $image = $this->open_image($im);
        if ($image == false) {
            die ('<strong>Erro ao abrir imagem</strong>');
        }
        // Pega os tamanhos originais
        $width = imagesx($image);
        $height = imagesy($image);
        // Checa o redimensionamendo, se é feito por % ou px
        if (ereg("[0-9]{1,3}%",$la,$lixo)) {
            $size = str_replace("%","",$la);
            settype($size, "integer");
            $percent = floatval($la);
            $percent /= 100;
            $new_width = $width * $percent;
            $new_height = $height * $percent;
        }
        elseif (isset($la) && $al == '0' && !$al && $al == 0) {
            settype($la, "integer");
            $new_width = floatval($la);
            $new_height = $height * ($new_width/$width);
        // Se apenas altura foi definida
        }
        elseif (isset($al) && $la == '0' && !$la && $la == 0) {
            settype($al, "integer");
            $new_height = floatval($al);
            $new_width = $width * ($new_height/$height);
        // Nova Largura e nova altura;
        }
        elseif (isset($la) && isset($al)) {
            $new_height = floatval($al);
            $new_width = floatval($la);
        } else {
            die ('<strong>Nenhum tamanho foi especificado!</strong>');
        }
        $image_resized = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        imagejpeg($image_resized,$im);
    }


} //fim da classe


?>