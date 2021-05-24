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
                                        <h4 class="text-dark mb-4">Register</h4>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        @csrf
                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger">{{$errors->first('name')}}</div> @endif

                                        <div class="mb-3">
                                            <input name="name" type="text" class="form-control form-control-user" placeholder="Full name" value="{{old('name')}}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{$errors->first('email')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Adresa email..." name="email">
                                        </div>

                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">{{$errors->first('password')}}</div> @endif


                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password"  placeholder="Password" name="password">
                                        </div>


                                        @if ($errors->has('password_confirmation'))
                                            <div class="alert alert-danger">{{$errors->first('password_confirmation')}}</div> @endif

                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password" placeholder="Retype password " name="password_confirmation">
                                        </div>

                                        @if ($errors->has('terms'))
                                            <div class="alert alert-danger">{{$errors->first('terms')}}</div> @endif


                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox" name="terms" id="formCheck-1">
                                                    <label class="form-check-label custom-control-label" for="formCheck-1">I agree to the <a href="#">terms</a></label>
                                                </div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Register</button>
                                    </form>
                                    <div class="text-center"><a class="small" href="{{route('login')}}">I already have a membership</a></div>
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

