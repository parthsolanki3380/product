<?php
$genratepdf = route($route.'.genratepdf',$id);
?>

<a href="{{ $genratepdf }}" style="background: white;" class="showCustomerpdfBtn" title="dowwnlod pdf">
    <i style="color: black;" class="fas fa-file-pdf"></i> 
</a>&nbsp;&nbsp; 

<?php
$edit = route($route.'.edit',$id);
?>

<a style="background: white;" href="{{ $edit }}" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
	<i style="color: green;" class="la la-edit"></i>
</a>&nbsp;&nbsp;

 <?php
$delete = route($route.'.delete',$id);
?> 

<button style="background: white;" title="Delete" data-id="{{$id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>&nbsp;&nbsp;

<?php
$showUrl = route($route.'.show', $id); 
?>

<a href="{{ $showUrl }}" style="background: white;" class="showProductBtn" data-id="{{ $id }}" title="View Details">
    <i style="color: orange;" class="fas fa-eye"></i>
</a>&nbsp;&nbsp;&nbsp;





