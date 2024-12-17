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
                        <th> Edit</th>
                        <th> Delete </th>

                    </tr>
                   @foreach ($data as $item)
                   <tr>
                    <td> {{$item->category_name}} </td>
                    <td>
                        <a class="btn btn-success" href=" {{url('edit_category',$item->id)}} ">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category',$item->id)}}">Delete</a>
                    </td>
                </tr>

                   @endforeach
                </table>
            </div>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
@include('admin.js')

  </body>
</html>
