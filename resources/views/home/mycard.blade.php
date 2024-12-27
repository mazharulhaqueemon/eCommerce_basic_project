<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .div_dgn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;

        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }

        td {
            border: 1px solid skyblue;
        }
        .cart_value
        {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

    </div>

    <div class="div_dgn">
        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Remove</th>
                <?php
                $value=0;
                ?>
            </tr>
            @foreach ($cart as $item)
                <tr>
                    <td> {{ $item->product->title }} </td>
                    <td> {{ $item->product->price }} </td>
                    <td>
                         <img width="150px" src="/products/{{$item->product->image}}" alt="">
                    </td>
                    <td>
                        <a class=" btn btn-danger" href="{{url('delete_cart',$item->id)}} ">Remove</a>
                    </td>
                </tr>
                <?php
                $value = $value+$item->product->price;
                ?>
            @endforeach
        </table>
    </div>
    <div class="cart_value" >
        <h3>Total Value of Cart : ${{$value}} </h3>
    </div>





    <!-- info section -->
    @include('home.footer')


</body>

</html>
