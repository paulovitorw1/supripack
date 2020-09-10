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
    $(".lcarousel").addClass('linkcarousel');
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

function addItemcarousel() {
    $("#kv-explorer").fileinput('clear');
    $("#modalAddItemCarousel").modal('show');

}

function editarCarousel() {
    $("#modalEditItemCarousel").modal('show');

}


//Imagem
$(function () {
    $(document).on("change", ".uploadFile", function () {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
            }
        }

    });
});

$("#btnformEditar").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/admin/config/carousel/editar",
        data: new FormData($("#modalEditItemCarousel form")[0]),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
        },
        error: function (erros) {
            console.log(erros);

        }
    });
});


// $("#btnform").on('click', function (e) {
//     e.preventDefault();

//     $.ajax({
//         type: "POST",
//         url: "/admin/config/carousel/adicinar",
//         data: new FormData($("#ttttttt form")[0]),
//         processData: false,
//         contentType: false,
//         success: function (data) {
//             console.log(data);
//         },
//         error: function (erros) {

//         }
//     });
// });