<?
include './inc/header.ajax.php';

$cidade = new Cidade();
$cidades = $cidade->selecionarCidadesPorIdEstado($_GET['valor']);
?>
<label for="cidade"><span>*</span>Cidade</label>      
<select name="cliente[id_cidade]" class="form-control" required>
    <option>Selecione a cidade</option>
    <?
    if($cidades != NULL){
        foreach ($cidades as $cidade) {
            ?><option value="<?=$cidade->getId()?>"><?=$cidade->getCid_nome()?></option><?
        }
    }
    ?>
</select>  
<?
?>