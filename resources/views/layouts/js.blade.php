<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
		
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
					url:"{{ route('get.size.all')}}",
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
    			// console.log(listImage);
    			for (var i = 0; i < listImage.length; i++) {
    				const image =listImage[i];
    				const test = new FileReader();

    				test.readAsDataURL(image);
    				test.onload = function () {		    		
    					$('#showImage').append('<div class="col-sm-2"><img src="'+test.result+'" width="100px" height="100px"><div style="width: 100%"><label>vi tri</label><input type="number" name="sort[]" class="form-control" width="100%"></div><a id="deletenewimage" style="position: absolute;top: 0;"><img src="{{asset('img/incon delete.jpg')}}" width="20px"></a></div>');
    				};
    			}
    		}
    	}
    });
  $(document).ready(function(){
		let btn = document.getElementsByClassName('deletenewimage');
			
			for (var i = 0; i < btn.length; i++) {
			  btn[i].addEventListener('click', function(e) {
			
			  	
				    e.currentTarget.parentNode.remove();	
			  	
				
			    
			  }, false);
			}
		
		
	})

    $(document).ready(function(){
        // $(".UpdateSize").click(function(){
        //     let id = $(this).attr("id");
        //     $.ajax({
        //         url:"{{route('get.size')}}",
        //         method:"get",
        //         data:{id:id},
        //         success:function(data){
        //             $('.title-size').html('Sửa size');
        //             $('.newSize').attr("value",data.size.size);
        //             $('.inputsize').append('<input class="Size_id" type="hidden" name="id" value="'+data.size.id+'">');

        //         }
        //     })
        // });



		
		
        $('#submitSize').on('submit', function(event){
            event.preventDefault();
            
                $.ajax({

                url: '{{ route('save.size')}}',
                method:"post",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },

                success: function (data) { 
                	// console.log(data.addsize);
                    $('select').append('<option value="'+data.addsize.id+'" > '+data.addsize.size+'</option>');
                    console.log('<option value="'+data.addsize.id+'" > '+data.addsize.size+'</option>');
                    const table = document.getElementById("TableSize");
                      var row = table.insertRow(1);
                      var cell1 = row.insertCell(0);
                      var cell2 = row.insertCell(1);
                      var cell3 = row.insertCell(2);
                      var cell4 = row.insertCell(3);
                      cell1.innerHTML = data.addsize.id;
                      cell2.innerHTML = data.addsize.size;
                      cell3.innerHTML ='<a class="btn btn-danger" onclick="tabledeleteSize(this)">delete</a>';
                      cell4.innerHTML ='<a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary">Update</a>';
                    // $('#TableSize').append('<tr><th scope="row">'+data.addsize.id+'</th><td>'+data.addsize.size+'</td><td><a class="btn btn-danger" onclick="tabledeleteSize(this)">delete</a></td><td><a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary">Update</a></td></tr>');
                    $('#submitSize').trigger("reset");
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