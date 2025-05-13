<div class="kt-portlet__body">
    <div class="row">
        <div class="form-group col-lg-2">
            <label>Name </label>
            <input type="text" class="form-control" placeholder="Name" name="add" value="{{$data->add}}">
        </div>

        <?php $add1 = App\Order::where('addid', $data->id)->get(); ?>
        <div class="kt-portlet__body">
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-striped table-bordered table-hover table-checkable datatable" id="datatable_rows">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>itemname</td>
                        <td>price</td>
                        <td>Quantity</td>
                        <td>item_total_price</td>
                    </tr>
                </thead>
                    <tbody id="textareaContainer">
                        @foreach ($add1 as $item1)
                        <tr class="div_clone" data-id="{{ $item1->id }}">
                        <td>
                        <a href="{{ route('deleteorder', $item1->id) }}" class="deleteselect22" >Delete</a>
                    </td>
                    <td>
                        <?php 
                        // Fetch the product based on item_name (which is the product ID)
                        $product = App\Product::find($item1->item_name);
                        ?>
                        <input type="text" name="edititemname[]" class="itemname" id="itemname_{{ $item1->id }}" data-id="{{ $item1->id }}" 
                               value="{{ $product ? $product->name : 'Unknown Product' }}">
                        </td>
                            <!-- <td><input type="text" name="edititemname[]" class="itemname" id="itemname_{{ $item1->id }}" data-id="{{ $item1->id }}"  value="@if($item1->item_name == 1) Vanela Gathiya 
                              @elseif($item1->item_name == 2) Sev
                              @elseif($item1->item_name == 3) garlicmumura
                              @else {{ $item1->item_name }} @endif"></td> -->
                            <td><input type="number" name="editprice[]" class="price" id="price_{{ $item1->id }}" data-id="{{ $item1->id }}" value="{{ $item1->price }}"></td>
                            <td><input type="number" name="editquantity[]" class="quantity" id="quantity_{{ $item1->id }}" data-id="{{ $item1->id }}" value="{{ $item1->quantity }}"></td>
                            <td><input type="number" name="edititempricetotal[]" class="itempricetotal" id="itempricetotal_{{ $item1->id }}" data-id="{{ $item1->id }}" value="{{ $item1->price * $item1->quantity }}" readonly></td>
                            <input type="hidden" name="hidden_id[]" value="{{ $item1->id }}">
                        </tr>
                        @endforeach
                        <tr class="div_clone" data-id="0">
                        <td>
                       <!-- Add Address Button with Plus Icon -->
                        <button type="button" class="addaddress">
                            <i class="fas fa-plus"></i> 
                        </button>

