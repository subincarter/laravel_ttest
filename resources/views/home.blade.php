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
        <button  style="float: right;"><a href="{{url('cartList')}}" class=""> wishList</a></button>
    @csrf
        <table>
            <thead>
                 <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{$d['id']}}</td>
                    <td>{{$d['productname']}}</td>
                    <td>{{$d['price']}}</td>
                    <td><a href="{{url('addToWishlist',$d['id'])}}" class="btn btn-primary">Add to cart</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </form>

</body>

</html>