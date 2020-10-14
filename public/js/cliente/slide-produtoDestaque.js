
//Variaveis para o carusel 
var htmlSlide = '';
var htmlLiSlide = '';
//Variavel que vai armazenar os produtos em destaque
var htmlCardPDestaque = '';
//Variavel que vai armazenar os menu
var htmlCategoria = '';
//Variavel que vai armazenar os sub-menu
var htmlSubMenu = '';
var filtroProduto = '';
//Variavel que vai armazenar os produtos
var result = [];
//Quantidade de produtos por pagina
var tamanhoPagina = 3;
//Pagina atual
var pagina = 0;
//Cache de pesquisa
var cache = {};
var idCategoriaorSub;

//********************************************************************//
//pegando os valores salvo no LOCALSTORANGE
var produtoStorage = JSON.parse(localStorage.getItem("produto"));
var arrayIdprodutos = {};
$(document).ready(function () {
    //Modal icon de carregamento
    $("#loading").modal('show');
    //TOKEN
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    addKeyupEvent($('#inputPesquisa'));
    slide();
    cardProdutoDestaque();
    categoria();

    $('.countProd').html(produtoStorage.length);


});

function slide() {
    $.ajax({
        type: "GET",
        url: "/inicial/slide",
        // data: "data",
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (indexInArray, valueOfElement) {
                // console.log(indexInArray);
                if (indexInArray == 0) {
                    htmlSlide += '<div class="item active"><div class="col-sm-12 col_pl-pr-0"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive-index" alt=""></div></div>';
                    htmlLiSlide += '<li data-target="#slider-carousel" data-slide-to="' + indexInArray + '" class="active"></li>';
                } else {

                    htmlLiSlide += '<li data-target="#slider-carousel" data-slide-to="' + indexInArray + '" class=""></li>';

                    htmlSlide += '<div class="item"><div class="col-sm-12 col_pl-pr-0"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive-index" alt=""></div></div>';
                }

            });
            $(".itemProximoImg").html(htmlSlide);
            $(".ol_li").html(htmlLiSlide);

        }, error: function (errros) {
            console.log(errros);

        }
    });
}


function categoria() {
    $.ajax({
        type: "GET",
        url: "/inicial/categoria",
        dataType: "JSON",
        success: function (data) {
            // console.log(sub);

            $.each(data.menu, function (indexInArrayMeunu, valueOfElementMeunu) {

                var textMinusula = valueOfElementMeunu.nv1.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                htmlCategoria += '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordian" href="#' + textMinusula + '"> <span class="badge pull-right"><i class="fa fa-plus"></i></span> ' + valueOfElementMeunu.nv1 + ' </a></h4></div><div id="' + textMinusula + '" class="panel-collapse collapse"><div class="panel-body ' + textMinusula + '"></div></div></div>';
                //REQUISIÇÃO PARA SUB-MEUs
                $.ajax({
                    type: "POST",
                    url: "/inicial/tesste",
                    data: {
                        idCategoria: valueOfElementMeunu.id
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        htmlSubMenu = '';
                        $.each(data, function (indexInArray, valueOfElement) {
                            if (valueOfElement.niv == 2) {
                                htmlSubMenu += '<ul><li ><a class="cursoPoint" onclick="filtroCategoriaProduto(' + valueOfElement.id + ')" style="margin-left:3%;">' + valueOfElement.nv2 + '</a></li></ul> <input type="hidden" value="' + valueOfElement.id + '"/>';

                            } else if (valueOfElement.niv == 3) {
                                htmlSubMenu += '<ul><li><a class="cursoPoint" onclick="filtroCategoriaProduto(' + valueOfElement.id + ')" style="margin-left:3%;">' + valueOfElement.nv2 + '-' + valueOfElement.nv3 + '</a></li></ul> <input type="hidden" value="' + valueOfElement.id + '"/>';
                            }
                        });
                        $('.' + textMinusula).html(htmlSubMenu);

                        $("#loading").modal('hide');

                    }, error: function (erros) {

                    }
                });

            });
            $('.category-products').html(htmlCategoria);
        }, error: function (erros) {

        }
    });
}

//Funão para Produtos em destaque
function cardProdutoDestaque() {
    $('#inputPesquisa').hide();
    $("#h2-produtos").text('Produtos em destaque');
    $.ajax({
        type: "POST",
        url: "/inicial/produto/destaque",
        dataType: "JSON",
        success: function (data) {
            //Passando os valores para uma variavel global
            result = data;
            //execultando as funções para receber os novos valores
            paginar();
            ajustarBotoes();
        }, error: function (erros) {

        }
    });
}

//Função para produtos filtrados
function filtroCategoriaProduto(idCategoria) {
    //Zerando a variavel que armazena a pagina onde o usuario está.
    pagina = 0;
    //Chamando o modal de carregamento
    $("#loading").modal('show');
    //
    //Limpadando a input de pesquisa quando uma nova busca de produtos for solicitada
    $('#inputPesquisa').val('');
    //Armazenando o ID da categoria em uma variavel global
    idCategoriaorSub = idCategoria;
    htmlCardPDestaque = '';
    $.ajax({
        type: "POST",
        url: "/inicial/filtro/produto",
        data: {
            idCategoria: idCategoria
        },
        dataType: "JSON",
        success: function (data) {
            if (data != '') {
                result = data;
                paginar();
                ajustarBotoes();
            } else {
                result = '';
                paginar();
                ajustarBotoes();
                $('#divProdutoDestaque').empty();
                $("#divProdutoDestaque").html('<div class="dadosNecontrado"><h1>Ainda não temos produtos para essa categoria !</h1></div>');
            }
            $("#h2-produtos").text('Produtos');
            $('#inputPesquisa').show();

        }, error: function (erros) {

        }
    });
}

