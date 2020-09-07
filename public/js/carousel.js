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


    $("#kv-explorer").fileinput({
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


    });
    $("#btnform").on("click", function () {
        $("#kv-explorer").fileinput('upload');
    });
    /*
     $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
     });
     */

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