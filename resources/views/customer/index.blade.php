@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid_item kt-grid_item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Customer
				</h3>
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					&nbsp;

					<div class="kt-portlet__head-actions">
						<a href="{{ route('customer.create') }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>Add customer</a>
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
							<th>no</th>
							
							<th>address</th>
							<th>country</th>
							<th>state</th>
							<th>city</th>
							<th>postal_code</th>
							<!-- <th>number</th> -->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
		'table_name' => 'customers',
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

			ajax: "{{ route('customer.index') }}",

			columns: [
			{
				orderable: true,
				searchable: true,
				data: "id"
			},
		
			{
				orderable: true,
				searchable: true,
				data: "address"
			},
			{
				orderable: true,
				searchable: true,
				data: "country"
			},
			{
				orderable: true,
				searchable: true,
				data: "state"
			},
			{
				orderable: true,
				searchable: true,
				data: "city"
			},
			{
				orderable: true,
				searchable: true,
				data: "postal_code"
			},
			// {
			// 	orderable: true,
			// 	searchable: true,
			// 	data: "number"
			// },
			
			
			{
				orderable: true,
				searchable: false,
				'data': 'action',
			},
			
			
			]
		});

	});



</script>

@endpush



