




<!--  navbar navbar-light navbar-expand bg-white shadow -->
<nav class="navbar navbar-light navbar-expand-md mb-4 bg-white shadow">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{route('dashboard')}}">My Asset</a>

        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">

                @if (Route::current()->getName() == 'dashboard')
                    <li class="nav-item"><a class="nav-link active" href="{{route('dashboard')}}">Dashboard</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                @endif


                @if (Route::current()->getName() == 'assets.all')
                    <li class="nav-item"><a class="nav-link active" href="{{route('assets.all')}}">My Assets</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('assets.all')}}">My Assets</a></li>
                @endif


                @if (Route::current()->getName() == 'costCenter.all')
                    <li class="nav-item"><a class="nav-link active" href="{{route('costCenter.all')}}">Cost Center</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('costCenter.all')}}">Cost Center</a></li>
                @endif

            </ul>
        </div>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
           <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{$user->name}}</span>
                        <img class="border rounded-circle img-profile" src="{{ url('/') }}/assets/img/avatars/avatar1.jpeg" />
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <a class="dropdown-item" href="{{route('profile.view')}}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                        </a>
                        <a class="dropdown-item" href="{{route('profile.edit')}}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</nav>
