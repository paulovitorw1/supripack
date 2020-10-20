@extends('Painel.config')
@section('conteudo-config')
    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-12">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-row " id="grup_tableInputs">
                        <div class="left-sidebar">
                            <h2>Configuração</h2>

                        </div>
                        {{-- <div class="form-group col-md-4 " id="divSelectTipo">
                            <label for="nomePessoa">Nome:</label>
                            <select class="form-control" name="valorTipoPessoa" id="selectTipo">
                                <option value="1">Todos</option>
                                <option value="2">Pessoa Física</option>
                                <option value="3">Pessoa Jurídico</option>
                            </select>
                        </div> --}}
                        <div class="form-group col-md-3" id="divinputPesquisa">
                            <button onclick="addCupom();" id="btnAddDestaque" class="btn btn-primary">
                                Novo Cupom
                            </button>
                            <label for="pesquisa">Pesquisa:</label>
                            <input type="search" class="form-control" id="inputPesquisa">

                        </div>
                    </div>
                    <table class="table table-bordered" id="tableCupom" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width=60>ID</th>
                                <th>Nome</th>
                                {{-- <th>Last</th>
                                <th>Handle</th>
                                <th>Status</th> --}}
                                <th width=228>Ações</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


            {{-- <h3>Registro de produtos</h3>
            <hr>
            <table id="tableCards" class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>

                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table> --}}
        </div>
    </div>
    {{-- MODAL ADD ITEM CAROUSEL --}}
    <div class="modal fade" id="modalAddCupom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Cupom<button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>

                </div>
                <div class="modal-body" style="padding: 0%">
                    <div class="col">
                        <div class="view-cupom" id="ttttttt">
                            <form id="formAddCupom" method="POST" enctype="multipart/form-data">
                                <div class="row modalAddRow">
                                    <div class="col-sm-6">
                                        <label for="nomeCupom">Nome do Cupom</label>
                                        <input type="text" class="form-control nomecupom"
                                            placeholder="Digite o nome do cupom" name="nomecupom">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tipoCupom">Tipo de cupom</label>
                                        <select class="form-control" id="tipoCupom" name="tipoCupom">
                                            <option value="">Selecione o tipo do cupom </option>
                                            <option value="1">Frete</option>
                                            <option value="2">Produto</option>
                                            <option value="3">Produto e Frete</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row modalAddRow">
                                    <div class="col-sm-6">
                                        <label for="tipoValor">Tipo valor</label>
                                        <select class="form-control" id="tipoValor" name="porcentagemOUvalorreal">
                                            <option value="">Selecione</option>
                                            <option value="1">$ (valor em valor real)</option>
                                            <option value="2">% (valor em porcentagem)</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nome">Valor do cupom</label>
                                        <input type="text" class="form-control valor"
                                            placeholder="Digite o valor do desconto" name="valorCupom" data-prefix="R$ ">
                                    </div>
                                </div>
                                <div class="row modalAddRow">
                                    <div class="col-sm-6">
                                        <label for="nome">Quantidade de cupom</label>
                                        <input type="number" class="form-control quantidade"
                                            placeholder="Digite a quantidade de cupons " name="cupomQuantidade">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nome">Data de validade</label>
                                        <input type="text" class="form-control data"
                                            placeholder="Digite a data de validade do cupom" name="validadeCupom">
                                    </div>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btnformAddCupom" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDITAR -->
    <div class="modal fade" id="modalEditItemCarousel" tabindex="-1" role="dialog" aria-labelledby="modalEditItemCarousel"
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
                    <form id="formAdd" method="POST" action="" enctype="multipart/form-data">
                        <br>
                        <div class="container-fluid">
                            <div class="row rowPreviwEdit">



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
    {{-- FIM MODEL EDIT CAROUSEL --}}
    <!-- Modal APGAR -->
    <div class="modal fade" id="modalApagarItemCarousel" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLongTitle">Deletar Imagens<button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>

                </div>
                <div class="modal-body" style="padding: 0;">
                    <form id="formcarouselPreviwDelete" method="POST" action="" enctype="multipart/form-data">
                        <br>
                        <div class="container-fluid">
                            <div class="row rowPreviwEdit">



                            </div><!-- row -->
                        </div><!-- container -->
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btnformDelte" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- FIM MODEL EDIT CAROUSEL --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cupom.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('libs/DataTables/datatables.min.css') }}">



@endsection
@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/configuracao/cupom.js') }}"></script>
    <script src="{{ asset('libs/jQuery-Mask/src/jquery.mask.min.js') }}"></script>
    
@endsection

@endsection


<!--/product-details-->
