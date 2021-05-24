


@extends('layout.main')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('assets.all')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$asset_user->asset->name}}</li>
  </ol>
</nav>

<div class="container mt-4 justify-content-center">

     <legend class="text-center text-capitalize">{{$asset_user->asset->name}}</legend>
    <table class="table table-hover table-responsive-xl mt-3">
        <tbody>
                <tr>
                    <th scope="col">Description</th>
                    <td>{{$asset_user->asset->description}}</td>

                </tr>

                <tr>
                    @if ($user->role == App\Models\User::ROLE_ADMIN)
                    <th scope="col">Employee</th>
                    <td>{{$asset_user->employee->name}}</td>

                    @endif
                </tr>

                <tr>
                    <th scope="col">Registration Date</th>
                    <td>{{$asset_user->created_at}}</td>
                </tr>

                <tr>
                    <th scope="col">CostCenter</th>
                    <td>{{$asset_user->asset->costCenter->name}}</td>
                </tr>
                <tr>
                    <th scope="col">From</th>
                    <td>{{$asset_user->from}}</td>
                </tr>

                <tr>
                    <th scope="col">To</th>
                     <td>{{$asset_user->to}}</td>
                </tr>
        </tbody>
    </table>

    <h2 class="text-danger text-center mt-4">Asset history</h2>

    <h2>The total number of employees who had the asset <span class="badge badge-secondary">{{$asset_owners}}</span></h2>

    @if ($asset_owners>1)
      <h3>Predecessors:</h3>

      @php
          $current = 1;
      @endphp
      <ul class="list-group list-group-flush">
          @foreach ($list_old_owners as $owner)
             @if ($current==1)
                <li class="list-group-item bg-info.bg-gradient">(Current) {{$owner->employee->name}}</li>
             @else
             <li class="list-group-item bg-light.bg-gradient">{{$owner->employee->name}}</li>
             @endif

             @php
                 $current = 0;
             @endphp

          @endforeach



        </ul>
    @endif

</div>


@endsection
