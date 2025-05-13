    <style type="text/css">
        table{
            border: 1px solid gray;   
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid gray;   
            border-collapse: collapse;
        }
        th{
            text-align: center !important;
            padding: 10px !important;
        }
    </style>
    <div class="kt-portlet__body">
        <div class="row">
            <?php $users = App\User::all(); ?>
            <div class="form-group col-lg-2">
                <label for="user-name">Product Name:</label>
                <select name="add" id="user-name" class="form-control" onchange="fetchProductDetails(this)">
                    <option value="">Select Product</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-2">
                <label>Number</label>
                <input type="number" class="form-control" placeholder="Mobile Number" id="mobileno" name="mobileno" readonly>
            </div>

            <div class="form-group col-lg-2">
                <label>Gender</label>
                <div class="form-control">
                    <input type="radio" name="gender" value="1" id="male"> Male &nbsp;&nbsp;
                    <input type="radio" name="gender" value="2" id="female"> Female
                </div>
            </div>

            <div class="form-group col-lg-2">
                <label for="orderno">Order Number:</label>
                <input type="text" class="form-control" name="orderno" value="po/{{ $orderCount }}" readonly>
            </div>
            <div class="row">
        
            <table class="table table-striped table-bordered table-hover table-checkable datatable" style="overflow: auto !important">
                <thead>
                    <tr>
                        <td>#</td>
                        <td width="20%">Item Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Item Total Price</td>
                        <td>GST (%)</td>
                        <td>GST Total</td>
                        <td>Discount (%)</td>
                        <td>Discount Amount</td>
                        <td>Final Total</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="div_clone" data-id="0">
                        <td>
                            <button type="button" class="addaddress">
                                <i class="fas fa-plus"></i> 
                            </button>
                            <button class="minusaddress">
                                <i class="fas fa-minus"></i> 
                            </button>
                        </td>
                        <?php $products = App\Product::all(); ?>
                        <td>
                            <select name="item_name[]" class="form-control item_name" id="item_name_0">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="price[]" class="form-control price" id="price_0" data-id="0" readonly></td>
                        <td><input type="number" name="quantity[]" class="form-control quantity" id="quantity_0" data-id="0"></td>
                        <td><input type="number" name="itempricetotal[]" class="form-control itempricetotal" id="itempricetotal_0" data-id="0" readonly></td>
                        <td><input type="number" name="gst[]" class="form-control gst" id="gst_0" data-id="0" placeholder="Enter GST (%)"></td>
                        <td><input type="number" name="gst_total[]" class="form-control gst_total" id="gst_total_0" data-id="0" readonly></td>
                        <td><input type="number" name="discount[]" class="form-control discount" id="discount_0" data-id="0" placeholder="Enter Amount (%)"></td>
                        <td><input type="number" name="discount_amount[]" class="form-control discount_amount" id="discount_amount_0" data-id="0" readonly></td>
                        <td><input type="number" name="final_total[]" class="form-control final_total" id="final_total_0" data-id="0" readonly></td>
                    </tr>
                </tbody>
                <tfoot>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        
                        <td><input type="number" class="form-control" name="total_price" id="total_price" readonly></td>
                        <td></td>
                        <td><input type="number" class="form-control" name="quantity_total_price" id="quantity_total_price" readonly></td>
                    
                        <td></td>
                        <td><input type="number" class="form-control" name="gst_item_total" id="gst_item_total" readonly></td>
                        <td></td>
                        <td></td>
                        <td><input type="number" class="form-control" name="final_item_total" id="final_item_total" readonly></td>
                    </tr>
                </tfoot>
            </table>
            </div>
            
        </div>
    </div>


    <script>
        function fetchProductDetails(select) {
        let userId = select.value;

        if (userId) {
            $.ajax({
                url: '/order/get-order-details/' + userId,  // Updated URL
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#mobileno').val(response.mobileno);
                        
                        if (response.gender == 1) {
                            $('#male').prop('checked', true);
                        } else if (response.gender == 2) {
                            $('#female').prop('checked', true);
                        }
                    }
                }
            });
        } else {
            $('#mobileno').val('');
            $('input[name="gender"]').prop('checked', false);
        }
    }
    </script>


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
    <script>$(document).ready(function() {
        var count = 1; // Start with one .div_clone

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

        // Function to calculate the GST total for a specific row
        function calculateGST(id) {
            let gstPercentage = parseFloat($('#gst_' + id).val()) || 0; // Get the GST percentage
            let itemPriceTotal = parseFloat($('#itempricetotal_' + id).val()) || 0; // Get the item price total
            let gstTotal = (itemPriceTotal * gstPercentage) / 100; // Calculate GST total
            $('#gst_total_' + id).val(gstTotal.toFixed(2)); // Display result
            calculateGSTItemTotal(); // Calculate overall GST total
            calculateFinalTotal(id); // Recalculate final total after GST calculation
        }

        // Function to calculate the discount total for a specific row
        function calculateDiscount(id) {
            let discountPercentage = parseFloat($('#discount_' + id).val()) || 0; // Get the discount percentage
            let itemPriceTotal = parseFloat($('#itempricetotal_' + id).val()) || 0; // Get the item price total
            let discountAmount = (itemPriceTotal * discountPercentage) / 100; // Calculate discount amount
            $('#discount_amount_' + id).val(discountAmount.toFixed(2)); // Display result
            calculateTotalDiscount(); // Calculate overall discount total
            calculateFinalTotal(id); // Recalculate final total after discount calculation
        }

        // Function to calculate the final total for a specific row
        function calculateFinalTotal(id) {
            let itemTotalPrice = parseFloat($('#itempricetotal_' + id).val()) || 0; // Get the item price total
            let gstTotal = parseFloat($('#gst_total_' + id).val()) || 0; // Get the GST total
            let discountAmount = parseFloat($('#discount_amount_' + id).val()) || 0; // Get the discount amount

            // Calculate the final total
            let finalTotal = itemTotalPrice + gstTotal - discountAmount; // Adjust the formula as necessary

            // Display the result in the final_total field
            $('#final_total_' + id).val(finalTotal.toFixed(2)); // Round to 2 decimal places
            
            // Update the overall final item total after each row's final total calculation
            calculateFinalItemTotal();
        }

        // Function to calculate the overall final item total
        function calculateFinalItemTotal() {
            let finalItemTotal = 0;
            $('.final_total').each(function() {
                let finalTotalValue = parseFloat($(this).val()) || 0; // Get value of each final_total field
                finalItemTotal += finalTotalValue; // Sum the values
            });
            $('#final_item_total').val(finalItemTotal.toFixed(2)); // Display total in the #final_item_total field
        }

        // Function to calculate the overall GST item total
        function calculateGSTItemTotal() {
            let gstItemTotal = 0;
            $('.gst_total').each(function() {
                let gstValue = parseFloat($(this).val()) || 0; // Get value of each gst_total field
                gstItemTotal += gstValue; // Sum the values
            });
            $('#gst_item_total').val(gstItemTotal.toFixed(2)); // Display total GST
        }

        // Function to calculate the total discount across all rows
        function calculateTotalDiscount() {
            let totalDiscount = 0;
            $('.discount_amount').each(function() {
                let discountValue = parseFloat($(this).val()) || 0; // Get value of each discount_amount field
                totalDiscount += discountValue; // Sum the values
            });
            $('#total_discount').val(totalDiscount.toFixed(2)); // Display total discount
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

            // Clear or initialize as needed
            $clone.find('.itemname').val('').attr('id', 'itemname_' + newId);
            $clone.find('.price').val('').attr('id', 'price_' + newId);
            $clone.find('.quantity').val('').attr('id', 'quantity_' + newId);
            $clone.find('.itempricetotal').val('').attr('id', 'itempricetotal_' + newId);
            $clone.find('.gst').val('').attr('id', 'gst_' + newId);
            $clone.find('.discount').val('').attr('id', 'discount_' + newId);
            $clone.find('.gst_total').val('').attr('id', 'gst_total_' + newId);
            $clone.find('.discount_amount').val('').attr('id', 'discount_amount_' + newId);
            $clone.find('.final_total').val('').attr('id', 'final_total_' + newId); // Add final_total field
            
            // Append the cloned row after the original
            $row.after($clone);
            
            // Recalculate totals after adding new fields
            calculateTotalPrice();
            calculateGrandTotal();
        });

        // Delete address fields
        $(document).on('click', '.minusaddress', function() {
            var cloneCount = $('.div_clone').length;
            if (cloneCount > 1) { // Ensure at least one set of fields remains
                $(this).closest('.div_clone').remove();
                calculateTotalPrice(); // Recalculate total after deleting fields
                calculateGrandTotal();
            }
        });

        // Update itempricetotal whenever a price or quantity value changes
        $(document).on('input', '.price, .quantity', function() {
            var dataId = $(this).closest('.div_clone').attr('data-id');
            updateItemPriceTotalByDataId(dataId); // Update itempricetotal for the current row
            calculateTotalPrice(); // Recalculate total price after any change
            calculateGrandTotal(); // Recalculate grand total after any change
            calculateFinalTotal(dataId); // Calculate final total after item price or quantity change
        });

        // Handle input changes for the gst field
        $(document).on('input', '.gst', function() {
            let id = $(this).closest('.div_clone').attr('data-id'); // Get the row ID
            calculateGST(id); // Call GST calculation function
        });

        // Handle input changes for the discount field
        $(document).on('input', '.discount', function() {
            let id = $(this).closest('.div_clone').attr('data-id'); // Get the row ID
            calculateDiscount(id); // Call discount calculation function
        });

        // Initial calculation for existing rows on page load
        $('.div_clone').each(function(index) {
            $(this).attr('data-id', index); // Update data-id sequentially starting from 0
            updateItemPriceTotalByDataId(index); // Perform initial update for itempricetotal
        });

        // Initial calculation for overall final item total on page load
        calculateFinalItemTotal();
    });
    </script>

    
<script>
    // validation field
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.gst, .discount').forEach(function (input) {
        input.addEventListener('input', function () {
            if (this.value < 0) {
                this.value = '';
                alert("Please enter a positive value.");
            }
        });
    });
});
</script>