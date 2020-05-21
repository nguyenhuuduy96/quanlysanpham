<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<style type="text/css">
		div{
			position: relative;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<h1 class="text-center">update</h1>
		<div class="row shadow p-3 mb-5 bg-white rounded"> 
			<form action = "{{route('save.update')}}" method="POST" name = "myForm" onsubmit = "return(validate());" enctype="multipart/form-data">
				@csrf
				<div class="col-sm-6">
					<div class="form-group">
						<label for="type">Ten san pham:</label>
						<input type="hidden" name="id" value="{{$product->id}}">
						<input type="type" class="form-control" id="name" placeholder="ten san pham" name="name" value="{{$product->name}}">
						<span class="errorName" style="color: red"></span>
					</div>
					<div class="form-group">
						<label for="source">nguon:</label>
						<input type="type" class="form-control" id="source" placeholder="source" name="source" value="{{$product->source}}">
						<span class="errorsource" style="color: red"></span>
					</div>
					<div class="form-group">
						<label for="date">thoi gian het han:</label>
						<input type="date" class="form-control" id="date" placeholder="time_expired" name="date" value="{{$product->time_expired}}">
						<span class="errortime_expired" style="color: red"></span>
					</div>
					<div class="form-group">
						<label >file image</label>
						<input type="file" name="image[]" class="form-control image" multiple="">
						<span class="errorimage" style="color: red"></span>
						
					</div>
					<div class="form-group">
						<div class="row">
							@foreach($product->sizes as $value)
							<input type="hidden" name="middle_id[]" value="{{$value->pivot->id}}">
				            <div class="col-md-3">
				              <label>size</label>
				              <select class="form-control" name="size_id[]" class="validatesize"  style="width: 100%;">
	
				                <option value="">-- chọn --</option>
				              	@foreach($sizes as $size)
								<option @if($size->id == $value->id)
									selected
								@endif 
								 value="{{$size->id}}">{{$size->size}}</option>
				              	@endforeach
				              </select>
				              
				            </div>
				            <div class="col-md-5">
				             <label>giá</label>
				             <input type="number" name="price[]" class="form-control" value="{{$value->pivot->price}}">
				           </div>
				           <div class="col-md-2">
				             <label>số lượng</label>
				             <input type="number" name="stock[]" class="form-control" value="{{$value->pivot->stock}}">	                  
				           </div>
				           @endforeach
				           <div class="col-md-2">
				           	<label>  </label>
				           	<button type="button" class="form-control addSizePriceStock btn-primary">Them</button>
				           </div>
				        </div>
					</div>
					<div class="form-group" id="getsize">
						
					</div>
					
				</div>
			<div class="col-sm-6">
				<h3 class="text-center">Anh</h3>
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">thêm size</button>
				<div id="showImage" class="row">
					@foreach($product->images as $image)
						<div class="col-sm-2" style="position: relative;">
							
							<input type="hidden" name="image_id[]" value="{{$image->id}}"><img src="{{asset($image->image)}}" width="100px" height="100px"><div style="width: 100%"><label>vi tri</label><input type="number" name="sort[]" class="form-control" width="100%" value="{{$image->sort}}"></div> <a class="deleteimage" id="{{$image->id}}"style="position: absolute;top: 0;"><img src="{{asset('img/incon delete.jpg')}}" width="20px"></a></div>
							
					@endforeach
					
				</div>
			</div>

			<div class="col-sm-12">
				<input type = "submit" value = "Submit" />
			</div>	

			</form>   
			
		</div>

	</div>

	

	<div class="container">

		

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Thêm mới một size</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						
					</div>
					<div class="modal-body">
						<input class="newSize">
						<button class="postSize">Lưu</button><br>
						<span class="text-danger errorsSize"></span>
						<span class="text-success successSize"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

	</div>
	@include('layouts.js')
</body>
</html>