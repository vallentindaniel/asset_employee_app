


@extends('layout.main')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
  </ol>
</nav>

<div class="container mt-4">
<h3 class="text-dark mb-4">Profile</h3>
    <div class="row">
        <div class="col">
        <div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold text-center">User Info</p>
    </div>
    <div class="card-body ">
        <div class="col justify-content-center">
            <ul class="list-group text-center">
                <li class="list-group-item"><span>Name: {{$employee->name}} </span></li>
                <li class="list-group-item"><span>Email: {{$employee->email }}</span></li>
                <li class="list-group-item">
                @if ($employee->role == App\Models\User::ROLE_ADMIN)
                    <span>Role: Admin</span>
                @else
                    <span>Role: User</span>
                @endif
                </li>
                @if ($employee->manager_id != null)
                    <li class="list-group-item text-warning"><span>My manager: {{$employee->manager->name }}</span></li>
                    <li class="list-group-item text-warning "><span>Manager Email: {{$employee->manager->email }}</span></li>
                @endif
                @if ($employee->cost_center_id != null)
                    <li class="list-group-item text-info"><span>My Cost Center:
                        <a href="{{route('costCenter.all').'#id'.$employee->costCenter->id}}"> {{$employee->costCenter->name}} </a> </span>
                    </li>
                @endif
            </ul>
        </div>



    </div>
</div>
        </div>
    </div>
</div>


@endsection
