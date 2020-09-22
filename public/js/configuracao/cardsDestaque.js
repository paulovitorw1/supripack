var table;
var htmlImg = '';
var chklistaPdestaque;
var checkListDelete = [];
var htmlInputCheck = '';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Ativando o dropdown 
    $(".layout-supri").removeClass('collapse');
    $(".layout-supri").addClass('in');
    $(".layout-supri").css('height', 'auto');
    $(".lcardsDestaque").addClass('linkselectedConfig');


    table = $('#tableCards').DataTable({
        "processing": true,
        "order": [[0, "asc"]],
        dom: 'Bfrtip',
        ajax: "/admin/config/produto/destaque",
        "columnDefs": [{
            "targets": 5,
            "createdCell": function (td, cellData, rowData, row, col) {
                $(td).addClass("deleteCheck_" + rowData.id);
            }
        }]
        ,
        //Fazendo a listagem dos seguintes dados
        columns: [
            //LISTANDO OS DOIS TIPO DE PESSOA.
            { data: 'id' },
            { data: 'nome' },
            { data: 'id' },
            { data: 'id' },
            { data: 'ativo' },
            { data: 'action', name: 'action', orderable: false, searchable: false }

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

    //substituindo a input de pesquisa do DataTables
    $('#inputPesquisa').on('keyup', function () {
        table.search(this.value).draw();
    });


});
$('#ssssss').on('click', function (e) {
    e.preventDefault();
    console.log($(this).val());


});
function reloadPagina() {
    setInterval(() => {
        location.reload();
    }, 2000);
}
//Deletando o produto em destaque
function deleteDestaque(idProdutoDest) {
    //PASSANDO O ID DO PRODUTO SELECIONADO VIA AJAX 
    $.ajax({
        type: "POST",
        url: "/admin/config/produto/destaque/delete",
        data: {
            idProdutoDest: idProdutoDest
        },
        dataType: "JSON",
        success: function (data) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((data) => {
                if (data.isConfirmed) {
                    //VARIAVEL PARA ARMAZENAR A INPUT CHECKBOX
                    htmlInputCheck = '';
                    //REMOVENDO O BOTÃO DE DELETE
                    $(".btn_" + idProdutoDest).remove();
                    //ADICIONANDO INPUT CHECKBOX
                    htmlInputCheck += '<input type="checkbox" class="checkbox" name="checkboxDestaque" value="' + idProdutoDest + '" />';
                    $('.deleteCheck_' + idProdutoDest).append(htmlInputCheck);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }, error: function (erross) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'error'
            )
        }
    });

}
function addDestaque() {
    //Pegando os IDs dos produto selecionados para enviar para o controller via ajax
    chklistaPdestaque = $('input[name="checkboxDestaque"]:checked').toArray().map(function (check) {
        return $(check).val();
    });

    if (chklistaPdestaque == '') {
        alert("error");
    } else {

        $.ajax({
            type: "POST",
            url: "/admin/config/produto/destaque/addDestaque",
            data: {
                chklistaPdestaque: chklistaPdestaque
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Produtos cadastrado em destque!',
                    time: 1500
                });
                reloadPagina();
            }, error: function (erros) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    // text: 'Produtos cadastrado em destque!',
                });
            }
        });
    }

}
//Visualizando o produto
function viewProduto(idProduto) {
    htmlImg = '';
    //limpando a div do modal
    $('.containerImgProduto').empty();
    $.ajax({
        type: "POST",
        url: "/admin/config/produto/destaque/visualizar",
        data: {
            idProduto: idProduto
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",
        success: function (data) {
            //Criando os cards de imagens
            $.each(data, function (indexInArray, valueOfElement) {
                console.log(indexInArray);

                htmlImg += '<div class="col-sm-4 imgUp card"><div class="imagePreview" style="background-image: url(http://192.168.15.127:8000/images/' + valueOfElement.nome_arquivo + ')"></div> <button onclick="" type="button" name="imgDelete[]" value="" class="btn btn-danger btnUploadEdit btnDelete"> Deletar </button></div>';
            });
            $("#formViewProduto .viewProduto").each(function () {
                $(this).attr("readonly", true);
                $(this).attr("disabled", true);

            });
            //adicionando os cards na div
            $('.containerImgProduto').html(htmlImg);
            //DADOS DO PRODUTO
            $("#nomeproduto").val(data[0].nome);
            $("#gruoproduto").val(data[0].nv3);
            $("#descProduto").val(data[0].descr);
            //abrindo o modal
            $("#modalViewProduto").modal('show');

        }, error: function (erros) {
            console.log(erros);

        }
    });

}