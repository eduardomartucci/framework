var js = {
    tiny:
            {
                init: function ()
                {


                    tinyMCE.init({
                        elements: "tinyMCE,tinyMCE2,tinyMCE3",
                        mode: "textareas",
                        theme: "modern",
                        language: 'pt_BR',
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "table contextmenu directionality emoticons template textcolor paste textcolor moxiemanager"
                        ],
                        /**
                         toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                         toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
                         toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
                         **/
                        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                        toolbar2: "cut copy paste |  bullist numlist | outdent indent blockquote | undo redo | link unlink insertfile image code | inserttime preview ",
                        toolbar3: "forecolor backcolor | table | hr removeformat | subscript superscript |  fullscreen | ltr rtl | spellchecker ",
                        height: 300,
                        relative_urls: false,
                        remove_script_host: false,
                        document_base_url: ""
                    });


                },
                simple: function ()
                {
                    tinyMCE.init({
                        elements: "tinyMCE,tinyMCE2,tinyMCE3",
                        mode: "textareas",
                        theme: "modern",
                        height: 300,
                        language: 'pt_BR',
                        theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect",
                        theme_advanced_buttons2: "",
                        theme_advanced_buttons3: "",
                        theme_advanced_buttons4: ""
                    });
                }

            },
    tabs:
            {
                init: function ()
                {
                    $("#tabs").tabs();
                },
                tabIndex: function (index)
                {
                    $("#tabs").tabs("option", "selected", index);
                }


            },
    dataTables:
            {
                init: function ()
                {
                    $('.dataTable').dataTable({
                        "sPaginationType": "full_numbers"
                    });
                }
            },
    dataPicker:
            {
                init: function ()
                {
                    $(".data").datepicker({
                        showOn: 'focus',
                        buttonImage: 'img/calendar.gif',
                        dateFormat: 'dd/mm/yy'
                    });
                }

            },
    checkAll:
            {
                init: function ()
                {
                    //CHECAR
                    //SELECIONAR TODOS CHECKBOX COM A CLASS .cinput
                    //LISTAGEM
                    var checkall = 0;
                    $('.todos').click(function () {
                        $(":checkbox").each(function () {
                            if (checkall == 0)
                                this.checked = true;
                            else
                                this.checked = false;
                        });
                        checkall = checkall ? 0 : 1;
                    });
                }


            },
    mask:
            {
                init: function ()
                {
                    //Máscaras [INPUT]
                    $(".cpf").mask("999.999.999-99");
                    $(".cnpj").mask("99.999.999/9999-99");
                    $(".cep").mask("99.999-999");
                    $(".nascimento").mask("99/99/9999");
                    $(".fone").mask("(99)99999999");
                    $(".hora").mask("99:99:99");
                }


            },
    sliderRange:
            {
                init: function (div, divResult, divValue, start, text1)
                {
                    $("#" + div).slider({
                        range: "min",
                        value: start,
                        min: 0,
                        max: 100,
                        slide: function (event, ui) {
                            $("#" + divResult).html(text1 + ui.value + "%");
                            $("#" + divValue).val(ui.value);
                        }
                    });
                    $("#" + divResult).html(text1 + $("#" + div).slider("value") + "%");
                }


            },
    autocomplete:
            {
                init: function (pagina)
                {

                    //Autocomplete GENÉRICO
                    $("#autocomplete").autocomplete(pagina, {
                        width: 260,
                        selectFirst: false
                    });

                    $("#autocomplete").result(function (event, data, formatted) {
                        if (data) {
                            //Envia para o form o ID.
                            $("#idAutoComplete").val(data[1]);
                        }
                    });
                }


            },
    money:
            {
                init: function (pagina)
                {
                    //Money
                    $(".valor").maskMoney({symbol: "R$", decimal: ",", thousands: "."});
                }


            },
    dynamicForm:
            {
                init: function (id, mais, menos)
                {
                    //DINAMIC FORM
                    $("#" + id).dynamicForm("#" + mais, "#" + menos, {
                        limit: 100
                    });
                }

            },
    validate:
            {
                init: function ()
                {
                    //VALIDATE
                    var container = $("#mensagem");
                    var validator = $("#form").bind("invalid-form.validate", function () {
                        $("#mensagem").html("<p>O formulário possue " + validator.numberOfInvalids() + " erros, veja mais informações abaixo:</p>");
                        container.css("display", "block");
                    }).validate({
                        errorElement: "span",
                        success: function (label) {
                            label.text("ok!").addClass("successo");
                        },
                        submitHandler: function (form) {
                            form.submit();
                        }
                    });
                }


            },
    zebrarTabela:
            {
                init: function (tabela)
                {
                    $("#" + tabela + " tr:even").css("background-color", "#eaeaea");
                }


            }



};


//Confirmação ao deletar
function confirmacaoMsg(msg) {
    var answer = confirm(msg);
    if (answer) {
        return true;
    }
    else {
        return false;
    }
}

//AJAX + JQUERY
function ajax(url, div, valor, valor2, valor3, valor4, valor5) {
    $('#' + div).fadeOut("slow", function () {
        $('#' + div).html('<i>Carregando...</i>');
        $.ajax({
            url: url,
            type: "GET",
            data: ({
                valor: valor,
                valor2: valor2,
                valor3: valor3,
                valor4: valor4,
                valor5: valor5
            }),
            dataType: "html",
            success: function (data) {
                $('#' + div).html(data);
                //ajaxJQuery();
            },
            complete: function () {
                $('#' + div).fadeIn("slow");
            }
        });
    });
}

//RECUPERAR GET
function getQueryString()
{
    var qs = window.location.search.substring(1).split('&');

    for (var i = 0; i < qs.length; i++) {
        qs[i] = qs[i].split('=');
    }

    return qs;
}

//FUNÇÃO PARA CONTAR QUANTOS CHECKBOX FORAM CHECKED
function qtdeChecked() {
    var i = 0;
    $('.cinput').each(function () {
        if ($(this).is(':checked'))
            i++;
    });
    return i;
}



$(document).ready(function () {
    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('[data-toggle="tooltip"]').tooltip();

    js.tiny.init();
    js.money.init();
    js.mask.init();

    $(".apagar").click(function () {
        var x = confirm("Tem certeza que deseja apagar esse item?");
        if (x)
            return true;
        else
            return false;
    });

});

$("#cep").focusout(function () {

    var cep = $("#cep").val();
    var er = /\^|\_|\.|\-/g;
    cep = cep.replace(er, "");
    var cep_length = cep.length;

    if (cep_length == 8) {
        $.ajax({
            url: 'http://cep.correiocontrol.com.br/' + cep + '.json',
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#endereco').val(data.logradouro);
                $('#bairro').val(data.bairro);
                //$('#cli_cidade').val(data.localidade);
                //$('#cli_estado').val(data.uf);
            }
        });
    } else {
        alert('Por favor insira um CEP válido.');
    }

});

$(function () {
    $('.telefone').focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
});

