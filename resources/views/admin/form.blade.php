@extends('layouts.layout_admins.main')
@section('title','thêm sản phẩm')
@section('content')
 <form action="" method="post" enctype= "multipart/form-data" >
        @csrf
        
   <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Select2 (Default Theme)</h3>

            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              	<div class="form-group">
              		<label>Tên sản phẩm</label>
              		<input type="type" name="name" class="form-control">
              	</div>
              	<div class="form-group">
              		<label>Hãng sản xuất</label>
              		<input type="type" name="source" class="form-control">
              	</div>
              	<div class="form-group">
              		<label>Thời gian hết hạn</label>
              		<input type="date" name="time_expired" class="form-control">
              	</div>
                <div class="form-group">
                	<div class="row">
                		<div class="col-md-3">
                		<label>size</label>
		                  <select class="form-control select2" style="width: 100%;">
		                    <option selected="selected">--chọn size--</option>
		                    <option>Alaska</option>
		                    <option>California</option>
		                    <option>Delaware</option>
		                    <option>Tennessee</option>
		                    <option>Texas</option>
		                    <option>Washington</option>
		                  </select>
	                	</div>
	                	<div class="col-md-5">
	                		<label>giá</label>
		                  	<input type="number" name="price" class="form-control">
	                	</div>
	                	<div class="col-md-3">
	                		<label>số lượng</label>
							<input type="number" name="stock" class="form-control">	                  
	                	</div>
                	</div>
                  
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>chọn file anh</label>
                  <input type="file" name="image[]" multiple class="form-control">
                </div>
                <!-- /.form-group -->
              </div>
            
            </div>
         
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>
       
      </div>
 </form>

@endsection