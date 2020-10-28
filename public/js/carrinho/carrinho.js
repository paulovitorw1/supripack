
var getlocalStorage = JSON.parse(localStorage.getItem('produto'));
//VARIAVEL QUE VAI ARMAZENAR O HTML
var htmlProduto = '';
var table;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getProdutoStorange();



});

function getProdutoStorange() {
    if (getlocalStorage == null) {

    } else {
        table = $("#tableProdutoCarrinho").DataTable({
            serverSide: false,
            filter: true,
            bDestroy: true,
            processing: true,
            // dom: 'lrti',
            ajax: {
                url: "/inicial/carrinho/lista/produto",
                data: {
                    idProdutos: getlocalStorage
                },
                cache: true,
                type: "POST",
            },
            "columnDefs": [
                //Class btn delete produto
                { className: "cart_delete", "targets": [6] },
                // { className: "valorTotalP", "targets": [5] },

                //convertendo valores para moeda brasileira
                {
                    "render": function (data) {
                        return parseFloat(data).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
                    },
                    "targets": [3]
                }
            ],
            columns: [
                { data: 'id' },
                { data: 'descr' },
                { data: 'descr' },
                { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                // { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                {
                    'data': 'valorTotal',
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        console.log(oData);
                        $(nTd).html(oData.valorTotal);
                    }
                },
    
                // { data: 'valorTotal', name: 'valorTotal', className: 'valorTotalP', orderable: false, searchable: false, defaultContent: "<i>Not set</i>" },
                { data: 'removeProduto', name: 'removeProduto', orderable: false, searchable: false }

            ],
            //Traduzindo a Tabela para o PORTUGUÊS
            "bJQueryUI": true,
            "oLanguage": {
                "decimal": ",",
                "thousands": ".",
                "lengthChange": false,
                "pageLength": 10,
                "sProcessing": "Processando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sSearch": "Pesquisar: ",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Próximo",
                    "sLast": "Último"
                }
            }
        });
        // $.ajax({
        //     type: "POST",
        //     url: "/inicial/carrinho/lista/produto",
        //     data: {
        //         idProdutos: getlocalStorage
        //     },
        //     dataType: "JSON",
        //     success: function (data) {
        //         console.log(data)
        //     }, error: function (erros) {
        //         console.log(erros);

        //     }
        // });
    }
}

$("#aplicaCupom").click(function (e) {
    e.preventDefault();
    var valorCupom;
    var nomeCupom = $("#inputCupom").val();
    if (nomeCupom.length < 4) {
        $('#inputCupom').removeClass('inputSucesso');
        $('.mensagem_nomecupom').removeClass('mensagemSucesso');
        $('.mensagem_nomecupom').text('O nome do cupom deve ter pelo menos 4 caracteres!');
        $('#inputCupom').addClass('inputError');
        $('.mensagem_nomecupom').addClass('mensagemErro');
        //Removendo as class de erros quando houver um click
        $('#inputCupom').click(function (e) {
            $(this).removeClass('inputError');
            $('.mensagem_nomecupom').removeClass('mensagemErro');
            $('.mensagem_nomecupom').text('');

        });

    } else {
        $('.valorCupom').text('R$ 0,00');

        $('#inputCupom').removeClass('inputError');
        $('.mensagem_nomecupom').removeClass('mensagemErro');
        $('.mensagem_nomecupom').text('');
        $.ajax({
            type: "POST",
            url: "/inicial/carrinho/cupom",
            data: {
                nomeCupom
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response.cupomErro == 0) {
                    $('#inputCupom').removeClass('inputSucesso');
                    $('.mensagem_nomecupom').removeClass('mensagemSucesso');
                    $('.mensagem_nomecupom').text('Cupom invalido.');
                    $('#inputCupom').addClass('inputError');
                    $('.mensagem_nomecupom').addClass('mensagemErro');
                    //Removendo as class de erros quando houver um click
                    $('#inputCupom').click(function (e) {
                        $(this).removeClass('inputError');
                        $('.mensagem_nomecupom').removeClass('mensagemErro');
                        $('.mensagem_nomecupom').text('');

                    });
                } else {
                    $('.mensagem_nomecupom').text('Cupom aplicado com sucesso !');
                    $('#inputCupom').addClass('inputSucesso');
                    $('.mensagem_nomecupom').addClass('mensagemSucesso');
                    $('#inputCupom').click(function (e) {
                        $(this).addClass('inputCupom');
                        $('.mensagem_nomecupom').addClass('mensagemSucesso');
                        $('.mensagem_nomecupom').text('Cupom aplicado com sucesso !');


                    });
                    //Convertendo valor do cupom para moeda Brasileira
                    valorCupom = parseFloat(response[0].valor_cupom).toLocaleString("pt-BR", {
                        style: "currency",
                        currency: "BRL"
                    });
                    //Passando o valor do cupom com a maracara de real 
                    $('.valorCupom').text(valorCupom);
                    //Passando o ID do cupom
                    $(".valorCupom").attr('data-idCupom', response[0].e_id_cupom);
                    //Mostrando botton de remover cupom
                    $('#removeCupom').removeClass('displayNone');
                    //
                    $('#removeCupom').click(function (e) {
                        $(".valorCupom").attr('data-idCupom', '');
                        $('#inputCupom').removeClass('inputSucesso');
                        $('.mensagem_nomecupom').removeClass('mensagemSucesso');
                        $('.mensagem_nomecupom').text('');
                        $(this).addClass('displayNone');
                        //
                        $('#inputCupom').click(function (e) {
                            $(this).addClass('inputCupom');
                            $('.mensagem_nomecupom').text('');


                        });
                    });

                }

            }, error: function (erros) {
                console.log(erros.cupomErro);
                $('.mensagem_nomecupom').text(erros.cupomErro);
                $('#inputCupom').addClass('inputError');
                $('#inputCupom').click(function (e) {
                    $(this).removeClass('inputError');
                    $('.mensagem_nomecupom').text('');

                });

            }
        });
    }


});
//CUPOM 
$("#checkboxcupom").change(function (e) {
    // alert("ddasda");
    if (this.checked == true) {
        $('.divCupom').removeClass('displayNone');
        $('#aplicaCupom').removeClass('displayNone');
        $('#inputCupom').val('');

    } else {
        $('.divCupom').addClass('displayNone');
        $('#aplicaCupom').addClass('displayNone');
        $('#removeCupom').addClass('displayNone');


        $('#inputCupom').val('');
    }
});

function quantdd(classId) {
    var valorAtual = Number($(".valor" + classId).val());
    var valNumreal = Number(++valorAtual);

    var novoValor = $(".valor" + classId).val(valNumreal);
    var tesste = $(novoValor).val();

    console.log($('.valorTotalP').text());


}
function quantRemove(classId) {
    var valorAtual = Number.parseInt($(".valor" + classId).val());
    if (valorAtual > 0) {
        var valNumFloa = parseInt(--valorAtual);
        var novoValor = $(".valor" + classId).val(valNumFloa);
    }



}

function removeProduto(idProduto) {
    //pegando o valor selecionado
    var index = getlocalStorage.indexOf(idProduto);
    //verificando valor dentro do array e deletando
    if (index > -1) {
        getlocalStorage.splice(index, 1);
    }
    //Inserindo os novos valores
    localStorage.setItem('produto', JSON.stringify(getlocalStorage));
    //Atualizando a tabela
    getProdutoStorange();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Produto adicionado ao carrinho!'
    })
}