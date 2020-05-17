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
</head>
<body>
	
	<div class="container">
		<h1 class="text-center">Them moi san pham</h1>
		<div class="row shadow p-3 mb-5 bg-white rounded">
			<div class="col-sm-6">
				<form  action="{{route('save.product')}}" method="POST" enctype="multipart/form-data">
					@csrf
				
					<div class="form-group">
						<label for="type">Ten san pham:</label>
						<input type="type" class="form-control" id="name" placeholder="ten san pham" name="name">
					</div>
					<div class="form-group">
						<label for="source">nguon:</label>
						<input type="type" class="form-control" id="source" placeholder="source" name="source">
					</div>
					<div class="form-group">
						<label for="date">thoi gian het han:</label>
						<input type="date" class="form-control" id="date" placeholder="time_expired" name="time_expired">
					</div>
					<div class="form-group">
						<label >file image</label>
						<input type="file" name="image[]" class="form-control image" multiple>
					</div>
					<div class="form-group">
						<div class="row">
				            <div class="col-md-3">
				              <label>size</label>
				              <select class="form-control" name="size_id[]" class="validatesize"  style="width: 100%;">
				                <option value="">-- chọn --</option>
				                @foreach($sizes as $size)
									<option value="{{$size->id}}">{{$size->size}}</option>
				                @endforeach
				              </select>
				            </div>
				            <div class="col-md-5">
				             <label>giá</label>
				             <input type="number" name="price[]" class="form-control">
				           </div>
				           <div class="col-md-2">
				             <label>số lượng</label>
				             <input type="number" name="stock[]" class="form-control">	                  
				           </div>
				           <div class="col-md-2">
				           	<label>  </label>
				           	<button type="button" class="form-control addSizePriceStock btn-primary">Them</button>
				           </div>
				        </div>
				        <div class="row getsize" >
				        	
				        </div>
					</div>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">thêm size</button>
					<input type="submit" value="Submit" class="btn btn-primary">
					<!-- <button type="submit" class="btn btn-primary" class="sub">Submit</button> -->
				</form>
			</div>
			<div class="col-sm-6">
				<div id="showImage" style="display: flex; flex-wrap: nowrap;">
					<div class="img">
						<img src="{{asset('img/default.jpg')}}" width="20%">
						
					</div>
				</div>
			</div>
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
	<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#addsize').click(function(){
			$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		});
		
		$(document).ready(function(){
			var img = document.querySelector('input[type="file"]');
			img.onchange = function(){
				var file = this.files[0];

				if(file == undefined){
					$('#showImage').append('<img src="{{asset("img/default.jpg")}}" width="20%">');
				}else{
					const arrayImage =document.getElementsByClassName('image');
					const listImage =arrayImage[0].files;
		    // var showi='';
		    for (var i = 0; i < listImage.length; i++) {
		    	const image =listImage[i];
		    	const test = new FileReader();
		    	test.readAsDataURL(image);
		    	test.onload = function () {

		    		$('#showImage').append('<img src="'+test.result+'" width="20%">');
		    	};
		    }
		}
	}
});

		$(document).ready(function(){
			$('.addSizePriceStock').click(function(){
				$.ajax({
					url:"{{ route('get.size')}}",
					method: 'get',
					success: function(data){
						console.log(data.getsize);
						$('.getsize').append(data.getsize);
					}
				});
			});
		});
		$(document).ready(function(){

			$(".postSize").click(function(){
				var newsize=$(".newSize").val();
				if (newsize=='') {
					$('.errorsSize').html('vui lòng nhập');
					return false;
				}
				$.ajax({

					url: '{{ route('save.size')}}',
					type: 'POST',
					data: {_token: CSRF_TOKEN, size:newsize},

					success: function (data) { 
						$('select').append(data.listsize);
						$('.successSize').html('thêm thành công');
					}
				}); 
			});
		});  
		function xoa(event){
			event.target.parentElement.remove();
		}   
		

	</script>
</body>
</html>