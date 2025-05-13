<!-- <?php
$statusRoute = route($route . '.status', $id);
?> 

<label for="status-dropdown-{{ $id }}"></label>
<select class="status-dropdown" id="status-dropdown-{{ $id }}" data-id="{{ $id }}">
    <option value="1" {{ $status == 1 ? 'selected' : '' }}>Active</option>
    <option value="0" {{ $status == 0 ? 'selected' : '' }}>Inactive</option>
    <option value="2" {{ $status == 2 ? 'selected' : '' }}>pending</option>
</select> -->

<script>
    $(document).ready(function() {
        $('.status-dropdown').on('change', function() {
            var customerId = $(this).data('id');
            var status = $(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ $statusRoute }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: customerId,
                    status: status
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success('Status updated successfully');
                    } else {
                        toastr.error('Failed to update status');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error updating status: ' + error);
                }
            });
        });
    });
</script>
 <?php
$statusRoute = route($route . '.status', $id);
?> 
<input type="hidden" value="{{ $status }}">
<label class="form-check form-switch form-check-custom form-check-solid">
    <input class="form-check-input w-30px h-20px change_status" type="checkbox" 
        @if($status==1) checked @endif 
        value="{{ $id }}" 
        name="notifications" 
        id="status-{{$id}}" 
        href="status-{{$status}}">
</label> 