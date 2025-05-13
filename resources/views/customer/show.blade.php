@extends('main')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid_item kt-grid_item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Product Show
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
			<div class="kt-portlet__body">
	<div class="row">

    <div class="form-group col-lg-2">
			<label>Name </label>
			<input type="text" class="form-control" placeholder="Name" name="name" required value="{{$data->name}}">
		</div>
		

		
	</div>	
</div>
			</div>
		</div>
		
	</div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $(".showCustomerBtn").on("click", function(e){
            e.preventDefault();
            var customerId = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/show/" + customerId, // Use the correct route
                success: function (data) {
                    // Handle the response data here
                    console.log(data);
                    // Example: Update the DOM to display the customer data
                    
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>




