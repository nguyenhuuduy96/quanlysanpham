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
	<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#addsize').click(function(){
			$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		});
		// $(document).ready(function(){
		// 	var xoa = document.getElementsByClassName('xoaSizePrice');
		// 	for (var i = 0; i < xoa.length; i++) {
		// 		xoa[i].addEventListener(function(e){
		// 			e.currentTarget.parentNode.remove();
		// 		},false);
		// 	}
		// })
		function validate() {

			if( document.myForm.name.value == "" ) {
	          	$('.errorName').html('vui long nhập!');
	            return false;
	        }else{
	        	$('.errorName').css('display','none');
	        }
	        if( document.myForm.source.value == "" ) {
	          	$('.errorsource').html('vui lòng nhập nguồn hàng!');
	            return false;
	        }else{
	        	$('.errorsource').css('display','none');
	        }
	        if( document.myForm.time_expired.value == "" ) {
	          	$('.errortime_expired').html('vui lòng chọn thời gian hết hạn!');
	            return false;
	        }else{
	        	$('.errortime_expired').css('display','none');
	        }
	        // if( $('.image').val() == "" ) {
	        //   	$('.errorimage').html('vui lòng chọn file!');
	        //     return false;
	        // }

        
        return( true );
    	}
    	$(document).ready(function(){
			$('.addSizePriceStock').click(function(){
				$.ajax({
					url:"{{ route('get.size')}}",
					method: 'get',
					success: function(data){
						console.log(data.getsize);
						var list='<div class="row"><div class="col-md-3"><label>size</label><select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize"><option selected="selected" value="">-- chọn --</option>';
						for(const x of data.getsize){
							list +='<option value="'+x.id+'" > '+x.size+'</option>'
						}
						list +='</select></div><div class="col-md-5"><label>giá</label><input type="number" name="price[]" class="form-control"></div><div class="col-md-2"><label>số lượng</label><input type="number" name="stock[]" class="form-control"></div><a style="width:75px; margin-top:23px" onclick="xoa(event)" class="form-control addSizePriceStock btn-danger">delete</a></div></div>';
						$('#getsize').append(list);
						console.log(list);
					}
				});
			});
		});
	$(document).ready(function(){
		var btn = document.getElementsByClassName('deleteimage');
			
			for (var i = 0; i < btn.length; i++) {
			  btn[i].addEventListener('click', function(e) {
			  	var alertXoa = confirm("Are you sure you want to delete!");
			  	var id = $(this).attr('id');
			  	if (alertXoa==true) {
			  		console.log(id); 
					$.ajax({
						url:"{{route('delete.image')}}",
						method:"get",
						data:{id:id},
						success:function(data){	
						}
					})
				    e.currentTarget.parentNode.remove();	
			  	}
				
			    
			  }, false);
			}
		
		
	})
    $(document).ready(function(){
    	var img = document.querySelector('input[type="file"]');
    	img.onchange = function(){
    		var file = this.files[0];

    		if(file == undefined){
    			$('#showImage').append('<img src="{{asset("img/default.jpg")}}" width="20%">');
    		}else{
    			$('.img').css('display','none');
    			const arrayImage =document.getElementsByClassName('image');
    			const listImage =arrayImage[0].files;

    			for (var i = 0; i < listImage.length; i++) {
    				const image =listImage[i];
    				const test = new FileReader();

    				test.readAsDataURL(image);
    				test.onload = function () {		    		
    					$('#showImage').append('<div class="col-sm-2"><img src="'+test.result+'" width="100px" height="100px"><div style="width: 100%"><label>vi tri</label><input type="number" name="sort[]" class="form-control" width="100%"></div></div>');
    				};
    			}
    		}
    	}
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
    				$('select').append('<option value="'+data.addsize.id+'" > '+data.addsize.size+'</option>');
    				console.log('<option value="'+data.addsize.id+'" > '+data.addsize.size+'</option>');
    				$('.successSize').html('thêm thành công');
    				confirm('success');
    				
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