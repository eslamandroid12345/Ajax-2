<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <form method="POST" id="update-product-form" enctype="multipart/form-data">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <div id="alert" style="display: none" class="alert alert-danger mt-5"></div>
        <div id="alert-two" style="display: none" class="alert alert-danger mt-5"></div>

        <input type="hidden" value="{{$product->id}}" name="product_id">

        <div class="form-group">
            <label for="exampleInputEmail1">image</label>
            <input type="file" class="form-control" id="image" name="image">
            <small id="image_error" class="form-text text-danger"></small>

        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">name</label>
            <input type="text" class="form-control" value="{{$product->name}}" name="name">
            <small id="name_error" class="form-text text-danger"></small>

        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">price</label>
            <input type="number" class="form-control" value="{{$product->price}}" name="price">
            <small id="price_error" class="form-text text-danger"></small>

        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">description</label>
            <input type="text" class="form-control"  value="{{$product->description}}" name="description">
            <small id="description_error" class="form-text text-danger"></small>

        </div>


        <button type="submit" class="btn btn-success">Update</button>
    </form>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>


    $('#update-product-form').submit(function(e) {

        e.preventDefault();
        $('#image_error').text('');
        $('#name_error').text('');
        $('#price_error').text('');
        $('#description_error').text('');


        let formData = new FormData(this);


        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type:'post',
            enctype : 'multipart/form-data',
            url : "{{route("products.update")}}",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,


            success: function (data) {

                if(data.status === true){

                    $('#alert').show();
                    $('#alert').append(data.message);
                    $("#alert").delay(3000).fadeOut();
                    $("#image").val('');


                }
            },

            error: function (error) {

                var response = $.parseJSON(error.responseText);
                $.each(response.errors, function (key, val) {

                    $("#" + key + "_error").text(val[0]);

                });
            }

        });



    });

</script>
</body>
</html>