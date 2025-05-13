@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid_item kt-grid_item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					User
				</h3>
				
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					&nbsp;

				<div class="kt-portlet__head-actions">
				<form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            	<button class="btn btn-primary">Import Users</button>
				</form>
						<a class="btn btn-brand btn-elevate btn-icon-sm" href="{{ route('user.export-users') }}">Export Users</a>
						<a href="{{ route('user.create') }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>Add User</a>
						
					</div>

				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
				<table class="table table-striped table-bordered table-hover table-checkable datatable" id="datatable_rows">
					@csrf
					<thead>
						<tr>
							<th>SrNo</th>
							<th>Name</th>
							<th>E-mail</th>	
							<th>Mobileno</th>
							<th>Gender</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
		'table_name' => 'User',
		'is_orderby'=>'',
		'folder_name'=>'',
		'action' => array('change-status-1' => __('Active'), 'change-status-0' => __('Inactive'))
		))
	</div>
</div>


@stop
@push('scripts')

<script>

	$(document).ready(function() {

		$('#datatable_rows').DataTable({

			processing: true,
			serverSide: true,
			searchable: true,
			scrollX: true,
			// stateSave: true,
			columnDefs: [{
				orderable: false,
				targets: -1,
			}],

			ajax: "{{ route('user.index') }}",

			columns: [
			{
				orderable: true,
				searchable: true,
				data: "id"
			},
			{
				orderable: true,
				searchable: true,
				data: "name"
			},
			{
				orderable: false,
				searchable: false,
				data: 'email'

			},
			{
				orderable: false,
				searchable: false,
				data: 'mobileno'

			},
			{

				orderable: false,
				searchable: false,
				data: 'gender',
			},
			{

				orderable: false,
				searchable: false,
				data: 'image',
			},
			{

				orderable: false,
				searchable: false,
				data: 'status',
			},
			
			{
				orderable: false,
				searchable: false,
				'data': 'action',
			},
			]
		});

	});



	function changeStatus($this,id)

	{

		var sta = $($this).val();

		$.ajax({

			type: 'POST',
			url: '{{route("user.status")}}',

			data: { '_token': '{{ csrf_token() }}',
			id: id,
			status: sta,
		},

		dataType: 'json',
		success: function(data) {
			if (data.status == 'success') {

				toastr["success"]("Status Changed successfully", "Success");

				location.reload();

			} else {

				toastr["error"]("Something went wrong!", "Error");

				location.reload();

			}
		}

	});

	}
</script>

@endpush



