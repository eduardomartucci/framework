<?php

/**
 * @package Model
 * @category Data
 */

/**
 * Classe Data
 *
 * @todo
 *
 * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
 * @copyright Copyright (c) 2009 DM Produções Ltda. ME
 */
class Data {

    public function __construct() {
        
    }

    /**
     * Conversao de formatos de datas do banco de dados
     *
     * @param $data string contendo a data que precisa ser convertida
     * @param $tipo controla o tipo de conversao, sendo que o valor 'P' transformar a data de timestamp para o formato em portugues e 'T' faz o inverso.
     *
     * @return string com a data convertida
     *
     * <code>
     * <?php
     * 	$data = new Data();
     * 	$data->formatarData($_POST[data],"P");
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @author Renato Keiti Sukomine <renato@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function formatarData($data, $tipo) {

        switch ($tipo) {

            case 'P':
                $data_array = explode(" ", $data);
                $data_2 = explode("-", $data_array[0]);
                return "$data_2[2]/$data_2[1]/$data_2[0]";
                break;

            case 'I':
                $data_array = explode(" ", $data);
                $data_2 = explode("/", $data_array[0]);
                return "$data_2[2]-$data_2[1]-$data_2[0]";
                break;

            case 'CI':
                $data_array = explode(" ", $data);
                return $data_array[0];
                break;

            case 'CT':
                $data_array = explode(" ", $data);
                return $data_array[1];
                break;

            case 'T':
                $data_array = explode("/", $data);
                return "$data_array[2]-$data_array[1]-$data_array[0]";
                break;

            case 'D':
                $data_array = explode(" ", $data);
                $data_2 = explode("-", $data_array[0]);
                return $data_2[2];
                break;

            case 'M':
                $data_array = explode(" ", $data);
                $data_2 = explode("-", $data_array[0]);
                return $data_2[1];
                break;

            case 'A':
                $data_array = explode(" ", $data);
                $data_2 = explode("-", $data_array[0]);
                return $data_2[0];
                break;

            case 'CD':
                $data_array = explode(" ", $data);
                $data_2 = explode("-", $data_array[0]);
                return $this->lwtDataMes($data_2[1]) . " " . $data_2[2] . ', ' . $data_2[0] . " " . $data_array[1];
                break;
        }
    }

    /**
     * Pegar a data atual por extenso
     * 
     * @param $tipo: Controla qual o tipo da data sera retornada sendo DMA para data completa e M para apenas o mes
     * @param $english_month: 
     * 
     * @return string com a data por extenso
     * 
     * <code>
     * <?php
     * 	$data = new Data();
     * 	$data->formatarDataPorExtenso($_POST[data],"P");
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo@dmti.com.br>
     * @author Renato Keiti Sukomine <renato@dmti.com.br>
     * @copyright Copyright (c) 2009 DM Produções Ltda. ME
     */
    public function lwtDataMes($english_month) {
        switch ($english_month) {

            case "01";
                $portuguese_month = "January";
                break;

            case "02";
                $portuguese_month = "February";
                break;

            case "03";
                $portuguese_month = "March";
                break;

            case "04";
                $portuguese_month = "April";
                break;

            case "05";
                $portuguese_month = "May";
                break;

            case "06";
                $portuguese_month = "June";
                break;

            case "07";
                $portuguese_month = "July";
                break;

            case "08";
                $portuguese_month = "August";
                break;

            case "09";
                $portuguese_month = "September";
                break;

            case "10";
                $portuguese_month = "October";
                break;

            case "11";
                $portuguese_month = "November";
                break;

            case "12";
                $portuguese_month = "December";
                break;
        }

        return $portuguese_month;
    }

    public function formatarDataPorExtenso($tipo, $english_month = 0) {
        $english_day = date('w');
        if ($english_month == 0)
            $english_month = date('n');
        $ano = date('Y');
        switch ($english_day) {
            case "Monday":
                $portuguese_day = "Segunda-Feira";
                break;
            case "Tuesday";
                $portuguese_day = "Terça-Feira";
                break;
            case "Wednesday";
                $portuguese_day = "Quarta-Feira";
                break;
            case "Thursday";
                $portuguese_day = "Quinta-Feira";
                break;
            case "Friday";
                $portuguese_day = "Sexta-Feira";
                break;
            case "Saturday";
                $portuguese_day = "Sábado";
                break;
            case "Sunday";
                $portuguese_day = "Domingo";
                break;
        }

        switch ($english_month) {

            case "1";
                $portuguese_month = "Janeiro";
                break;

            case "2";
                $portuguese_month = "Fevereiro";
                break;

            case "3";
                $portuguese_month = "Março";
                break;

            case "4";
                $portuguese_month = "Abril";
                break;

            case "5";
                $portuguese_month = "Maio";
                break;

            case "6";
                $portuguese_month = "Junho";
                break;

            case "7";
                $portuguese_month = "Julho";
                break;

            case "8";
                $portuguese_month = "Agosto";
                break;

            case "9";
                $portuguese_month = "Setembro";
                break;

            case "10";
                $portuguese_month = "Outubro";
                break;

            case "11";
                $portuguese_month = "Novembro";
                break;

            case "12";
                $portuguese_month = "Dezembro";
                break;
        }

        switch ($tipo) {

            case "DMA";
                return $portuguese_day . date("d") . " de " . $portuguese_month . " de " . $ano;
                break;

            case "M";
                return $portuguese_month;
                break;
        }
    }

