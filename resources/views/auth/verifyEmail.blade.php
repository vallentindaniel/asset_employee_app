@extends('layout.base')

@section('body')
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verify Your Email Address</h3>
                </div>

                <div class="card-body">
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">A fresh verification link has been sent to your email address.</div>
                        @endif

                        Before proceeding, please check your email for a verification link.
                        If you did not receive the email
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

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
                                        <h4 class="text-dark mb-4">Verify Your Email Address</h4>
                                    </div>

                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">A fresh verification link has been sent to your email address.</div>
                                        @endif

                                        <p>Before proceeding, please check your email for a verification link.
                                            If you did not receive the email</p>

                                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary d-block btn-user w-100">click here to request another</button>

                                        </form>
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
