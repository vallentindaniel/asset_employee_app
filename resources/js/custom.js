


/**
 * Edit Asset User
 */

 $('#assetEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let asset_emp =  button.data('asset') ;

    let asset = asset_emp.asset;

    let modal = $(this);

     console.log(asset);

     modal.find('#assetEditAssetId').val(asset_emp.asset_id);
     modal.find('#assetEditEmployeeId').val(asset_emp.employee_id);
    modal.find('#assetEditName').val(asset.name);
    modal.find('#assetEditDescription').val(asset.description);
    modal.find('#assetEditDate').val(asset.input_date);
    modal.find('#assetEditFrom').val(asset_emp.from);
    modal.find('#assetEditTo').val(asset_emp.to);
});




/**
 * Edit Asset User
 */

 $('#assetDeleteModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let asset_emp =  button.data('asset') ;

    let modal = $(this);

    modal.find('#assetDeleteName').val(asset_emp.asset.name);
    modal.find('#assetDeleteAssetId').val(asset_emp.asset_id);
    modal.find('#assetDeleteEmployeeId').val(asset_emp.employee_id);
});










/**
 * Edit Cost Center
 */

 $('#costCenterEditModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let costCenter =  button.data('ccenter') ;

    let modal = $(this);
     //console.log(costCenter.id);
     modal.find('#costCenterEditId').val(costCenter.id);
    modal.find('#costCenterEditName').val(costCenter.name);

});

/**
 * Delete Cost Center
 */

 $('#costCenterDeleteModal').on('shown.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let costCenter =  button.data('ccenter') ;

    let modal = $(this);

    modal.find('#costCenterDeleteId').val(costCenter.cost_center_id);

});

$(document).ready(function() {



    $('#assetDeleteButton').on('click', function() {
        $('#assetDeleteAlert').addClass('d-none');


        let asset_id = $('#assetEditAssetId').val();
        let employee_id = $('#assetEditEmployeeId').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/delete-asset/',
            data: { asset_id:asset_id, employee_id:employee_id }
        }).done(function (response) {
            if(response.error){
                console.log(response);
            }else{
                console.log(response);
                $('#assetDeleteAlert').text('Deleted').removeClass('d-none');
                window.setTimeout( window.location.reload(), 4000 );
            }
        });

    });

    $('#assetEditButton').on('click', function() {
        $('#assetEditAlert').addClass('d-none');

        let asset_id = $('#assetEditAssetId').val();
        let employee_id = $('#assetEditEmployeeId').val();

        let owner_id = $('#assetEditOwnerId').val();
        let name = $('#assetEditName').val();
        let description = $('#assetEditDescription').val();
        let input_date = $('#assetEditDate').val();
        let from = $('#assetEditFrom').val();
        let to = $('#assetEditTo').val();
        let end_of_life = $('#assetEditEndLife').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/edit-asset/',
            data: {asset_id:asset_id, employee_id:employee_id, name: name,
                description: description, input_date: input_date, from: from, input_to: to, owner_id:owner_id, end_of_life: end_of_life}
        }).done(function (response) {
            if(response.error){
                console.log(response);
            }else{
                $('#assetAddAlert').text('Saved').removeClass('d-none');
                window.setTimeout( window.location.reload(), 4000 );
            }
        }).fail(function (response) {
            $('#nameEditError').text(response.responseJSON.errors.name);
            $('#descriptionEditError').text(response.responseJSON.errors.description);
            $('#dataEditError').text(response.responseJSON.errors.input_date);
            $('#fromEditError').text(response.responseJSON.errors.from);
            $('#toEditError').text(response.responseJSON.errors.input_to);
        });

    });









    $('#assetAddButton').on('click', function() {
        $('#assetAddAlert').addClass('d-none');


        let name = $('#assetAddName').val();
        let description = $('#assetAddDescription').val();
        let input_date = $('#assetAddDate').val();
        let from = $('#assetAddFrom').val();
        let to = $('#assetAddTo').val();

      //  console.log(name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/add-asset/',
            data: { name: name, description: description, input_date: input_date, from: from, input_to: to }
        }).done(function (response) {
            if(response.error){
                console.log(response);
            }else{
                $('#assetAddName').val('') ;
                $('#assetAddDescription').val('');
                $('#assetAddDate').val('');
                $('#assetAddFrom').val('');
                $('#assetAddTo').val('');

                $('#assetAddAlert').text('Saved').removeClass('d-none');
                window.setTimeout( window.location.reload(), 4000 );
            }
        }).fail(function (response) {
            $('#nameError').text(response.responseJSON.errors.name);
            $('#descriptionError').text(response.responseJSON.errors.description);
            $('#dataError').text(response.responseJSON.errors.input_date);
            $('#fromError').text(response.responseJSON.errors.from);
            $('#toError').text(response.responseJSON.errors.input_to);
        });
    });

    $('#costCenterEditButton').on('click', function() {
        $('#costCenterEditAlert').addClass('d-none');

        let id = $('#costCenterEditId').val();
        let name = $('#costCenterEditName').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/cost-center/update/' + id,
            data: {name: name}
        }).done(function(response) {
            if (response.error !== '') {
                $('#costCenterEditAlert').text(response.error).removeClass('d-none');
            } else {
                window.location.reload();
            }
        });
    });


    $('#costCenterDeleteButton').on('click', function() {
        var id = $( "#costCenterDeleteId" ).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/cost-center/delete/'+id
        }).done(function(response) {
             window.location.reload();
        });
    });

});