    /**
     * Somar a data.
     *
     * @param $data string contendo a data a ser somada
     * @param $dias dias a ser somado
     * @param $meses meses a ser somado
     * @param $ano ano a ser somado
     * 
     * @return string com a data final
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function somarData($data, $dias, $meses = 0, $ano = 0) {
        //passe a data no formato dd/mm/yyyy
        $data = explode("/", $data);
        $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));

        return $newData;
    }

    public function subtrairData($data, $dias, $meses = 0, $ano = 0) {
        //passe a data no formato dd/mm/yyyy
        $data = explode("/", $data);
        $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] - $meses, $data[0] - $dias, $data[2] - $ano));

        return $newData;
    }

    public function diasEntreDuasDatas($dataIni, $dataFim) {
        //calculo timestam das duas datas
        $timestamp1 = mktime(0, 0, 0, $this->formatarData($dataIni, "M"), $this->formatarData($dataIni, "D"), $this->formatarData($dataIni, "A"));
        $timestamp2 = mktime(4, 12, 0, $this->formatarData($dataFim, "M"), $this->formatarData($dataFim, "D"), $this->formatarData($dataFim, "A"));

        //diminuo a uma data a outra
        $segundos_diferenca = $timestamp1 - $timestamp2;
        //converto segundos em dias
        $dias_diferenca = $segundos_diferenca / (60 * 60 * 24);
        //obtenho o valor absoulto dos dias (tiro o possível sinal negativo)
        $dias_diferenca = abs($dias_diferenca);
        //tiro os decimais aos dias de diferença
        $dias_diferenca = floor($dias_diferenca);

        return $dias_diferenca;
    }

    public function formatarMesExtenso($mes) {
        switch ($mes) {

            case "1";
                $portuguese_month = "Janeiro";
                break;

            case "2";
                $portuguese_month = "Fevereiro";
                break;

            case "3";
                $portuguese_month = "Março";
                break;

            case "4";
                $portuguese_month = "Abril";
                break;

            case "5";
                $portuguese_month = "Maio";
                break;

            case "6";
                $portuguese_month = "Junho";
                break;

            case "7";
                $portuguese_month = "Julho";
                break;

            case "8";
                $portuguese_month = "Agosto";
                break;

            case "9";
                $portuguese_month = "Setembro";
                break;

            case "10";
                $portuguese_month = "Outubro";
                break;

            case "11";
                $portuguese_month = "Novembro";
                break;

            case "12";
                $portuguese_month = "Dezembro";
                break;
        }

        return $portuguese_month;
    }

    
    /**
     * Retorna a data por extenso.
     *
     * @param $data string contendo a data a ser formatada (ingles)
     * @param $lingua, idioma o qual deve ser retornado
     * 
     * @return string com a data por extenso
     *
     * @version 1.0
     * @author Amaury Hideo Shimizu Higa <amaury@dmti.com.br>
     * @copyright Copyright (c) 2010 DM Produções Ltda. ME
     */
    public function formatarDataExtenso($data,$id_lingua = null) {
        //SETANDO VARIAVEL DE LOCAL E LINGUA
        date_default_timezone_set('America/Sao_Paulo');
        
        if($id_lingua == NULL || $id_lingua == LINGUA_PT){
           setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' ); 
           $data_formatada =  strftime('%A, %d de %B de %Y', strtotime($data));
        }
        if($id_lingua == LINGUA_EN){
            setlocale(LC_ALL,"US");
            $data_formatada =  strftime('%B, %A (%d), %Y', strtotime($data));
        }
        if($id_lingua == LINGUA_ES){
            setlocale(LC_ALL,"ESP");
            $data_formatada =  strftime('%A, %d de %B de %Y', strtotime($data));
        }
        

        

        return $data_formatada;
    }

}

?>