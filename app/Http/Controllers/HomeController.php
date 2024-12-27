<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }


    public function home(){
        $product = Product::all();
        if(Auth::id()){
            // Product for add to card count product
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.index',compact('product','count'));
    }

    public function login_home(){

        $product = Product::all();
        if(Auth::id()){
            // Product for add to card count product
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.index',compact('product','count'));

    }

    public function product_details($id){
        $data = Product::find($id);
        if(Auth::id()){
            // Product for add to card count product
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.product_details',compact('data','count'));
    }

    public function add_cart($id){
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();
        toastr()->timeOut(10000)->closeButton()
        ->addSuccess('Category added successfully.');

        return redirect()->back();
    }

    public function mycard(){

        if(Auth::id()){
            // Product for add to card count product
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        $cart = Cart::where('user_id',$userid)->get();
        }



        return view('home.mycard',compact('count','cart'));
    }

    public function delete_cart($id)
    {
        $data = Cart::find($id);

        $data->delete();

        flash()->success('The product has been Deleted successfully');

        return redirect()->back();
    }
}
