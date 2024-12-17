<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        .div_dgn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_dgn {
            border: 2px solid greenyellow;
        }

        th {
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }
        td {
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }
        .pagination_dgn
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <form action="">
                    <input type="search" name="search" >
                    <input type="submit" class="btn btn-secondary" >
                </form>
                <div class="div_dgn">

                    <table class="table_dgn">
                        <tr>
                            <th> Product Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        @foreach ($product as $products)
                            <tr>

                                <td> {{ $products->title }} </td>
                                <td>{{ $products->description }}</td>
                                <td> {{ $products->category }}</td>
                                <td> {{ $products->price }}</td>
                                <td> {{ $products->quantity }}</td>
                                <td>
                                    <img height="120" width="120" src="products//{{$products->image}}">
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{url('product_update',$products->id)}}">Update</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product',$products->id)}}">Delete</a>
                                </td>



                            </tr>
                        @endforeach

                    </table>







                </div>
                <div class="pagination_dgn">
                    {{ $product->onEachSide(1)->links() }}

                </div>

            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')


</body>

</html>
