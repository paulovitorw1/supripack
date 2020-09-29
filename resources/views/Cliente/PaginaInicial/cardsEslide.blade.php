@extends('Painel.index_painel')
@section('conteudo')
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
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian">



                        </div>


                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <h2 class="title text-center">Features Items</h2>
                    <div class="features_items" id="divProdutoDestaque">
                        <!--Produto em destaque-->


                    </div>

                    <div>

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
   
    {{-- <script src="{{ asset('js/cliente/teste.js') }}"></script> --}}

@endsection
@endsection
