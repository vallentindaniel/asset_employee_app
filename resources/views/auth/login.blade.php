@extends('layout.base')

@section('body')

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">

                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Login</h4>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        @csrf
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">{{session('status')}}</div>
                                        @endif

                                        @if ($errors->has('login'))
                                            <div class="alert alert-danger">{{$errors->first('login')}}</div> @endif

                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{$errors->first('email')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="email" name="email" value="{{old('email')}}" id="loginInputEmail" aria-describedby="emailHelp" placeholder="Adresa email..." name="email">
                                        </div>

                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">{{$errors->first('password')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password" id="loginInputPassword" placeholder="Parola" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="formCheck-1">
                                                    <label class="form-check-label custom-control-label" for="formCheck-1">Remember me!</label>
                                                </div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button>
                                    </form>
                                    <div class="text-center"><a class="small" href="{{route('password.email')}}">I forgot password</a></div>
                                    <div class="text-center"><a class="small" href="{{route('register')}}">Register!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

@endsection

