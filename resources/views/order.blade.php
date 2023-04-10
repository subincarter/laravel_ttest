<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <form action="" method="">
        <button  style="float: right;"><a href="{{url('products')}}" class=""> goto product</a></button>
    @csrf
        <table>
            <thead>
                <th>Product Name</th>
                <th>Product Price</th>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{$d['products']['productname']}}</td>
                    <td>{{$d['price']}}</td>
                    <td><a href="{{url('removeProduct',$d['id'])}}" class="btn btn-primary">remove</a></td>
                    <td><a href="{{url('buyProduct',$d['id'])}}" class="btn btn-primary">Buy</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </form>

</body>

</html>