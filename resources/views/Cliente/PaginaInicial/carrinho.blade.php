@extends('Painel.index_painel')
@section('conteudo')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Casa</font>
                            </font>
                        </a></li>
                    <li class="active">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Carrinho de compras</font>
                        </font>
                    </li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Item</font>
                                </font>
                            </td>
                            <td class="description"></td>
                            <td class="price">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Preço</font>
                                </font>
                            </td>
                            <td class="quantity">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Quantidade</font>
                                </font>
                            </td>
                            <td class="total">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Total</font>
                                </font>
                            </td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/one.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Colorblock Scuba</font>
                                        </font>
                                    </a></h4>
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">ID da web: 1089772</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_price">
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> + </font>
                                        </font>
                                    </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> - </font>
                                        </font>
                                    </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/two.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Colorblock Scuba</font>
                                        </font>
                                    </a></h4>
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">ID da web: 1089772</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_price">
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> + </font>
                                        </font>
                                    </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> - </font>
                                        </font>
                                    </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/three.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Colorblock Scuba</font>
                                        </font>
                                    </a></h4>
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">ID da web: 1089772</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_price">
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> + </font>
                                        </font>
                                    </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> - </font>
                                        </font>
                                    </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">O que você gostaria de fazer depois?</font>
                    </font>
                </h3>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Escolha se você tem um código de desconto ou pontos de
                            recompensa que deseja usar ou gostaria de estimar o custo de entrega.</font>
                    </font>
                </p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Use o código do cupom</font>
                                    </font>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Utilize o Voucher de Presente</font>
                                    </font>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Estimativa de remessa e impostos</font>
                                    </font>
                                </label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">País:</font>
                                    </font>
                                </label>
                                <select>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Estados Unidos</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Bangladesh</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Reino Unido</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Índia</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Paquistão</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Ucrano</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Canadá</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Dubai</font>
                                        </font>
                                    </option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Região / Estado:</font>
                                    </font>
                                </label>
                                <select>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Selecione</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Dhaka</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Londres</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Dillih</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Lahore</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Alasca</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Canadá</font>
                                        </font>
                                    </option>
                                    <option>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Dubai</font>
                                        </font>
                                    </option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Código postal:</font>
                                    </font>
                                </label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Obter Cotações</font>
                            </font>
                        </a>
                        <a class="btn btn-default check_out" href="">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Continuar</font>
                            </font>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Subtotal do carrinho </font>
                                </font><span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 59</font>
                                    </font>
                                </span>
                            </li>
                            <li>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Eco Tax </font>
                                </font><span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 2</font>
                                    </font>
                                </span>
                            </li>
                            <li>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Frete </font>
                                </font><span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Livre</font>
                                    </font>
                                </span>
                            </li>
                            <li>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Total </font>
                                </font><span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">$ 61</font>
                                    </font>
                                </span>
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Atualizar</font>
                            </font>
                        </a>
                        <a class="btn btn-default check_out" href="">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Verificação de saída</font>
                            </font>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('css')

@endsection
@section('js')
    <script src="{{ asset('js/carrinho/carrinho.js') }}"></script>
@endsection
@endsection
