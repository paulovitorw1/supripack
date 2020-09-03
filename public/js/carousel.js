$(document).ready(function () {
    //Ativando o dropdown 
    $(".layout-supri").removeClass('collapse');
    $(".layout-supri").addClass('in');
    $(".layout-supri").css('height', 'auto');
    $(".lcarousel").addClass('linkcarousel');

});

function addItemcarousel() {
    $("#modalAddItemCarousel").modal('show')
}
