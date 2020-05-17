<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
	<form class="subimage" action="{{route('up.i')}}" method="post"  enctype="multipart/form-data">
		@csrf
		{{-- <input type="file" name="image[]" multiple><br> --}}
		<select name="size_id[]" id="showidsize">
			<option value="2" > --vui long chọn size--</option>
			<option value="1" > --chọn s--</option>
		</select><a class="clicksize">new</a><br><input type="text" name="price[]"><br>
		<div class="up"></div><div class="up"></div>
		
		<input type="submit" value="submit" >

	</form>
{{-- 	<div class="testImage">
		<input type="file" name="image[]" class="image" multiple>
		<button class="logImage">click</button>
	</div> --}}

	<img id="imageTarget" src="" class="img-responsive">
{{-- <img id="showImage" src="" class="img-responsive"> --}}
	<div class="showImage"></div>
{{-- 	<div class="testArray">
		<input type="type" name="name[]" class="nameArray">
		<input type="type" name="name[]" class="nameArray">
		<input type="type" name="name[]" class="nameArray">
		<button class="Array">Array</button>
	</div> --}}
<div class="container">
		<h1 class="text-center">Them moi san pham</h1>
		<div class="row shadow p-3 mb-5 bg-white rounded">
			<div class="col-sm-6">
				<form action="/action_page.php">
					<div class="form-group">
						<label for="type">Ten san pham:</label>
						<input type="type" class="form-control" id="name" placeholder="ten san pham" name="name">
					</div>
					<div class="form-group">
						<label for="source">nguon:</label>
						<input type="type" class="form-control" id="source" placeholder="source" name="source">
					</div>
					<div class="form-group">
						<label for="time_expired">thoi gian het han:</label>
						<input type="date" class="form-control" id="time_expired" placeholder="time_expired" name="time_expired">
					</div>
					<div class="form-group">
						<label >file image</label>
						<input type="file" name="image[]" class="image" multiple>
					</div>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">thêm size</button>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-sm-6">
				<div class="showImage">
					
				</div>
			</div>
		</div>

</div>
	

<div class="container">

  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">thêm size</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm mới một size</h4>
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
				$('#imageTarget').attr('src', '{{asset('img/default.jpg')}}');
			}else{
				const arrayImage =document.getElementsByClassName('image');
				const listImage =arrayImage[0].files;
		    // var showi='';
		    for (var i = 0; i < listImage.length; i++) {
		    	const image =listImage[i];
		    	const test = new FileReader();
		    	test.readAsDataURL(image);
		    	test.onload = function () {
		    	// console.log(reader.result);
		      	// console.log(test.result);
		      	$('.showImage').append('<img src="'+test.result+'" width="50px">');
		      		};
				}
		}
	}
});
		// $(document).ready(function(){
		// 	$('.logImage').click(function(){
		// 		const aaa =document.getElementsByClassName('image');
		// 		var array = $('.image').val();
		// 		var blockImage='';
		// 		  // var openFile = function(event) {

		// 			  // };


		// 		const ii =aaa[0].files;
		// 		for (var i = 0; i < ii.length; i++) {

		// 			 var input = ii[i].target;


		// 			const si =ii[i];


		// 			blockImage+='<img src="'+si.name+'">';
		// 			console.log(si);
		// 		}
		// 		$('.showImage').html(blockImage);
		// 		console.log(blockImage);
		// 	});	
		// });
		$(document).ready(function(){
			$('.clicksize').click(function(){
				$.ajax({
					url:"{{ route('get.size')}}",
					method: 'get',
					success: function(data){
						console.log(data.getsize);
						$('.up').append(data.getsize);
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
						$('#showidsize').append(data.listsize);
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