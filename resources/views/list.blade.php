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



	</style>
</head>
<body>
<div class="container">
  <h2>Bordered Table</h2>
            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>product name</th>
        <th>source</th>
        <th>Time expired</th>
        <th><a href="" class="btn btn-primary">Add new product</a></th>
        <th><a href="" class="btn btn-primary">Table Size</a></th>
      </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
      <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->source}}</td>
        <td>{{$product->time_expired}}</td>
        <td><a href="#" class="btn btn-danger" id="show">delete</a></td>
        <td><a href="{{route('get.form.update',$product->id)}}" class="btn btn-success">update</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>	
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
    	<a href="#" id="Close">sdfsdf</a>
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="modal-body">
      <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

</div>
		
<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#addsize').click(function(){
			$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		});

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