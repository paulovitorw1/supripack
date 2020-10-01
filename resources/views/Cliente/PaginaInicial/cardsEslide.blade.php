@extends('Painel.index_painel')
@section('conteudo')
    <div class="modal fade in" id="loading" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle"
        aria-hidden="false" style="display: block; pointer-events: none;">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators ol_li">

                        </ol>

                        <div class="carousel-inner itemProximoImg">


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
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Categoria</h2>
                        <div class="panel-group category-products" id="accordian">



                        </div>


                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <h2 class="title text-center" id="h2-produtos"></h2>
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom: 2%;">
                            <div class="search_box pull-right">
                                <input type="text" id="inputPesquisa" placeholder="Pesquisar">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="idCategoria" value="">
                    <div class="features_items" id="divProdutoDestaque">
                        <!--Produto em destaque-->


                    </div>

                    <div style="margin-bottom: 2%;">

                        <button class="btn btn-primary" id="anterior" disabled>&lsaquo; Anterior</button>
                        <span class="page-link" id="numeracao"></span>
                        <button class="btn btn-primary" id="proximo" disabled>Próximo &rsaquo;</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
@section('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">

@endsection
@section('js')
    <script src="{{ asset('js/cliente/slide-produtoDestaque.js') }}"></script>

    {{-- <script src="{{ asset('js/cliente/teste.js') }}"></script>
    --}}

@endsection
@endsection
