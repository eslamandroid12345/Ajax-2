<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>

<div id="alert" style="display: none" class="alert alert-danger mt-5"></div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">price</th>
        <th scope="col">description</th>
        <th scope="col">image</th>
        <th>action</th>
    </tr>
    </thead>

    @foreach($products as $product)
        <tbody>
        <tr class="raw_{{$product->id}}">
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td><img style="width: 50px;height: 50px" src="{{URL::to('/products/'. $product->image)}}"></td>

             <td>
                 <a href="" product_id="{{$product->id}}"  class="delete_btn btn btn-danger">Delete </a>
                 <a href="{{route('products.edit',$product->id)}}"   class="btn btn-success">edit </a>
             </td>
        </tr>

        </tbody>
        @endforeach
</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).on('click', '.delete_btn', function (e) {

        e.preventDefault();
        var product_id =  $(this).attr('product_id');


        $.ajax({

            type: 'post',
            url: "{{route('products.delete')}}",
            data: {

                '_token': "{{csrf_token()}}",
                'id' : product_id
            },
            success: function (data) {

                if (data.status == true) {

                    $('#alert').show();
                    $('#alert').append(data.message);
                    $("#alert").delay(3000).fadeOut();
                    $('.raw_' + data.id).remove();

                }
            }
        });
    });
</script>
</body>
</html>