@extends('Painel.config')
@section('conteudo-config')
    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-12">
            <h3>Registro de produtos</h3>
            <hr>
            <table id="tableCards" class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Ações</th>

                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>
        </div>
    </div>
    {{-- <div class="form-row">
        <div class="row-group">
            <button type="button" onclick="deleteCarousel();" class="btnAcoesCarousel btn btn-danger"
                id="btnDeletecarousel"><i class="fas fa-trash"></i></button>
            <button type="button" onclick="editarCarousel();" class="btnAcoesCarousel btn btn-warning"><i
                    class="fas fa-edit"></i></button>
            <button type="button" onclick="addItemcarousel();" class="btnAcoesCarousel btn btn-primary"><i
                    class="fas fa-plus-square"></i></button>

        </div>
    </div> --}}
    <!-- Button trigger modal -->
    <div id="modalViewProduto" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bodymodal-viewProduto">
                    <div class="container-fluid " style="margin-top: 2%;">
                        <div class="row rowPreviwEdit containerImgProduto">

                        </div>
                    </div><!-- container -->
                    {{-- <div class="container"> --}}
                        <form id="formViewProduto" enctype="multipart/form-data" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="nomeproduto">Nome do Produto:</label>
                                    <input type="text" name="nomeproduto" id="nomeproduto" class="form-control viewProduto">
                                </div>
                                <div class="col-sm-6">
                                    <label for="gruoproduto">Grupo do produto:</label>
                                    <input type="text" name="gruoproduto" id="gruoproduto" class="form-control viewProduto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="message-text" class="col-form-label">Descrição do produto:</label>
                                    <textarea class="form-control viewProduto" id="descProduto"></textarea>
                                </div>
                            </div>
                        </form>
                        {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary">Save changes</button>
                    --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


@section('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/DataTables/datatables.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/configuracao/cardsDestaque.js') }}"></script>
    <script src="{{ asset('libs/DataTables/datatables.min.js') }}"></script>
@endsection

@endsection

<!--/product-details-->
