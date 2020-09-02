@extends('Painel.index_painel')

@section('conteudo')
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                                aria-haspopup="true" v-pre>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!--login form-->
                        <h2>Login to your account</h2>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=" control-label">E-Mail Address</label>

                                <div class="">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>

                                <div class="">
                                    <input id="password" type="password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">

                                    <span>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Keep me signed in
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-6">
                    <div class="signup-form" id="registrarUser">
                        <!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form class="form-horizontal" id="formCadastro" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row has-error">
                                <div class="form-group col-md-6 rm0Cadastro">
                                    <label for="nomeCadastro " class="erro_nome  labelsLogin">Nome</label>
                                    <input type="text" name="nome" class="nome" placeholder="Digte seu nome" />
                                    <span class="help-block">
                                        <strong class="nome"></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="emailCadastro" class=" erro_email labelsLogin">E-mail</label>
                                    <input type="email" name="email" class="email" placeholder="Digite seu E-mail" />
                                    <span class="help-block">
                                        <strong class="email"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-row has-error">
                                <div class="form-group col-md-6 rm0Cadastro">
                                    <label for="senhaCadastro" class="erro_password labelsLogin">Senha</label>
                                    <input type="password" name="password" class="password" placeholder="Digte sua senha" />
                                    <span class="help-block">
                                        <strong class="password"></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="senhaCadastro" class="erro_password_confirmation labelsLogin">Confirma
                                        senha</label>
                                    <input type="password" name="password_confirmation" class="password_confirmation" placeholder="Confirme sua senha" />
                                    <span class="help-block">
                                        <strong class="password_confirmation"></strong>
                                    </span>
                                </div>
                            </div>


                            <button type="button" class="btn btn-primary" id="btnCadastroUser">Criar</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@section('css')

@endsection
@section('js')
    <script src="{{ asset('js/cadastroUser.js') }}"></script>
@endsection
@endsection
