<div class="kt-portlet__body">
	<div class="row">

		<div class="form-group col-lg-2">
			<label>Name </label>
			<input type="text" class="form-control" placeholder="Name" name="name" required value="{{$data->name}}">
		</div>
		<div class="form-group col-lg-2">
    		<label>Description </label>
    		<textarea class="form-control" placeholder="Description" name="description" required>{{ $data->description }}</textarea>
		</div>

		<div class="form-group col-lg-2">
			<label>Price </label>
			<input type="number" class="form-control" placeholder="Price" name="price" required min="0" value="{{$data->price}}" >
		</div>

		<div class="form-group col-lg-2">
			<label>Image</label>
			<input type="file" name="image" class="form-control">
			<img src="{{asset('product/'.$data->image)}}" width="100px" height="100px">
		</div>

		<?php $categories =  App\Categories::all(); ?>
		<div class="form-group col-lg-2">
    	<label for="cate">Categories:</label> 
		<select name="categories" id="cate" class="form-control"> 
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" class="form-control" @if($cat->id == $data->category_id ) selected @endif>{{ $cat->name }}</option>
        @endforeach
    	</select>
		</div>
    
	</div>
</div>
