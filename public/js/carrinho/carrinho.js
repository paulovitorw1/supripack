
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
                { className: "cart_delete", "targets": [6] }
            ],
            columns: [
                { data: 'id' },
                { data: 'descr' },
                { data: 'descr' },
                { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                { data: 'sssss', name: 'sssss', orderable: false, searchable: false }

            ],
            //Traduzindo a Tabela para o PORTUGUÊS
            "bJQueryUI": true,
            "oLanguage": {
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

    var nomeCupom = $("#inputCupom").val();
    if (nomeCupom.length < 4) {
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
        $('.valorCupom').empty('');
        $('.valorCupom').append('R$');
        // $('.valorCupom').mask('R$ 0.000,00', { reverse: true });

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

                    $('.valorCupom').append(response[0].valor_cupom);
                    $('.valorCupom').mask('R$ 0.000,00', { reverse: true });


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

        $('#inputCupom').val('');
    }
});

function quantdd(classId) {
    var valorAtual = Number($(".valor" + classId).val());
    var ssjssjs = Number(++valorAtual);

    var novoValor = $(".valor" + classId).val(ssjssjs);

}
function quantRemove(classId) {
    var valorAtual = Number.parseInt($(".valor" + classId).val());
    if (valorAtual > 0) {
        var ssjssjs = parseInt(--valorAtual);
        console.log(ssjssjs);
        var novoValor = $(".valor" + classId).val(ssjssjs);
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