<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index() {
        $products = Product::latest()->paginate(10);

        return view('admin.product.list', compact('products'));

    }

    public function create() {

        return view('admin.product.create');

    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'description' => 'required'

        ]);

        // echo "test";

        // exit;


        if($validator->passes()) {

            $product = new Product();
            $product->product_name = $request->name;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->save();


            $request->session()->flash('success','product Added successfully');

            return response()->json([
                'status' => true,
                'message' => 'product Added successfully'
            ]);
            
            

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($productId, Request $request) {

        $product = product::find($productId);

        if(empty($product)) {

            return redirect()->route('products.index');
        }

        return view('admin.product.edit',compact('product'));

    }

    public function update($productId, Request $request) {

        $product = product::find($productId);

        if(empty($product)) {

            return response()->json([
                'status' => false,
                'notfound'=>true,
                'errors' => 'category not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required'

        ]);

        if($validator->passes()) {

            $product->product_name = $request->name;
            $product->save();

            $request->session()->flash('success','product Updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'product Updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function destroy($productId, Request $request) {

        $product = product::find($productId);

        if(empty($product)) {

            return redirect()->route('products.index');
        }

        $product->delete();

        $request->session()->flash('success','product Deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'product Deleted successfully'
        ]);

    }

}
