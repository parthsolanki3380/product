@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid_item kt-grid_item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					inventory
				</h3>
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					&nbsp;

					

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
							<th>product_id</th>
							<th>stock</th>
							<th>used</th>
							
							<th>actul_stock</th>
							
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
		'table_name' => 'inventorys',
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

			ajax: "{{ route('inventory.index') }}",

			columns: [
			{
				orderable: true,
				searchable: true,
				data: "id"
			},
		
			{
				orderable: true,
				searchable: true,
				data: "product_id"
			},
			{
				orderable: true,
				searchable: true,
				data: "stock"
			},
			
			{
				orderable: true,
				searchable: true,
				data: "used"
			},
			
			{
				orderable: true,
				searchable: true,
				data: "actul_stock"
			},
			
			
			
			]
		});

	});



</script>

@endpush



