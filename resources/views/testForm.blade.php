<html>  
    <head>  
        <title>Webslesson Tutorial | Insert Multiple Images into Mysql Database using PHP</title>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>  
    <body>  
        <br /><br />  
        <div class="container">  
   <h3 align="center">Insert Multiple Images into Mysql Database using PHP</h3>  
            <br />  
            <form method="post" id="upload_multiple_images" enctype="multipart/form-data"> {{ csrf_field() }}
                <input type="file" name="image[]" id="image" multiple accept=".jpg, .png, .gif" />
                <input type="file" name="image[]" id="image" multiple accept=".jpg, .png, .gif" />
               
                <input type="type" name="name[]" value="sadasd">
                <input type="type" name="name[]" value="sadasd2">
                <input type="type" name="name[]" value="sadasd4">
                <br />
                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
            </form>
            <br />  
            <br />
   
            <div id="images_list"></div>
            
        </div>  
    </body>  
</html>  
<script>  
  
$(document).ready(function(){
 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
    // load_images();

    // function load_images()
    // {
    //     $.ajax({
    //         url:"fetch_images.php",
    //         success:function(data)
    //         {
    //             $('#images_list').html(data);
    //         }
    //     });
    // }
 
    $('#upload_multiple_images').on('submit', function(event){
        event.preventDefault();
        
            $.ajax({
                url:"image",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
                success:function(data)
                {
                  console.log(data.name);
                  console.log(data.image);
                    // $('#image').val('');
                    // load_images();
                }
            });
        
    });
 
});  
</script>
