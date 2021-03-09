<?php
/**
 * @package Model
 * @category Utils
 */

class Utils {

    function __construct() { }

    /** 
     * Metodo Gerar URLs Amigaveis
     *
     * @return String texto formatado para utilização nos links
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->geraUrlAmigavel($noticia->getNotTitulo());
     * </code>
     *
     * @version 1.0
     * @author DM Tecnologia de Informação <atendimento@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    function geraUrlAmigavel( $texto ){

            // Converte para maiúscula o primeiro caractere
            $texto = strtolower($texto);

            // Retira os acentos
            $acentos = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
            $semAcentos = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
            $texto = str_replace($acentos, $semAcentos, $texto);

            // Retira os caracteres especiais
            $caracteres = array("(",")","*","<",">","!","+","-",'"',"'",",",".");
            $semCaracteres = array("","","","","","","","","","","","");
            $texto = str_replace ($caracteres, $semCaracteres, $texto);

            // Adiciona "-" nos espaços em branco
            $texto = str_replace (" ","-", $texto);

            return $texto;
    }


     public function limpaUrlString($lstr) {
        $lstr = $this->retiraAcentos($lstr);
        $lstr = strtolower($lstr);

        $array1 = array("(",")","*","<",">","!","+");
        $array2 = array("","","","","","","");

        $lstr = trim($lstr);
        $lstr = str_replace(" ","-",$lstr);

        return str_replace ($array1, $array2, $lstr);
    } 

    /**
     * Metodo Gera Senha Randomica
     *
     * @return String contedo a senha randomica
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->criaSenhaRandomica();
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function criaSenhaRandomica() {
        $caracteres = "abcdefghijkmnopqrstuvwxyz023456789ABCDEFGHIJLKMNOPQRSTUVWXYZ!@#*";

        $i = 0;
        $senha = '' ;

        while ($i <= 5) {
            $num = rand() % 64;
            $tmp = substr($caracteres, $num, 1);
            $senha = $senha . $tmp;
            $i++;
        }
        return $senha;
    }

    //CRIAR 2 CARACTERES BASEADO NO ID
    public function criaCaracteresRandomicaPorId($id) {
        $caracteres = "ABCDEFGHIJLKMNOPQRSTUVWXYZ";

        $i = 0;
        $texto = '' ;
        $aux = 5;
        while ($i <= 1) {
            $aux = $aux+168;
            $num = ($id+$aux) % 26;
            $tmp = substr($caracteres, $num, 1);
            $texto = $texto . $tmp;
            $i++;
        }
        return $texto;
    }

    /**
     * Metodo Gera Senha Randomica
     *
     * @return String contedo a senha randomica
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->criaSenhaRandomica();
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function criaSenhaRandomicaLetra() {
        $caracteres = "ABCDEFGHIJLKMNOPQRSTUVWXYZ";

        $i = 0;
        $senha = '' ;

        while ($i <= 1) {
            $num = rand() % 27;
            $tmp = substr($caracteres, $num, 1);
            $senha = $senha . $tmp;
            $i++;
        }
        return $senha;
    }

    /**
     * Metodo Exibir caixa de mensagem de operações do sistema
     *
     * @param $texto: String contendo uma mensagem de texto
     * @return String com a mensagem formatada com CSS
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->msg("teste");
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function mensagem($titulo,$texto = false, $tipo="resposta") {
        switch($tipo) {
            case "alerta":
                echo '<div id="mensagem_alerta"><strong>'. $texto . '</strong></div>';
                break;

            case "erro":
                echo '<h2 class="secundario">'.$titulo.'</h2>
                      <div class="box_conteudo">
                        <div class="ajuda">
                        '.$texto.'
                        </div>
                      </div>';
                break;

            case "sucesso":
                echo '<h2 class="secundario">'.$titulo.'</h2>
                      <div class="box_conteudo">
                        <div class="ajuda">
                        '.$texto.'
                        </div>
                      </div>';
                break;
            
            case "confirmacao":                                                                
                echo "\t\t\t".'<h2>'.$texto.'</h2>'."\n";

            case "resposta":
                echo '<div id="mensagem_sucesso"><strong>'. $titulo . '</strong></div>';
                break;
            break;
        }
    }

    /**
     * Metodo Exibir um alerta na janela do usuario
     *
     * @param $texto: String contendo uma mensagem de texto
     * @return o alert do javascript
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->alerta("teste");
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function alerta($msg) {
        echo "<script type'text/javascript'> alert('$msg');</script>";
        return;
    }

    /**
     * Metodo Redirecionar a pagina
     *
     * @param $pagina: String contendo a pagina para onde irá ser redirecionado
     * @param $tempo: Integer contendo o tempo de espera para o redirecionamento
     * @return o alert do javascript
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->direciona("teste");
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function direciona($pagina,$tempo=0) {
        echo "<meta http-equiv=\"refresh\" content=\"$tempo; url=$pagina\">";
        return;
    }

    /**
     * Metodo Retira Acentos
     *
     * @param $texto: String contendo a pagina para onde irá ser redirecionado
     * @return o texto sem os acentos
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->retirarAcentos("teste");
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function retiraAcentos( $texto ) {

        $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
        $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );

        return str_replace($array1, $array2, $texto);
    }

    /**
     * Metodo Limpa Strings
     *
     * @param $lstr: String contendo o texto a ser limpo
     * @return o texto limpo
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->retirarAcentos("teste");
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function limpaString($lstr) {
        $lstr = $this->retiraAcentos($lstr);
        $lstr = strtolower($lstr);

        $array1 = array("(",")","*","<",">","!","-","+");
        $array2 = array("","","","","","","","");

        $lstr = trim($lstr);
        $lstr = str_replace(" ","",$lstr);

        return str_replace ($array1, $array2, $lstr);
    }


    public function limpaStringPontos($lstr) {
        $lstr = $this->retiraAcentos($lstr);
        $lstr = strtolower($lstr);

        $array1 = array("(",")","*","<",">","!","-","+",".");
        $array2 = array("","","","","","","","","");

        $lstr = trim($lstr);
        $lstr = str_replace(" ","",$lstr);

        return str_replace ($array1, $array2, $lstr);
    }

    /**
     * Metodo Formata Valor
     *
     * @param $valor: Float contendo o valor a ser formatado
     * @param $tipo: String contendo o tipo a ser formatado P = Valor Formatado para português - I = Valor Desformatado em inglês
     * @return o valor formatado
     *
     * <code>
     * <?php
     * $utils = new Utils();
     * $utils->FormataValor("$valor");
     * </code>
     *
     * @version 1.0
     * @author Rodrigo Fabiano Xavier <rodrigo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function formataValor($valor,$tipo) {

        if($tipo == "P")
            $valorFormatado = number_format($valor,2,",",".");

        if($tipo == "I")
            $valorFormatado = (str_replace(",",".",str_replace(".","",$valor)));


        return $valorFormatado;
    }

    /**
     * Substitue Constante Por Variavel nos emails
     *
     * <code>
     * <?php

     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function substitueConstantePorVariavel($constante,$variavel,$texto) {

        return str_replace($constante, $variavel, $texto);
    }

    /**
     * Faz o canculo da porcentagem de acordo com os valores passados
     *
     * <code>
     * <?php
     * $utlis = new Utils();
     * echo $utlis->porcentagem($total,$valor) . "%".
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function porcentagem($total,$valor){
        return 100 - ($valor*100/$total);
    }

    /**
     * Faz o canculo da diferença de dois valores
     *
     * <code>
     * <?php
     * $utlis = new Utils();
     * echo "R$ ".$utlis->valorDiferenca($oferta->getOfeDe(), $oferta->getOfePor();
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function valorDiferenca($valorDe, $valorPara){

        $soma = $valorDe - $valorPara;
        if($soma > 999){
            return $this->formataValor($soma, "P");
        }else{
            return $this->formataValor(number_format(($soma),2), "P");
        }
        
        
    }

    function verificar_email($email){
       $mail_correcto = 0;
       //verifico umas coisas
       if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
          if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
             //vejo se tem caracter .
             if (substr_count($email,".")>= 1){
                //obtenho a terminação do dominio
                $term_dom = substr(strrchr ($email, '.'),1);
                //verifico que a terminação do dominio seja correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //verifico que o de antes do dominio seja correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }

    if ($mail_correcto)
       return 1;
    else
       return 0;
    }


    /* FORMULAS AUXILIAR COMGRU */

    function multiplicar($nro1,$nro2){
        return $nro1*$nro2;
    }

    public function valorPercentual($total,$perc){
        $porcentagem = $perc/100;
        return $porcentagem*$total;
    }



}
?>