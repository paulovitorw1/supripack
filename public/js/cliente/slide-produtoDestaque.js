var htmlSlide = '';
var htmlLiSlide = '';
$(document).ready(function () {
    slide();
});

function slide() {
    $.ajax({
        type: "GET",
        url: "/inicial/slide",
        // data: "data",
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (indexInArray, valueOfElement) {
                console.log(indexInArray);
                if (indexInArray == 0) {
                    htmlSlide += '<div class="item active"><div class="col-sm-12"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive" alt=""></div></div>';
                }
                htmlLiSlide += '<li data-target="#slider-carousel" data-slide-to="' + indexInArray + '" class=""></li>';
                htmlSlide += '<div class="item"><div class="col-sm-12"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive" alt=""></div></div>';

            });
            $(".itemProximoImg").html(htmlSlide);
            $(".ol_li").html(htmlLiSlide);

        }, error: function (errros) {
            console.log(errros);

        }
    });
}