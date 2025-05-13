@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid_item kt-grid_item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Sale
				</h3>
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					&nbsp;

					<div class="kt-portlet__head-actions">
						<a href="{{ route('sells.create') }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>Add Sale</a>
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
							<th>id</th>
							<th>add</th>
							<th>total_price</th>
							<th>quantity_total_price</th>	
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
		'table_name' => 'addsells',
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

			ajax: "{{ route('sells.index') }}",

			columns: [
			{
				orderable: true,
				searchable: true,
				data: "id"
			},
			{
				orderable: true,
				searchable: true,
				data: "add"
			},
			{
				orderable: true,
				searchable: true,
			data: "total_price"
			},
			{
				orderable: true,
				searchable: true,
			data: "quantity_total_price"
			},
			]
		});

	});



</script>

@endpush



