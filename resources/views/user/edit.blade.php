<table>
        <thead>
            <tr>
                <th>Actions</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="textareaContainer">
            @foreach($data->orders as $key => $order)
            <tr class="div_clone" data-id="{{$key}}">
                <td>
                    <button type="button" class="addaddress">Add</button>
                    <button class="minusaddress">Delete</button>
                </td>
                <td><input type="text" name="itemname[]" class="itemname" id="itemname_{{$key}}" value="{{$order->item_name}}"></td>
                <td><input type="number" name="price[]" class="price" id="price_{{$key}}" data-id="{{$key}}" value="{{$order->price}}"></td>
                <td><input type="number" name="quantity[]" class="quantity" id="quantity_{{$key}}" data-id="{{$key}}" value="{{$order->quantity}}"></td>
                <td><input type="number" name="itempricetotal[]" class="itempricetotal" id="itempricetotal_{{$key}}" data-id="{{$key}}" value="{{$order->itempricetotal}}" readonly></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total:</td>
                <td><input type="number" name="total_price" id="total_price" value="{{$data->total_price}}" readonly></td>
            </tr>
        </tfoot>
    </table>
<script>
	$(document).ready(function() {
    var count = {{$data->orders->count()}}; // Start from the number of existing rows

    function calculateTotal() {
        var total = 0;
        $('.price').each(function() {
            var value = parseFloat($(this).val()) || 0;
            total += value;
        });
        $('#total_price').val(total.toFixed(2));
    }

    function updateItemPriceTotalByDataId(dataId) {
        var $row = $('.div_clone[data-id="' + dataId + '"]');
        var priceVal = parseFloat($row.find('.price').val()) || 0;
        var quantityVal = parseFloat($row.find('.quantity').val()) || 0;
        var result = priceVal * quantityVal;
        $row.find('.itempricetotal').val(result.toFixed(2));
    }

    calculateTotal();

    $(document).on('click', '.addaddress', function() {
        count++;
        var $row = $(this).closest('.div_clone');
        var $clone = $row.clone();
        $clone.attr('data-id', count);
        $clone.find('.itemname').val('').attr('id', 'itemname_' + count);
        $clone.find('.price').val('').attr('id', 'price_' + count);
        $clone.find('.quantity').val('').attr('id', 'quantity_' + count);
        $clone.find('.itempricetotal').val('').attr('id', 'itempricetotal_' + count);
        $row.after($clone);
        calculateTotal();
    });

    $(document).on('click', '.minusaddress', function() {
        var cloneCount = $('.div_clone').length;
        if (cloneCount > 1) {
            $(this).closest('.div_clone').remove();
            calculateTotal();
        }
    });

    $(document).on('input', '.price, .quantity', function() {
        var dataId = $(this).closest('.div_clone').attr('data-id');
        updateItemPriceTotalByDataId(dataId);
        calculateTotal();
    });

    $('.div_clone').each(function(index) {
        updateItemPriceTotalByDataId(index);
    });
});

	</script>