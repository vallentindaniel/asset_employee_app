


@extends('layout.main')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cost Center</li>
  </ol>
</nav>

<div class="container mt-4">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Employee Cost Center</th>
                <th scope="col">Manager in Cost Center</th>
                <!-- <th scope="col">Deleted</th> -->
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

         @foreach ($employee_cost_centers as $employee_cost_center )

                @if ($user->id == $employee_cost_center->id)
                <tr class="table-primary">
                @else
                <tr>
                @endif

                    @if ($employee_cost_center->cost_center_id)


                    <th scope="row">{{ $employee_cost_center->costCenter->id }} </th>
                    <th scope="row">{{ $employee_cost_center->costCenter->name }} </th>
                    <th scope="row">{{ $employee_cost_center->name }} </th>
                    <td >{{ $employee_cost_center->costCenter->manager->name }} </td>
                    <td>
                        @if ($employee_cost_center->costCenter->manager->id == $user->id || $user->role == App\Models\User::ROLE_ADMIN )
                            <div class="btn-group-vertical">
                                <button class="btn btn-warning mt-1"
                                                    type="button"
                                                    data-ccenter="{{json_encode($employee_cost_center->costCenter)}}"
                                                    data-toggle="modal"
                                                    data-target="#costCenterEditModal">Edit</button>

                                <button class="btn btn-xs btn-danger"
                                                    type="button"
                                                    data-ccenter="{{json_encode($employee_cost_center)}}"
                                                    data-toggle="modal"
                                                    data-target="#costCenterDeleteModal">
                                                <i class="fas fa-trash"></i></button>
                            </div>
                        @endif
                    </td>
                    @else
                    <th scope="row">Unfortunately this user is not assigned a cost center </th>
                    <th scope="row">{{ $employee_cost_center->name }} </th>
                    @endif
                </tr>

         @endforeach


        </tbody>
    </table>
    <nav aria-label="Page navigation example ">
        <ul class="pagination float-right">
            @if ($employee_cost_centers->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->previousPageUrl()}}">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->url(1)}}">1</a></li>
            @endif
            @if ($employee_cost_centers->currentPage() > 3)
                <li class="page-item"><span class="page-link page-active">...</span></li>
            @endif
            @if ($employee_cost_centers->currentPage() >= 3)
                <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->url($employee_cost_centers->currentPage() - 1)}}">{{$employee_cost_centers->currentPage() - 1}}</a></li>
            @endif


            <li class="page-item"><span class="page-link page-active">{{$employee_cost_centers->currentPage()}}</span></li>

            @if ($employee_cost_centers->currentPage() <= $employee_cost_centers->lastPage() - 2)
                <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->url($employee_cost_centers->currentPage() + 1)}}">{{$employee_cost_centers->currentPage() + 1}}</a></li>
            @endif

            @if ($employee_cost_centers->currentPage() < $employee_cost_centers->lastPage() - 2)
                <li class="page-item"><span class="page-link page-active">...</span></li>
            @endif

            @if ($employee_cost_centers->currentPage() < $employee_cost_centers->lastPage() )
                <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->url($employee_cost_centers->lastPage())}}">{{$employee_cost_centers->lastPage()}}</a></li>
                <li class="page-item"><a class="page-link" href="{{$employee_cost_centers->nextPageUrl()}}">&raquo;</a></li>
            @endif

        </ul>
    </nav>
</div>


<div class="modal fade" id="costCenterEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Cost Center</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="costCenterEditAlert"></div>
                <input type="hidden" id="costCenterEditId" value="" />
                <div class="form-group">
                    <label for="costCenterEditName">Name</label>
                    <input type="text" class="form-control" id="costCenterEditName" placeholder="Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="costCenterEditButton">Edit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="costCenterDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Cost Center</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="costCenterDeleteId" name="costCenterDeleteId" value="" />
                <p>Are you sure you want to delete this Cost Center?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="costCenterDeleteButton">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection
