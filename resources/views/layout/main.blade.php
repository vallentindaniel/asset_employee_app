@extends('layout.base')

@section('body')

<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            @include('layout.navbar')
            <!-- content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layout.footer')
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>

@endsection
