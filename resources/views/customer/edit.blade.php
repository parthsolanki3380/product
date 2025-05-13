
<div class="kt-portlet__body">
	<div class="row">

		
		<div class="form-group col-lg-2">
    		<label>Address </label>
    		<textarea class="form-control" placeholder="Description" name="address" required>{{ $data->address }}</textarea>
		</div>

		<div class="form-group col-lg-2">
                <label for="st" style="margin-bottom: 5px;">State:</label>
                <select name="state" id="st" class="form-control">
                    <option value="" disabled>Select State</option>
                    <option value="gujarat" {{ $data->state == 'gujarat' ? 'selected' : '' }}>Gujarat</option>
                    <option value="rajasthan" {{ $data->state == 'rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                </select>
            </div>

		<!-- Country Field -->
		<div class="form-group col-lg-2">
                <label for="ct" style="margin-bottom: 5px;">Country:</label>
                <select name="country" id="ct" class="form-control">
                    <option value="" disabled>Select Country</option>
                    <option value="india" {{ $data->country == 'india' ? 'selected' : '' }}>India</option>
                    <option value="pakistan" {{ $data->country == 'pakistan' ? 'selected' : '' }}>Pakistan</option>
                </select>
            </div>

		 <!-- City Field -->
		 <div class="form-group col-lg-2">
                <label for="city" style="margin-bottom: 5px;">City:</label>
                <select name="city" id="city" class="form-control">
                    <option value="" disabled>Select City</option>
                    <option value="rajkot" {{ $data->city == 'rajkot' ? 'selected' : '' }}>Rajkot</option>
                    <option value="ahmedabad" {{ $data->city == 'ahmedabad' ? 'selected' : '' }}>Ahmedabad</option>
                </select>
            </div>

		 <!-- Postal Code Field -->
		 <div class="form-group col-lg-2">
                <label>Postal Code</label>
                <input type="number" class="form-control" name="postal_code" value="{{ $data->postal_code }}" required>
            </div>

            <!-- Phone Number Field -->
            <!-- <div class="form-group col-lg-2">
                <label>Phone Number</label>
                <input type="number" class="form-control" name="phone_number" value="{{ $data->number }}" required>
            </div> -->
    
	</div>
</div>