//Função para popução da DIV
function paginar() {
    // $('#numeracao').text('');
    //limpando a variavel que vai receber o HTML 
    htmlCardPDestaque = '';
    //Limpando a DIV que vai receber os produtos
    $('#divProdutoDestaque').empty();

    for (var i = pagina * tamanhoPagina; i < result.length && i < (pagina + 1) * tamanhoPagina; i++) {
        console.log(result);
        //Armazenando os produtos na variavel
        htmlCardPDestaque += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + result[i].nome_arquivo + '" alt="" ><h2>' + result[i].id + '</h2><p>Easy Polo Black Edition</p> <a href="javascript:void(0)" class="btn btn-default add-to-cart" onclick="addProdutoLocalStore();"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>' + result[i].descr + '</p> <a href="javascript:void(0)" class="btn btn-default add-to-cart" onclick="addProdutoLocalStore(' + result[i].id + ');"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';

    }
    //Populando a DIV
    $("#divProdutoDestaque").html(htmlCardPDestaque);
    //
    $("#loading").modal('hide');
    //Exibir a quantidade de pagina e onde o mesmo se encontra
    $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(result.length / tamanhoPagina));
}

function ajustarBotoes() {
    $('#proximo').prop('disabled', result.length <= tamanhoPagina || pagina >= Math.ceil(result.length / tamanhoPagina) - 1);
    $('#anterior').prop('disabled', result.length <= tamanhoPagina || pagina == 0);
}

$('#proximo').click(function () {
    if (pagina < result.length / tamanhoPagina - 1) {
        pagina++;
        paginar();
        ajustarBotoes();
    }
});
$('#anterior').click(function () {
    if (pagina > 0) {
        pagina--;
        paginar();
        ajustarBotoes();
    }
});

//****************************************************************************//

function addKeyupEvent(element) {
    element.keyup(function (e) {
        var keyword = $(this).val();
        clearTimeout($.data(this, 'timer'));

        if (e.keyCode == 13)
            search(keyword, true);
        else
            $(this).data('timer', setTimeout(function () {
                search(keyword);
            }, 500));
    });
}
//
function search(keyword, force) {
    if (!force && keyword.length < 4)
        return '';

    if (cache.hasOwnProperty(keyword))
        return cache[keyword];

    $.ajax({
        type: 'POST',
        url: "/inicial/filtro/produto/pesquisa",
        async: false,
        data: {
            textProduto: keyword,
            idCategoriaorSub: idCategoriaorSub
        },
        success: function (produtoSearc) {
            cache[keyword] = produtoSearc;
            console.log(keyword);
            if (produtoSearc != '') {
                result = produtoSearc;
                paginar();
                ajustarBotoes();
            } else {
                result = '';
                paginar();
                ajustarBotoes();
                $('#divProdutoDestaque').empty();
                $("#divProdutoDestaque").html('<div class="dadosNecontrado"><h1>Ops! nenhum resultado encontrado para "' + keyword + '".</h1><br><h4>O que eu faço ?</h4><ul><li style="list-style: disc;">Verifique os termos digitados ou os filtros selecionados.</li><li style="list-style: disc;">Utilize termos genéricos na busca.</li></ul></div>');
            }
            $("#h2-produtos").text('Produtos');
            $("#loading").modal('hide');
        },
        error: function () {
            alert("error");
        }
    });
}

function addProdutoLocalStore(idProdutoStorage) {
    if (typeof (Storage) != "undefined") {

        // if (produtoStorage == null) {
        //     produtoStorage = [];
        //     arrayIdprodutos =
        //     {
        //         'produto_id': idProdutoStorage,
        //     };

        // } else {
        //     arrayIdprodutos =
        //     {
        //         'produto_id': idProdutoStorage,
        //     };

        // }
        //Todos os valores armazenados em localStorage são strings.
        //Pegue nossa string de linha de itens de localStorage.
        var stringFromLocalStorage = window.localStorage.getItem("produto");

        //Em seguida, analise essa string em um valor real.
        var parsedValueFromString = JSON.parse(stringFromLocalStorage);

        //Se esse valor for nulo (o que significa que nunca salvamos nada naquele local em localStorage antes), use um array vazio como nosso array. Caso contrário, mantenha o valor que acabamos de analisar.
        var array = parsedValueFromString || [];

        //Aqui está o valor que queremos adicionar
        var value = idProdutoStorage;

        // Se nosso array analisado / vazio ainda não tiver esse valor ...
        if (array.indexOf(value) == -1) {
            // adiciona o valor ao array
            array.push(value);

            // transforma o array  em uma string para prepará-lo para ser armazenado em localStorage
            var stringRepresentingArray = JSON.stringify(array);

            // e armazene-o em localStorage como "produto"
            window.localStorage.setItem("produto", stringRepresentingArray);
        }
        // produtoStorage.push(arrayIdprodutos);
        // localStorage.setItem("produto", JSON.stringify(produtoStorage));
        alert("Registro adicionado.");

        var countProdlength = JSON.parse(localStorage.getItem("produto"));
        console.log(countProdlength);
        $('.countProd').html(countProdlength.length);

        return true;
    }
}
