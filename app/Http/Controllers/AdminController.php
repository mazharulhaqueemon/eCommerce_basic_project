<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Pest\Mutate\Event\Events\Test\Outcome\Timeout;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request){

        $category = new Category;
        $category->category_name= $request->category;
        $category->save();
        toastr()->timeOut(10000) ->closeButton()->addSuccess('Category added successfully.');
        return redirect()->back();

    }

    public function delete_category($id){
        $data= Category::find($id);
        $data->delete();
        toastr()->closeButton()->success('Category Deleted successfully.');
        return redirect()->back();
    }

    public function edit_category($id){
        $data = Category::find($id);
        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request,$id){
        $data=Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        return redirect('/admin/view_category');
    }

    public function add_product(){
        $category = Category::all();
        return view('admin.add_product',compact('category'));
        }

    public function upload_product(Request $request){
        $product = new Product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price	=$request->price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        $image = $request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension ();
            $request->image->move('products',$imageName );
            $product->image = $imageName;
        }

        $product->save();
        toastr()->closeButton()->success('Product Uploaded successfully.');
        return redirect()->back();
    }

    public function view_product()
    {
        $product = Product::paginate(3); // Fetch a paginated collection
        return view('admin.view_product', compact('product'));
    }

    public function delete_product($id){
        $data = Product::find($id);
        //  belw 3 line code for delete image from the public/products folder
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        toastr()->closeButton()->success('Product Deleted successfully.');
        return redirect()->back();
    }

    public function product_update($id){
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.product_update',compact('data','category'));

    }

    public function edit_product(Request $request , $id){

        $data =Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension ();
            $request->image->move('products',$imageName );
            $data->image= $imageName;
        }
        $data->save();
        return redirect('/view_product');


    }

    public function product_search( Request $request){

        $search = $request->search;
        $product = Product::where('title','LIKE','%'.$search.'%')->
        orWhere('category','LIKE','%'.$search.'%')->paginate(3);

        return view('admin.view_product',compact('product'));

    }

    public function view_orders(){
        $data = Order::all();
        return view('admin.order',compact('data'));
    }

    public function on_the_way($id){
        $data = Order::find($id);
        $data->status = 'On the Way';

        $data->save();

        return redirect('/view_orders');
    }
    public function delivered($id){
        $data = Order::find($id);
        $data->status = 'Delivered';

        $data->save();

        return redirect('/view_orders');
    }

    public function print_pdf($id){

        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');


    }


}
