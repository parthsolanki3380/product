<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .details {
            margin: 20px auto;
            padding: 20px;
            max-width: 900px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .details h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .details h3 {
            color: #555;
            margin-bottom: 15px;
            font-size: 20px;
        }
        .details p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .total-row td {
            font-weight: bold;
            color: #333;
        }
        .total-row td:last-child {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="details">
        <h2>{{ $title }}</h2>

        <h3>Order Details:</h3>
        <?php $users = App\Models\User::all(); ?>
<p>ID: {{ $add->id }}</p>

<p>Name: 
    @php
        // Find the user based on the ID stored in the 'add' field
        $user = $users->where('id', $add->add)->first(); // Use 'add' to find the user
    @endphp
    {{ $user ? $user->name : 'null' }} <!-- Display user name or 'null' if not found -->
</p>

        <p>Gender: 
    @if($add->gender == 1)
        male
    @elseif($add->gender == 2)
        female
    @else
        null
    @endif
</p>
        <p>Mobileno: {{ $add->mobileno }}</p>
        <p>Orderno:  {{ $add->orderno }}</p>
        <!-- Add more details as needed -->

        <table>
            <thead>
                <tr>
                <th>ID</th>
                    <th>Item Name</th>    
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>GST (%)</th>
                    <th>GST Total</th>
                    <th>Discount (%)</th>
                    <th>Discount Amount</th>
                    <!-- <th>Total Price</th> -->

                </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp
            @foreach($datamain as $data)
                <tr>  
                    <td>{{ $count }}</td>
                    @php
    // Fetch the product based on the ID in $data->item_name
    $product = App\Product::find($data->item_name); // Adjust based on actual ID column
@endphp

<td>
    {{ $product ? $product->name : 'Product not found' }} <!-- Display product name or a default message -->
</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->quantity }}</td>
                        <td>{{ $data->gst }}</td>
                        <td>{{ $data->gst_total }}</td>
                        <td>{{ $data->discount }}</td>
                        <td>{{ $data->discount_amount }}</td>
                        <!-- <td>{{ $data->itempricetotal }}</td>     -->
                </tr>
                @php $count++; @endphp
            @endforeach
            <tr></tr>
            <tr class="total-row">
    <td colspan="6" style="text-align: right;">Item Total:</td>
    <td colspan="2">{{ $add->total_price }}</td>
</tr>
<tr>
</tr>
<tr class="total-row">
    <td colspan="6" style="text-align: right; color: red;">Grand Total:</td>
    <td colspan="2" style="color: red;">{{ $add->final_item_total }}</td>
</tr>
            
            </tbody>
        </table>
    </div>
</body>
</html>
