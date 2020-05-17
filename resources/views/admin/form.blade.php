@extends('layouts.layout_admins.main')
@section('title','thêm sản phẩm')
@section('content')
<form action="" method="post" enctype= "multipart/form-data" >
  @csrf

  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Them moi san pham</h3>


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
        <input type="file" name="image[]" class="image" multiple class="form-control">
      </div>
      <!-- /.form-group -->
    </div>
    <div class="col-md-6">
      <div class="row">
        <img id="imageTarget" width="50">
        <div id="showImage">
            
        </div>
      </div>
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
@section('js')
<script type="text/javascript">
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
            $('#showImage').append('<img src="'+test.result+'" width="50px">');
              };
        }
    }
  }
});
</script>
@endsection