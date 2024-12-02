<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        toastr()->closeButton()->success('Category added successfully.');
        return redirect()->back();

    }

    public function delete_category($id){
        $data= Category::find($id);
        $data->delete();
        toastr()->closeButton()->success('Category Deleted successfully.');
        return redirect()->back();
    }
}
