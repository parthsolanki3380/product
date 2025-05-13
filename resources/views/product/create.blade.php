<div class="kt-portlet__body">
	<div class="row">
	

	<!-- <?php $products = App\Product::all(); ?>
        <div class="form-group col-lg-2">
            <label for="product-name">Product Name:</label>
            <select name="product_name" id="product-name" class="form-control " onchange="fetchProductDetails(this)">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div> -->

        <div class="form-group col-lg-2">
            <label>Name</label>
            <input type="text" id="name" class="form-control" placeholder="Name" name="name" required>
        </div>

        <div class="form-group col-lg-2">
            <label>Description</label>
            <textarea id="description" class="form-control" placeholder="Description" name="description" required></textarea>
        </div>

        <div class="form-group col-lg-2">
            <label>Price</label>
            <input type="number" id="price" class="form-control" placeholder="Price" name="price" required min="0">
        </div>

        <?php $categories = App\Categories::all(); ?>
        <div class="form-group col-lg-2">
            <label for="cate">Categories:</label>
            <select name="categories" id="cate" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" class="form-control">{{ $cat->name }}</option>
                @endforeach
            </select>
		</div>

		<div class="form-group col-lg-2">
			<label>Image</label>
			<input type="file" name="image" class="form-control">
		</div>
		
		
		

	</div>
</div>

<script>
    function fetchProductDetails(selectElement) {
        var productId = selectElement.value;  // Get the selected product ID

        if (productId) {
            // Perform AJAX request to get product details
            $.ajax({
                url: '/product/get-product-details/' + productId, // Laravel route to fetch product details
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        // Populate the fields with the response data
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                        $('#price').val(response.price);
                        $('#cate').val(response.category_id); // Set category in dropdown
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching product details: " + error);
                }
            });
        } else {
            // Clear fields if no product is selected
            $('#name').val('');
            $('#description').val('');
            $('#price').val('');
            $('#cate').val('');
        }
    }
</script>
