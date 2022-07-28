<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart\CartModel;
use App\Models\products\ProductModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function increamentItem(Request $request)
    {
        $itemQty = $request->qty;
        $amounts = ProductModel::where(['id' => $request->proID])->get();
        $cartArr = [];
        foreach ($amounts as $val) {
            $cartArr['value'] = $val->price;
            $cartArr['sum'] = $itemQty * $cartArr['value'];
        }
        $cart = array(
            'total_amount' => $cartArr['sum'],
            'quantity' => $request->qty,
        );
        DB::table('addtocart')->where('product_id', $request->proID)->where('user_id', Auth::id())->update($cart);
        $cartData = CartModel::where('user_id', Auth::id())->where('status', '1')->get();
        $total_amount = [];
        $cartCount = [];
        foreach ($cartData as $val) {
            array_push($total_amount, $val->total_amount);
            array_push($cartCount, $val->quantity);
        }
        $cartArr['total_amount'] = array_sum($total_amount);
        $cartArr['cart_count'] = array_sum($cartCount);
        return response()->json(['data' =>  $cartArr]);
    }

    public function DecreamentItem(Request $request)
    {
        $itemQty = $request->qty;
        $amounts = ProductModel::where(['id' => $request->proID])->get();
        $cartArr = [];
        foreach ($amounts as $val) {
            $cartArr['value'] = $val->price;
            $cartArr['sum'] = $itemQty * $cartArr['value'];
        }
        $cart = array(
            'total_amount' => $cartArr['sum'],
            'quantity' => $request->qty,
        );
        DB::table('addtocart')->where('product_id', $request->proID)->where('user_id', Auth::id())->update($cart);
        $cartData = CartModel::where('user_id', Auth::id())->where('status', '1')->get();
        $total_amount = [];
        $cartCount = [];
        foreach ($cartData as $val) {
            array_push($total_amount, $val->total_amount);
            array_push($cartCount, $val->quantity);
        }
        $cartArr['total_amount'] = array_sum($total_amount);
        $cartArr['cart_count'] = array_sum($cartCount);

        return response()->json(['data' =>  $cartArr]);
    }

    public function ProductQuantityIncreament(Request $request)
    {

        $ProQty = $request->post('qty');
        $ProId = $request->post('proID');
        $cart = CartModel::where('user_id', Auth::id())->where('product_id', $ProId)->first();
        if ($cart) {
            $data = array(
                'quantity' => $ProQty,
                'total_amount' => $ProQty * $cart->price,
            );
            DB::table('addtocart')->where('product_id', $ProId)->update($data);
            $cartData = CartModel::where('user_id', Auth::id())->where('status', '1')->get();
            $cartArr = [];
            $cartCount = [];
            foreach ($cartData as $val) {
                array_push($cartCount, $val->quantity);
            }
            $cartArr['cart_count'] = array_sum($cartCount);
            return response()->json(['data' => $cartArr]);
        }
    }

    public function ProductQuantityDecreament(Request $request)
    {
        $ProQty = $request->post('qty');
        $ProId = $request->post('proID');

        $cart = CartModel::where('user_id', Auth::id())->where('product_id', $ProId)->first();
        if ($cart) {

            $data = array(
                'quantity' => $ProQty,
                'total_amount' => $ProQty * $cart->price,
            );
            DB::table('addtocart')->where('product_id', $ProId)->update($data);
            $cartData = CartModel::where('user_id', Auth::id())->where('status', '1')->get();
            $cartArr = [];
            $cartCount = [];
            foreach ($cartData as $val) {
                array_push($cartCount, $val->quantity);
            }
            $cartArr['cart_count'] = array_sum($cartCount);
            return response()->json(['data' => $cartArr]);
        }
    }

    public function itemQuantity()
    {
        $cartData = CartModel::where('user_id', Auth::id())->where('status', '1')->get();
        return response()->json(['data' => $cartData]);
    }
}
