<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ShopController extends Controller
{
    public function index() {
        $shops = Shop::latest()->paginate(10);

        return view('admin.shop.list', compact('shops'));

    }

    public function create() {

        return view('admin.shop.create');

    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required'

        ]);

        if($validator->passes()) {

            $shop = new Shop();
            $shop->shop_name = $request->name;
            $shop->save();


            $request->session()->flash('success','Shop Added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Shop Added successfully'
            ]);
            
            

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($shopId, Request $request) {

        $shop = Shop::find($shopId);

        if(empty($shop)) {

            return redirect()->route('shops.index');
        }

        return view('admin.shop.edit',compact('shop'));

    }

    public function update($shopId, Request $request) {

        $shop = Shop::find($shopId);

        if(empty($shop)) {

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

            $shop->shop_name = $request->name;
            $shop->save();

            $request->session()->flash('success','Shop Updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Shop Updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function destroy($shopId, Request $request) {

        $shop = Shop::find($shopId);

        if(empty($shop)) {

            return redirect()->route('shops.index');
        }

        $shop->delete();

        $request->session()->flash('success','Shop Deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Shop Deleted successfully'
        ]);

    }

}
