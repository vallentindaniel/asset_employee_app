


@extends('layout.main')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
  </ol>
</nav>

<div class="container mt-4">
<h3 class="text-dark mb-4">Edit Profile</h3>
    <div class="row">
        <div class="col">
        <div class="card shadow mb-3">
    <div class="card-body ">
        <div class="col justify-content-center">
            @isset($error)
                <div class="alert alert-primary" role="alert">{{$error}}</div>
            @endisset
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="text-center" method="post" style="margin-right: 70px;margin-left: 70px;">
            @csrf
                <h2 class="text-center">Edit User Info</h2>
                <div class="mb-3"><input type="text" class="form-control" name="name" value="{{$employee->name}}" placeholder="Name" /></div>
                <div class="mb-3"><input type="email" class="form-control is-valid" name="email" value="{{$employee->email}}"  placeholder="Email" /></div>
                    @if(is_null($employee->cost_center_id))
                        <div class="mb-3">
                            <select class="form-select" name="cost_center">
                                <option value="" selected>Cost Center:</option>
                                @foreach ($cost_centers as $cost_center )
                                        <option value="{{$cost_center->id}}">{{$cost_center->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                <div class="mb-3"><button class="btn btn-primary" type="submit">Save changes</button></div>
            </form>

        </div>



    </div>
</div>
        </div>
    </div>
</div>


@endsection
