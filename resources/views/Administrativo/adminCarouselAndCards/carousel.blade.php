@extends('Painel.config')
@section('conteudo-config')
    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($consultaImagemCarusel as $item)
                        <li data-target="#slider-carousel" data-slide-to="{{ $item->id_e_carousel }}" class=""></li>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    <div class="item active">

                        {{-- <div class="col-sm-12"> --}}
                            {{-- <h1><span>E</span>-SUPRIPACK</h1>
                            <h2>TESTE</h2> --}}
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. </p> --}}
                            {{-- <button type="button" class="btn btn-default get">Get it
                                now</button> --}}
                            {{--
                        </div> --}}
                        <div class="col-sm-12">

                            <img src="{{ asset('img/home/girl1.jpg') }}" class="girl img-responsive" alt="">
                        </div>
                    </div>
                    @foreach ($consultaImagemCarusel as $item)
                        <div class="item next">

                            <div class="col-sm-12">
                                <img src="{{ asset('img_carousel') }}/{{ $item->imagem }}" class="girl img-responsive"
                                    alt="">
                            </div>
                        </div>
                    @endforeach


                </div>

                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="row-group">
            <button type="button" class="btnAcoesCarousel btn btn-danger" id="btnDeletecarousel"><i
                    class="fas fa-trash"></i></button>
            <button type="button" onclick="editarCarousel();" class="btnAcoesCarousel btn btn-warning"><i
                    class="fas fa-edit"></i></button>
            <button type="button" onclick="addItemcarousel();" class="btnAcoesCarousel btn btn-primary"><i
                    class="fas fa-plus-square"></i></button>

        </div>
    </div>
    {{-- MODAL ADD ITEM CAROUSEL --}}
    <!-- Button trigger modal -->

    <!-- Modal add -->
    <div class="modal fade" id="modalAddItemCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Imagens<button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>

                </div>
                <div class="modal-body" style="padding: 0;">
                    <div class="col">
                        <div class="view-product" id="ttttttt">
                            <form id="formUpload" method="POST" enctype="multipart/form-data">
                                {{-- <div class="file"> --}}
                                    <input id="kv-explorer" type="file" id="inputfileCa" name="testeaaa[]" multiple>
                                    {{-- </div> --}}


                                <br>
                            </form>
                        </div>
                        {{-- <div id="similar-product" class="carousel slide"
                            data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                            alt=""></a>
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar2.jpg') }}"
                                            alt=""></a>
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                            alt=""></a>
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                            alt=""></a>
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                            alt=""></a>
                                    <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                            alt=""></a>

                                </div>


                            </div>

                        </div> --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnform" class="btn btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDITAR -->
    <div class="modal fade" id="modalEditItemCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Imagens<button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>

                </div>
                <div class="modal-body" style="padding: 0;">
                    <form id="formcarouselPreviwEdit" method="POST" action="" enctype="multipart/form-data">
                        <br>
                        <div class="container-fluid">
                            <div class="row rowPreviwEdit">
                                @foreach ($consultaImagemCarusel as $imagemEDit)
                                    <div class="col-sm-4 imgUp">
                                        <div class="imagePreview"
                                            style="background-image: url(http://192.168.15.127:8000/img_carousel/{{ $imagemEDit->imagem }})">
                                        </div>
                                        <label class="btn btn-primary btnUploadEdit">
                                            Upload<input type="file" name="imgEditar[]"
                                                data-id="{{ $imagemEDit->id_e_carousel }}" class="uploadFile img"
                                                value="{{ $imagemEDit->imagem }}"
                                                style="width: 0px;height: 0px;overflow: hidden;">
                                            <input type="hidden" name="idImgEditar[]"
                                                value="{{ $imagemEDit->id_e_carousel }}">
                                        </label>
                                    </div><!-- col-2 -->

                                @endforeach


                            </div><!-- row -->
                        </div><!-- container -->
                        <br>
                    </form>
                    {{-- <div id="similar-product" class="carousel slide"
                        data-ride="carousel">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                        alt=""></a>
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar2.jpg') }}"
                                        alt=""></a>
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                        alt=""></a>
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                        alt=""></a>
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                        alt=""></a>
                                <a href=""><img class="img-add" src="{{ asset('img/product-details/similar1.jpg') }}"
                                        alt=""></a>

                            </div>


                        </div>

                    </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btnformEditar" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- FIM MODEL ADD CAROUSEL --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link href="{{ asset('libs/input-file/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="{{ asset('libs/input-file/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet"
        type="text/css" />


@endsection
@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('libs/input-file/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/input-file/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/input-file/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/input-file/js/locales/pt-BR.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/input-file/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/input-file/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

@endsection

@endsection

<!--/product-details-->
