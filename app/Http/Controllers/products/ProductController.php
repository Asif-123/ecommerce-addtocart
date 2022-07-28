<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products\ProductModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Facades\Auth;
use App\Models\cart\CartModel;
use App\Models\categories\CategoryModel;

class ProductController extends Controller
{
    public function getproduct($id)
    {
        $products = DB::table('product')->where('cat_id', $id)->get();
        return view('products/product', ['products' => $products]);
    }

    public function addToCart(Request $request)
    {
        
//$quantity = $request->quantity;
       
        $userId = Auth::user();

        if (Auth::check()) {


            $prod_check = ProductModel::where('id', $request->proId)->first();
            $price = ($prod_check->price)*($request->quantity);

            if ($prod_check) {

                // if (CartModel::where('user_id', Auth::id())->where('product_id', $request->proId)->first()) 
                // {
                //     $status = array(
                //         'status' => '1',
                //     );
                //     DB::table('addtocart')->where('product_id', $request->proId)->update($status);
                //     return response()->json(['status' => 'Product added successfully !']);
                // }
                if(CartModel::where('user_id', Auth::id())->where('product_id', $request->proId)->exists()) 
                {
                    return response()->json(['status' => 'Product added already in cart']);
                } 
                else 
                {
                    $cart = new CartModel;
                    $cart->user_id = $userId->id;
                    $cart->product_id = $request->proId;
                    $cart->product_name = $prod_check->pname;
                    $cart->image = $prod_check->image;
                    $cart->price = $prod_check->price;
                    $cart->quantity = $request->quantity;
                    $cart->category_id = $prod_check->cat_id;
                    $cart->category_name = $prod_check->pcat;
                    $cart->total_amount = $price;
                    $cart->save();
                    return response()->json(['status' => 'Product added successfully !']);
                }
            }
        } else {
            return response()->json(['status' => 'Login to continue']);
        }
        
    }

    public function ViewCart()
    {
        $cart_data = CartModel::where('user_id', Auth::id())->get();
        return view('cart/cart', ['cart' => $cart_data]);
    }

    public function DeleteItem(Request $request)
    {

        CartModel::where('id', $request->proId)->where('user_id', Auth::id())->delete();
        return response()->json(['status' => 'Item deleted successfully !']);
        //return redirect('/view-cart');
        $this->ViewCart();
    }

    public function CartCount()
    {
        if (Auth::check()) {
            $cart_count = CartModel::where('user_id', Auth::id())->get();
            $countArr = [];
            foreach ($cart_count as $count) {
                array_push($countArr, $count->quantity);
            }
            $total_count = array_sum($countArr);
            return response()->json(['count' => $total_count]);
        }
    }

    public function featureProd()
    {
        return view('products/feature_prod');
    }

    public function listProduct()
    {
        return view('products/add');
        // $cat = CategoryModel::all();
        // return view('products/add', ['categories' => $cat]);
    }

    public function AddProduct(Request $request)
    {
        
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);

        $product = new ProductModel;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $product['image'] = $filename;
        }

        $product->cat_id = $request->category;
        $product->pname = $request->name;
        $product->price = $request->price;
        $product->save();

        Session::flash('success', 'Product added successfully !');
        return redirect('/products/add-products');
    }

}
