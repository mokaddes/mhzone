<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Ad\Entities\Ad;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart');
        if ($cart) {
            $ids = array_keys($cart);
            $ads = Ad::findMany($ids);
            return view('front.cart', compact('ads', 'cart'));
        }
        return redirect()->route('frontend.index')->with('warning', 'Your cart is empty');
    }

    public function add(Request $request)
    {
        $id         = $request->get('id');
        $data       = Ad::find($id);

        $quantity       = $request->get('quantity') ?? 1;
        $attr           = $request->get('attr');
        $type           = $request->get('type');
        $product_price  = $request->get('product_price');
        $price          = $quantity * $data->price;
        if ($data->discount && $data->discount > 0) {
            $discount = discount_cal($data->price, $data->discount);
            $price = $quantity * $discount;
        }
        $discounted = $discount ?? $data->price;
        $attr_price = $product_price - $discounted;
//        Session::forget('cart');
        $cart = Session::get('cart');
        if ($cart && isset($cart[$id])) {
            if ($type == 'checkout') {
                return response()->json(['status' => 'checkout', 'cart' => $cart, 'cart_count' => count($cart)]);
            }
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
            $cart[$id]['attr'] = $attr;
            $cart[$id]['attr_price'] = $attr_price ?? 0;
            $cart[$id]['price'] = $product_price;
            $cart[$id]['total_price'] = ($cart[$id]['quantity'] * $discounted) + $attr_price;
        } else {
            $new_cart = [
                'id' => $id,
                'attr' => $attr,
                'quantity' => $quantity,
                'attr_price' => $attr_price ?? 0,
                'price' => $product_price,
                'total_price' => $price + $attr_price,
            ];
            $cart[$id] = $new_cart;
        }
        Session::put('cart', $cart);
        return response()->json(['status' => true, 'cart' => $cart, 'cart_count' => count($cart)]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $data = Ad::find($id);
        $cart = Session::get('cart');
        $status = true;
        $reload = false;
        if (isset($cart[$id])) {
            $price = $cart[$id]['price'];
            if ($type == 'plus') {
                if ($cart[$id]['quantity'] < $data->qty) {
                    $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                    $cart[$id]['total_price'] = $cart[$id]['total_price'] + $price;
                }else{
                    $status = false;
                }
            } else {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] - 1;
                $cart[$id]['total_price'] = $cart[$id]['total_price'] - $price;
                if ($cart[$id]['quantity'] == 0) {
                    unset($cart[$id]);
                    $reload = true ;
                }
            }
        }
//        Session::forget('cart');
        Session::put('cart', $cart);
        $cart_total = cart_total();
        return response()->json(['status' => $status, 'reload' => $reload, 'cart' => $cart, 'cart_total' => $cart_total, 'cart_count' => count($cart)]);

    }

    public function remove(Request $request)
    {
        return view('front.cart');
    }
}
