@extends('Painel.config')
@section('conteudo-config')
    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider-carousel" data-slide-to="0" class=""></li>
                    <li data-target="#slider-carousel" data-slide-to="1" class=""></li>
                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item">
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
                    <div class="item active left">
                        <div class="col-sm-12">
                            {{-- <h1><span>E</span>-SUPRIPACK</h1>
                            --}}
                            {{-- <h2>100% Responsive Design</h2>
                            --}}
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                            --}}
                        </div>
                        <div class="col-sm-12">
                            <img src="{{ asset('img/home/girl1.jpg') }}" class="girl img-responsive" alt="">
                        </div>
                    </div>

                    <div class="item next left">
                        <div class="col-sm-12">
                            {{-- <h1><span>E</span>-SUPRIPACK</h1>
                            --}}
                            {{-- <h2>Free Ecommerce Template</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                            --}}
                        </div>
                        <div class="col-sm-12">
                            <img src="{{ asset('img/home/girl1.jpg') }}" class="girl img-responsive" alt="">
                        </div>
                    </div>

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
            <button type="button" class="btnAcoesCarousel btn btn-warning"><i class="fas fa-edit"></i></button>
            <button type="button" onclick="addItemcarousel();" class="btnAcoesCarousel btn btn-primary"><i
                    class="fas fa-plus-square"></i></button>

        </div>
    </div>
    {{-- MODAL ADD ITEM CAROUSEL --}}
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modalAddItemCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>

                </div>
                <div class="modal-body" style="padding: 0;">
                    <div class="col">
                        <div class="view-product" id="ttttttt">
                            <form id="formUpload" method="POST" enctype="multipart/form-data">
                                <div class="file-loading">
                                    <input id="kv-explorer" type="file" name="testeaaa[]" multiple>
                                </div>


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
                    <button type="button"  id="btnform" class="btn btn-primary">Save
                        changes</button>
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
