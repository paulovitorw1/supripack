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
            <button type="button" onclick="addItemcarousel()" class="btnAcoesCarousel btn btn-primary"><i
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="view-product">
                            <img src="{{ asset('img/home/girl1.jpg') }}" class="girl img-responsive" alt="">
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=""><img src="{{ asset('img/product-details/similar1.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('img/product-details/similar2.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('img/product-details/similar3.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('img/product-details/similar3.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('img/product-details/similar3.jpg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('img/product-details/similar3.jpg') }}" alt=""></a>

                                </div>


                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- FIM MODEL ADD CAROUSEL --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/carousel.js') }}"></script>

@endsection

@endsection

<!--/product-details-->
