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
                                        <h4 class="text-dark mb-4">Reset your password.</h4>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        @csrf
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{$errors->first('email')}}</div> @endif

                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">{{$errors->first('password')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password"  placeholder="Parola" name="password">
                                        </div>

                                        @if ($errors->has('password_confirmation'))
                                            <div class="alert alert-danger">{{$errors->first('password_confirmation')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password"  placeholder="Parola" name="password_confirmation">
                                        </div>


                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">Change password</button>
                                    </form>
                                    <div class="text-center"><a class="small" href="{{route('register')}}">Login</a></div>
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

