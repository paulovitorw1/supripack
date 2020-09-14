var testesss = [];
var idDelete = [];
var idDeleteunique = [];
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
    $(".lcarousel").addClass('linkselectedConfig');
    $("#test-upload").fileinput({
        'theme': 'fas',
        'showPreview': false,
        'allowedFileExtensions': ['jpg', 'png', 'gif'],
        'elErrorContainer': '#errorBlock'
    });

    //INICIANDO O LAYOUT DE UPLOAD DE IMAGEM
    $("#kv-explorer").fileinput({
        //O modelo do Layout
        'theme': 'explorer-fas',
        overwriteInitial: false,
        uploadUrl: '/admin/config/carousel/adicinar',
        required: true,
        language: 'pt-BR',
        showUpload: false,
        showUploadedThumbs: true,
        //btn preview
        fileActionSettings: {
            showUpload: false, //This remove the upload button
            showDrag: false
        },
        // browseClass: "btn btn-success",
        // browseLabel: "Pick Image",
        // browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeIcon: "<i class=\"fas fa-trash-alt\"></i> ",


    });
    //SUBMIT PARA UPLOAD DAS IMAGEM
    $("#btnform").on("click", function () {
        if ($("#inputfileCa").val() == null) {
            $("#kv-explorer").fileinput('upload');
        } else {
            $("#kv-explorer").fileinput('upload');
            $.ajax({
                type: "POST",
                url: "/admin/config/carousel/adicinar",
                dataType: "JSON",
                success: function (data) {
                    // Swal.fire({
                    //     icon: 'success',
                    //     position: 'top',
                    //     title: ' teste',
                    //     text: 'sssss'
                    // });
                    // setInterval(() => {
                    //     location.reload();
                    // }, 2000);

                }, error: function (erros) {
                    alert("error");
                }
            });
        }

    });

});
function reloadPagina() {
    setInterval(() => {
        location.reload();
    }, 2000);
}
//Imagem
$(function () {
    $(document).on("change", ".uploadFile", function () {
        var uploadFile = $(this);
        // console.log(uploadFile);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                uploadFile.closest(".btnUploadEdit").find('.valorIdImg').val(uploadFile[0].defaultValue).removeClass('deletInput');

                // testesss.push();

            }
        }

    });
});
//CHAMANDO MODAL PARA ADD
function addItemcarousel() {
    //LIMPANDO O MODAL, FUNÇÃO DA BIBLIOTECA KRAJEE
    $("#kv-explorer").fileinput('clear');
    $("#modalAddItemCarousel").modal('show');

}
//CHAMANDO MODAL EDIT
function editarCarousel() {
    $("#modalEditItemCarousel").modal('show');

}
//Chamando MODAL DELETE
function deleteCarousel() {
    $("#modalApagarItemCarousel").modal('show');

}

function deletar(idCardImg) {
    Swal.fire({
        position: 'top',
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, apague-o!'
    }).then((result) => {
        if (result.isConfirmed) {
            //adicinando o id dentro de um array ser enviado
            idDelete.push(idCardImg);
            //removendo o card
            $('.card_' + idCardImg).remove();
            //Alert sucesso
            Swal.fire(
                'Deletado!',
                'Seu arquivo foi excluído.',
                'success'
            );
        }
    });



}
//Enviando os IDs para deletar cards do carousel
$("#btnformDelte").on('click', function (e) {
    e.preventDefault();
    //Removendo itens duplicados do array
    function idUnico(value, index, self) {
        return self.indexOf(value) === index;
    }
    //
    idDeleteunique = idDelete.filter(idUnico);
    $.ajax({
        type: "POST",
        url: "/admin/config/carousel/delete",
        data: {
            idDelete: idDeleteunique
        },
        dataType: "JSON",
        success: function (data) {
            Swal.fire({
                icon: 'success',
                position: 'top',
                title: 'Dados deletados com sucesso!',
                text: 'Os dados selecionados foram apagados com sucesso.'
            });
            reloadPagina();
        }, error: function (erros) {
            alert("deu erro");

        }
    });

});
//Enviando formulario para edição
$("#btnformEditar").click(function (e) {
    e.preventDefault();
    //removendo inputs que não foram editadas
    $(".deletInput").remove();
    $.ajax({
        type: "POST",
        url: "/admin/config/carousel/editar",
        data: new FormData($("#modalEditItemCarousel form")[0]),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            Swal.fire({
                icon: 'success',
                position: 'top',
                title: 'Dados Atualizados com sucesso !',
                text: 'sssss'
            });
            //recarregando a pagina
            reloadPagina();
        },
        error: function (erros) {
            console.log(erros);

        }
    });
});

