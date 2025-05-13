
<div class="kt-portlet__body">
	<div class="row">

		<div class="form-group col-lg-2">
			<label>Name </label>
			<input type="text" class="form-control" placeholder="Name" name="name" required value="{{$data->name}}">
		</div>
        <div class="form-group col-lg-2">
			<label>Company Email </label>
			<input type="Email" class="form-control" placeholder="Company Email" name="Company_Email" required value="{{$data->Company_Email}}">
		</div>
		
		<div class="form-group col-lg-2">
    		<label>Company Address</label>
    		<textarea class="form-control" placeholder="Company Address" name="Company_Address" required value="{{$data->Company_Address}}"></textarea>
		</div>

		<div class="form-group col-lg-2">
			<label>Company number </label>
			<input type="number" class="form-control" placeholder="Company number" name="Company_number" required value="{{$data->Company_number}}">
		</div>
		
		<table class="table table-striped table-bordered table-hover table-checkable datatable" >
		<thead>
			<tr>
				<th>#</th>
				<th>imagename</th>
				<th>image</th>
			</tr>
		</thead>
        <tbody>
        <?php $cus = App\Contact::where('id', $data->id)->first(); ?>
		<?php $img = App\Image::where('imageid', $cus->id)->get(); ?>
		
		@foreach($img as $key => $image)
            <tr class="newdiv_clone">
				<td>
					
                </td>
                <td>
				<input type="hidden" name="hidden_id[]" value="{{ $image->id }}">
				<input type="text" name="edit_imagename[]" class="edit_clone-imagename form-control" id="imagename_{{ $key }}" data-id="{{ $key }}" value="{{ $image->imagename }}">
                </td>
                <td>
                <input type="file" name="edit_image[]" class="edit_cloneable-image form-control" id="image_{{ $key }}" data-id="{{ $key }}">
                @if($image->image)
                <img src="{{ asset('images/' . $image->image) }}" alt="{{ $image->imagename }}" width="100">
				<br>
        		<a href="{{ asset('images/' . $image->image) }}" download>
    <i class="fas fa-download"></i> 
</a>
                @endif
            </td>
            @endforeach
            </tr>
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