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
        $("#kv-explorer").fileinput('upload');
    });

});

function addItemcarousel() {
    $("#modalAddItemCarousel").modal('show');


}




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