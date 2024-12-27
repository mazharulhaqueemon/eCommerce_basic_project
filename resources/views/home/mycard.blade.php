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

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_dgn {
            padding-right: 100px;
            margin-top: -50px;
        }

        label {
            display: inline-block;
            width: 150px;
        }

        .div_gap {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

    </div>

    <div class="div_dgn">
        <div class="order_dgn">
            <form action="{{url('confirm_order')}}" method="POST" >
                @csrf
                <div class="div_gap">
                    <label for="">Receiver Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                </div>

                <div class="div_gap">
                    <label for="">Receiver Address</label>

                    <textarea name="address">{{ Auth::user()->address }}</textarea>
                </div>

                <div class="div_gap">
                    <label for="">Phone</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <div class="div_gap">

                    <input class="btn btn-primary" type="submit" value="Place Order">
                </div>
            </form>
        </div>
        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Remove</th>
                <?php
                $value = 0;
                ?>
            </tr>
            @foreach ($cart as $item)
                <tr>
                    <td> {{ $item->product->title }} </td>
                    <td> {{ $item->product->price }} </td>
                    <td>
                        <img width="150px" src="/products/{{ $item->product->image }}" alt="">
                    </td>
                    <td>
                        <a class=" btn btn-danger" href="{{ url('delete_cart', $item->id) }} ">Remove</a>
                    </td>
                </tr>
                <?php
                $value = $value + $item->product->price;
                ?>
            @endforeach
        </table>
    </div>
    <div class="cart_value">
        <h3>Total Value of Cart : ${{ $value }} </h3>
    </div>





    <!-- info section -->
    @include('home.footer')


</body>

</html>
