


@extends('layout.main')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Assets</li>
  </ol>
</nav>

<div class="container mt-4 justify-content-center">
    @if (is_null($user->cost_center_id))
    <div class="alert alert-danger" role="alert">
    To add an asset you must have an assigned cost center!
    Choose your Cost Center from Edit Profile
    </div>
    @else
        <button class="btn btn-success" type="button" data-toggle="modal"  data-target="#assetAddModal" >Add</button>
    @endif

    <button class="btn btn-success d-none" type="button" data-toggle="modal"  data-target="#assetAddModal" >Add</button>


    <table class="table table-hover table-responsive-xl">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Asset Name</th>
                @if ($user->role == App\Models\User::ROLE_ADMIN)
                <th scope="col">Employee</th>
                @endif
                <th scope="col">Registration Date</th>
                <th scope="col">CostCenter</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">End of Life</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach ($asset_users as $asset_user)
                <tr>
                    <td>{{$i}} </td>
                    <td>{{$asset_user->asset->name}}</td>
                    @if ($user->role == App\Models\User::ROLE_ADMIN)
                        <td>{{$asset_user->employee->name}}</td>
                    @endif
                    <td>{{$asset_user->created_at}}</td>
                    <td>{{$asset_user->asset->costCenter->name}}</td>
                    <td>{{$asset_user->from}}</td>
                    <td>{{$asset_user->to}}</td>

                    @if ($asset_user->end_of_life)
                    <td class="text-danger">
                        Yes
                    @else
                    <td class="text-primary">
                        No
                    @endif
                    </td>


                    <td>
                    @if (!$asset_user->end_of_life || $user->role == App\Models\User::ROLE_ADMIN)
                        <div class="btn-group-vertical">
                            <a class="btn btn-success"  href="{{route('assets.view', [$asset_user->asset_id, $asset_user->employee_id ])}}" >Show</a>
                            <button class="btn btn-warning mt-1"
                            type="button" data-toggle="modal"
                            data-asset="{{json_encode($asset_user)}}"
                            data-target="#assetEditModal">Edit</button>

                            <button class="btn btn-danger mt-1"
                            type="button" data-toggle="modal"
                            data-asset="{{json_encode($asset_user)}}"
                            data-target="#assetDeleteModal" >Delete</button>
                        </div>
                    @endif
                    </td>

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example ">
        <ul class="pagination float-right">
            @if ($asset_users->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{$asset_users->previousPageUrl()}}">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="{{$asset_users->url(1)}}">1</a></li>
            @endif
            @if ($asset_users->currentPage() > 3)
                <li class="page-item"><span class="page-link page-active">...</span></li>
            @endif
            @if ($asset_users->currentPage() >= 3)
                <li class="page-item"><a class="page-link" href="{{$asset_users->url($asset_users->currentPage() - 1)}}">{{$asset_users->currentPage() - 1}}</a></li>
            @endif


            <li class="page-item"><span class="page-link page-active">{{$asset_users->currentPage()}}</span></li>

            @if ($asset_users->currentPage() <= $asset_users->lastPage() - 2)
                <li class="page-item"><a class="page-link" href="{{$asset_users->url($asset_users->currentPage() + 1)}}">{{$asset_users->currentPage() + 1}}</a></li>
            @endif

            @if ($asset_users->currentPage() < $asset_users->lastPage() - 2)
                <li class="page-item"><span class="page-link page-active">...</span></li>
            @endif

            @if ($asset_users->currentPage() < $asset_users->lastPage() )
                <li class="page-item"><a class="page-link" href="{{$asset_users->url($asset_users->lastPage())}}">{{$asset_users->lastPage()}}</a></li>
                <li class="page-item"><a class="page-link" href="{{$asset_users->nextPageUrl()}}">&raquo;</a></li>
            @endif

        </ul>
    </nav>

</div>

<div class="modal fade" id="assetAddModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Asset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="assetAddAlert"></div>
                <div class="form-group">
                    <label for="assetAddName">Name</label>
                    <input type="text" class="form-control" id="assetAddName" placeholder="Name">
                    <div class="alert-message text-danger" id="nameError"></div>
                </div>
                <div class="form-group">
                    <label for="assetAddDescription">Description</label>
                    <textarea class="form-control" id="assetAddDescription" cols="30" rows="3"></textarea>
                    <div class="alert-message text-danger" id="descriptionError"></div>
                </div>
                <div class="form-group">
                    <label for="assetAddDate">Input date(Asset entry date in use)</label>
                    <input type="date" class="form-control" id="assetAddDate" placeholder="Date Use">
                    <div class="alert-message text-danger" id="dataError"></div>
                </div>
                <div class="form-group">
                    <label for="assetAddFrom">From</label>
                    <input type="text" class="form-control" id="assetAddFrom" placeholder="From">
                    <div class="alert-message text-danger" id="fromError"></div>
                </div>
                <div class="form-group">
                    <label for="assetAddTo">To</label>
                    <input type="text" class="form-control" id="assetAddTo" placeholder="To">
                    <div class="alert-message text-danger" id="toError"></div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="assetAddButton">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="assetEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Asset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="assetEditAssetId" value="">
                <input type="hidden" id="assetEditEmployeeId" value="">
                <div class="alert alert-danger d-none" id="assetEditAlert"></div>
                <div class="form-group">
                    <label for="assetEditName">Name*</label>
                    <input type="text" class="form-control" id="assetEditName" placeholder="Name">
                    <div class="alert-message text-danger" id="nameEditError"></div>
                </div>
                <div class="form-group">
                    <label for="assetEditDescription">Description*</label>
                    <textarea class="form-control" id="assetEditDescription" cols="30" rows="3"></textarea>
                    <div class="alert-message text-danger" id="descriptionEditError"></div>
                </div>
                <div class="form-group">
                    <label for="assetEditDate">Input date(Asset entry date in use)*</label>
                    <input type="date" class="form-control" id="assetEditDate" placeholder="Date Use">
                    <div class="alert-message text-danger" id="dataEditError"></div>
                </div>
                <div class="form-group">
                    <label for="assetEditFrom">From*</label>
                    <input type="text" class="form-control" id="assetEditFrom" placeholder="From">
                    <div class="alert-message text-danger" id="fromEditError"></div>
                </div>
                <div class="form-group">
                    <label for="assetEditTo">To*</label>
                    <input type="text" class="form-control" id="assetEditTo" placeholder="To">
                    <div class="alert-message text-danger" id="toEditError"></div>
                </div>
                <div class="form-group custom-checkbox">
                    <div class="form-check">
                        <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="assetEditEndLife">
                        <label class="form-check-label custom-control-label" for="assetEditEndLife">End of Life</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="assetEditOwnerId">Give this asset to:</label>
                    <select class="form-control" name="assetEditOwnerId" id="assetEditOwnerId">
                        <option value=""></option>
                        @foreach ($employee as $emp )
                             <option value="{{$emp->id}}">{{$emp->name}}</option>
                        @endforeach
                    </select>
                    <div class="alert-message text-danger" id="toEditError"></div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="assetEditButton">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="assetDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Asset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <legend id="assetDeleteName"></legend>
                <input type="hidden" id="assetDeleteAssetId" value="">
                <input type="hidden" id="assetDeleteEmployeeId" value="">
                <div class="alert alert-danger d-none" id="assetDeleteAlert"></div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="assetDeleteButton">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection
