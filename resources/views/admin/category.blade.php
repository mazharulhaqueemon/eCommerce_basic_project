<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style type="text/css">
    input[ type="text" ]
    {
        width:400px;
        height: 50px;
    }
    .design
    {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
    }
    .table_dgn{

        text-align: center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
        width: 600px;
    }
    th{
        background-color: skyblue;
        padding: 15px;
        font-size:20px;
        font-weight: bold;
        color: white;

    }
    td
    {
        color: white;
        padding: 10px;
        border: 1px solid skyblue;
    }

    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1> Add Category</h1>

            <div class="design">
                <form action="{{url('add_category')}}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="category">
                        <input class="btn btn-primary" type="submit" value="Add Category">
                    </div>
                </form>
            </div>

            <div>
                <table class="table_dgn">
                    <tr>
                        <th> Category Name</th>
                        <th> Delete </th>
                    </tr>
                   @foreach ($data as $item)
                   <tr>
                    <td> {{$item->category_name}} </td>
                    <td>
                        <a class="bth btn-danger" onclick="confirmation(event)" href="{{url('delete_category',$item->id)}}">Delete</a>
                    </td>
                </tr>

                   @endforeach
                </table>
            </div>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script type="text/javascript">
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href'); // Fixed syntax
    console.log(urlToRedirect);
    swal({
        title: "Are You Sure To Delete This", // Fixed typo
        text: "This delete will be permanent",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => { // Changed variable name to reflect action
        if (willDelete) {
            window.location.href = urlToRedirect;
        }
    });
}
    </script>
    {{-- cdn link for delete category dilog box --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>

  </body>
</html>
