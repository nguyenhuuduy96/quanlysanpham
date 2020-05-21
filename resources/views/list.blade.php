<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<style type="text/css">
	li:hover{
		background: #5897fb;
		color: white;
	}
	.addSizePriceStock{
		margin-top: 30px;
	}


	</style>
</head>
<body>
<div class="container">

  <div class="row">
  	<div class="col-sm-12">
  		<div class="form-group">
	  		<select class="js-example-placeholder-multiple js-states form-control" multiple="multiple"></select>
  		</div>
  	</div>
<!--   </div class="ShowSearhProduct">
 
  <div > -->
  	
  </div>   
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th>product name</th>
        <th>source</th>
        <th>Time expired</th>
        <th><a data-toggle="modal" data-target="#ModalProduct" class="btn btn-primary">Add new product</a></th>
        <th><a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTableSize">Table Size</a></th>
      </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
      <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->source}}</td>
        <td>{{$product->time_expired}}</td>
        <td><a  class="btn btn-danger" id="deleteRow" onclick="tabledeleteProduct(this,'{{$product->id}}')">delete</a></td>
        <td><a href="{{route('get.form.update',$product->id)}}" class="btn btn-success">update</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>	
<div class="modal fade" id="modalTableSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Table Sizes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

        <table class="table table-hover" id="TableSize">
          <thead>
            <tr>
              <th>#</th>
              <th>Size</th>
              <th>Remove</th>
              <th><a class="btn btn-default" data-toggle="modal" data-target="#AddNewSize">add new size</a></th>
            </tr>
          </thead>
          <tbody class="table_size">
          	@foreach($sizes as $size)
            <tr>
              <th scope="row">{{$size->id}}</th>
              <td>{{$size->size}}</td>

              <td><a class="btn btn-danger" onclick="tabledeleteSize(this)">delete</a></td>
              <td><a id="{{$size->id}}" class="btn btn-primary UpdateSize">Update</a></td>
            </tr>
            @endforeach
            
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="AddNewSize" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<form method="post" id="submitSize">
						<div class="modal-header">
						<h4 class="modal-title title-size">Thêm mới một size</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						
						</div>
						<div class="modal-body inputsize">
							<input class="newSize" name="size" >
							<input type="submit" value="submit" class="btn btn-info"><br>
							<span class="text-danger errorsSize"></span>
							<span class="text-success successSize"></span>
						</div>
						<div class="modal-footer">
							
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>
					
				</div>

			</div>
</div>	
<!-- product modal -->
<div class="modal fade" id="ModalProduct">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="container">
          	<div class="row">
          		<div class="col-sm-8">
          			<div class="form-group">
						<label for="type">Ten san pham:</label>
						<input type="type" class="form-control" id="name" placeholder="ten san pham" name="name" >
						<span class="errorName" style="color: red"></span>
					</div>
					<div class="form-group">
						<label for="source">nguon:</label>
						<input type="type" class="form-control" id="source" placeholder="source" name="source" >
						<span class="errorsource" style="color: red"></span>
					</div>
					<div class="form-group">
						<label for="date">thoi gian het han:</label>
						<input type="date" class="form-control" id="date" placeholder="time_expired" name="date" >
						<span class="errortime_expired" style="color: red"></span>
					</div>
					<div class="form-group">
						<label >file image</label>
						<input type="file" name="image[]" class="form-control image" multiple="">
						<span class="errorimage" style="color: red"></span>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
				              <label>size</label>
				              <select class="form-control" name="size_id[]" class="validatesize"  style="width: 100%;">
								<option value="">-- chọn --</option>
				              	@foreach($sizes as $size)
								<option  
								 value="{{$size->id}}">{{$size->size}}</option>
				              	@endforeach
				              </select>
				             </div>

				            <div class="col-md-5">
				             <label>giá</label>
				             <input type="number" name="price[]" class="form-control" >
				           </div>
				           <div class="col-md-2">
				             <label>số lượng</label>
				             <input type="number" name="stock[]" class="form-control" >	                  
				           </div>
				           
				           <div class="col-md-2">
				           	<label><a class="btn btn-outline-primary addSizePriceStock">thêm</a>  </label>
				           	
				           </div>

				        </div>
					</div>
					<div class="form-group" id="getsize">
						
					</div>

          		</div>
          		<div class="row col-sm-4" id="showImage">
          			<div class="col-md-6"><img src="{{asset('img/default.jpg')}}" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236"><div class="form-group"><label>vị trí</label><input type="number" name="sort[]" class="form-control"></div></div>
          			
          		</div>
          	</div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>	
<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#addsize').click(function(){
			$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		});
	
		$(".js-example-placeholder-multiple").select2({
		    placeholder: "Select a state"
		});
		function tabledeleteProduct(r,id) {
			var i = r.parentNode.parentNode.rowIndex;
			console.log(i);
			console.log(id);
			let alertDeleteProduct = confirm("Are you sure you want to delete!");
			if (alertDeleteProduct == true) {
				$.ajax({
						url:"{{route('delete.product')}}",
						method:"get",
						data:{id:id},
						success:function(data){
							// console.log(data.product);
							document.getElementById("myTable").deleteRow(i);
					
						}
				})

			}  
		}
		function tabledeleteSize(r) {
			console.log(r);
			var i = r.parentNode.parentNode.rowIndex;
			console.log(i);
			document.getElementById("TableSize").deleteRow(i);
		 
		}
		
		
		$(document).ready(function(){
			$('.select2-search__field').on('keyup',function(){
				var search = $(this).val();
				$.ajax({
					url:"{{route('get.search')}}",
					method:"get",
					data:{search:search},
					success:function(data){
						console.log(data.products);
						// let listsearch ="";
						let showsearch = ``;
						for (const x of data.products) {
							showsearch +='<li role="alert" aria-live="assertive" class="select2-results__option select2-results__message">'+x.name+'</li>';
						}
						$('.select2-results__options').html(showsearch);
						
					}
				})
			})
		});
		 

</script>
@include("layouts.js")
</body>
</html>