<!-- Delete Address Button with Minus Icon -->
                        <button class="minusaddress">
                            <i class="fas fa-minus"></i> 
                        </button>
                    </td>
                    <?php $products = App\Product::all(); ?>
                    <td>
                        <select name="item_name[]" class="item_name" id="item_name_0">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    </td>     
            <td>
            <input type="number" name="price[]" class="price" id="price_0" data-id="0" readonly>
            </td><td><input type="number" name="quantity[]" class="quantity" id="quantity_0" data-id="0"></td>
                <td><input type="number" name="itempricetotal[]" class="itempricetotal" id="itempricetotal_0" data-id="0" readonly></td>
                </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><input type="number" name="total_price" id="total_price" readonly></td>
                            <td></td>
                            <td><input type="number" name="quantity_total_price" id="quantity_total_price" readonly></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Event handler for changes in the select element
    $(document).on('change', '.item_name', function() {
        var $select = $(this);
        var selectedProductId = $select.val();
        var $priceInput = $select.closest('tr').find('.price');

        // Find the selected option
        var selectedOption = $select.find('option:selected');
        var price = selectedOption.data('price');

        // Set the price in the price input field
        $priceInput.val(price);
    });
});
</script>
<script>
$(document).ready(function() {
    var count = {{ $add1->count() }}; // Start with the number of existing rows

    // Function to calculate the total sum of all price fields
    function calculateTotalPrice() {
        var total = 0;
        $('.price').each(function() {
            var value = parseFloat($(this).val()) || 0;
            total += value >= 0 ? value : 0; // Ensure value is non-negative
        });
        $('#total_price').val(total.toFixed(2)); // Display total in the #total_price field
    }

    // Function to calculate the grand total of all itempricetotal fields
    function calculateGrandTotal() {
        var grandTotal = 0;
        $('.itempricetotal').each(function() {
            var value = parseFloat($(this).val()) || 0;
            grandTotal += value >= 0 ? value : 0; // Ensure value is non-negative
        });
        $('#quantity_total_price').val(grandTotal.toFixed(2)); // Display grand total in the #quantity_total_price field
    }

    // Function to update itempricetotal based on price * quantity for a specific row
    function updateItemPriceTotalByDataId(dataId) {
        var $row = $('.div_clone[data-id="' + dataId + '"]');
        var priceVal = parseFloat($row.find('.price').val()) || 0;
        var quantityVal = parseFloat($row.find('.quantity').val()) || 0;
        var result = priceVal * quantityVal;
        $row.find('.itempricetotal').val(result.toFixed(2)); // Update itempricetotal with result
    }

    // Initial calculation on page load
    calculateTotalPrice();
    calculateGrandTotal();

    // Add address fields
    $(document).on('click', '.addaddress', function() {
        count++;
        var $row = $(this).closest('.div_clone');
        var $clone = $row.clone();
        var newId = count; // New data-id for the cloned row
        $clone.attr('data-id', newId); // Set the new data-id
        $clone.find('.itemname').val('').attr('id', 'itemname_' + newId); // Clear or initialize as needed
        $clone.find('.price').val('').attr('id', 'price_' + newId);
        $clone.find('.quantity').val('').attr('id', 'quantity_' + newId);
        $clone.find('.itempricetotal').val('').attr('id', 'itempricetotal_' + newId); // Clear the cloned itempricetotal input
        $row.after($clone);
        calculateTotalPrice(); // Recalculate total after adding new fields
        calculateGrandTotal();
    });

    // Delete address fields
    $(document).on('click', '.minusaddress', function() {
        var cloneCount = $('.div_clone').length;
        if (cloneCount > 1) { // Ensure there is at least one set of fields
            var $obj = $(this).closest('.div_clone');
            $obj.remove();
            calculateTotalPrice(); // Recalculate total after deleting fields
            calculateGrandTotal();
        }
    });

    // Update itempricetotal whenever a price or quantity value changes
    $(document).on('input', '.price, .quantity', function() {
        var dataId = $(this).closest('.div_clone').attr('data-id');
        updateItemPriceTotalByDataId(dataId); // Update itempricetotal for the current row based on data-id
        calculateTotalPrice(); // Recalculate total price after any change
        calculateGrandTotal(); // Recalculate grand total after any change
    });

    // Initial calculation for existing rows on page load
    $('.div_clone').each(function(index) {
        $(this).attr('data-id', index); // Update data-id sequentially starting from 0
        updateItemPriceTotalByDataId(index); // Perform initial update for itempricetotal
    });
});
</script>
<script>
$(document).on('click', '.deleteselect22', function() {
    var url = $(this).data('url'); // Get the URL for the delete request

    // Confirm deletion
    var confirmDelete = confirm("Are you sure you want to delete this order and its associated data?");
    if (!confirmDelete) {
        return; // If user cancels, stop the process
    }

    // Send AJAX request to delete the record
    $.ajax({
        url: url,
        type: 'GET', // Use 'GET' for this route, or you can change to 'DELETE' for RESTful API design
        success: function(result) {
            alert(result.message); // Notify user of successful deletion
            
            // Remove the corresponding row from the table
            var row = $(this).closest('.div_clone');
            row.remove();

            // Optionally, recalculate totals or update the UI as needed
            calculateTotalPrice();
            calculateGrandTotal();
        }.bind(this), // Use .bind(this) to maintain the context inside the success callback
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
            alert('Error occurred while deleting the order.');
        }
    });
});
</script>