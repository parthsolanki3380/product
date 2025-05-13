<div class="kt-portlet__body">
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Company Name </label>
			<input type="text" class="form-control" placeholder="Company Name" name="Company_Name" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Company Email </label>
			<input type="Email" class="form-control" placeholder="Company Email" name="Company_Email" required>
		</div>
		
		<div class="form-group col-lg-2">
    		<label>Company Address</label>
    		<textarea class="form-control" placeholder="Company Address" name="Company_Address" required></textarea>
		</div>

		<div class="form-group col-lg-2">
			<label>Company number </label>
			<input type="number" class="form-control" placeholder="Company number" name="Company_number" required>
		</div>
		

		<table  class="table table-striped table-bordered table-hover table-checkable datatable" >
		<thead>
			<tr>
				<th>#</th>
				<th>imagename</th>
				<th>image</th>
			</tr>
		</thead>
        <tbody>
            <tr class="div_clone">
				<td>
                    <button type="button" class="addaddress btn btn-success"><i class="fas fa-plus"></i></button>
                    <button type="button" class="minusaddress btn btn-danger"><i class="fa fa-minus"></i></button>
                </td>
                <td>
                    <input type="text" name="imagename[]" class="clone-imagename form-control" id="imagename_0" data-id="0">
                </td>
                <td>
                    <input type="file" name="image[]" class="cloneable-image form-control" id="image_0" data-id="0">
                </td>
                
            </tr>
        </tbody>
    </table> 

		
		</div>
		
	</div>
</div>

<script>
$(document).ready(function() {
    var count = 0; 

    $(document).on('click', '.addaddress', function() {
        count++; 
        var $row = $(this).closest('tr');
        var $clone = $row.clone();
        
        // Reset the imagename input
        $clone.find('.clone-imagename').val('').attr('id', 'imagename_' + count).attr('data-id', count);
        
        // Reset the file input
        $clone.find('.cloneable-image').val('').attr('id', 'image_' + count).attr('data-id', count);
        
        // Insert the cloned row after the current row
        $row.after($clone);
    });

    $(document).on('click', '.minusaddress', function() {
        var clone = $('#textareaContainer tbody tr').length;
        if (clone !== 1) {
            var $obj = $(this).closest('tr');
            $obj.remove();
        }
    });
});
</script>