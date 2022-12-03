<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    {{--start toastr--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
</head>
<body>

<div class="container">
    <form method="POST" id="upload-image-form" enctype="multipart/form-data">

        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <div class="form-group">
            <label for="exampleInputEmail1">image</label>
            <input type="file" class="form-control" id="image" name="image">

        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">name</label>
            <input type="text" class="form-control" id="name" name="name">

        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">price</label>
            <input type="number" class="form-control" id="price" name="price">

        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">description</label>
            <input type="text" class="form-control" id="description" name="description">

        </div>


        <button type="submit" class="btn btn-success submitted">Upload</button>
    </form>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{--satrt toastr--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>


<script>


  $('#upload-image-form').submit(function(e) {

      {{--start change text in button--}}
      e.preventDefault();
      $('.submitted').prop('disabled', true);
      $(".submitted").text($(".submitted").text().replace("Upload", "Working now..."));

       setTimeout(function() {
          $('.submitted').prop('disabled', false);
           $(".submitted").text($(".submitted").text().replace("Working now...","Upload"));

       }, 6000);
      {{--end change text in button--}}

      let formData = new FormData(this);
      $.ajax({

          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },


          type:'POST',
          enctype : 'multipart/form-data',
          url : "{{route("products.store")}}",
          data: formData,
          contentType: false,
          processData: false,
          cache: false,


          success: function (data) {

              if(data.status === true){

                  toastr.success(data.message);
                  $("#image").val('');
                  $("#name").val('');
                  $("#price").val('');
                  $("#description").val('');

              }
          },

          error: function (data) {

              if (data.status === 422) {

                  var errors = $.parseJSON(data.responseText);
                  $.each(errors, function (key, value) {
                      if ($.isPlainObject(value)) {
                          $.each(value, function (key, value) {
                              toastr.error(value, key);
                          });
                      }
                  });
              }
          }

      });



  });

</script>
</body>
</html>