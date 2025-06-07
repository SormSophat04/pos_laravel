<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController
{
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    // public function add(Request $request)
    // {
    //     $id = $request->id;
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] += 1;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $request->name,
    //             'price' => $request->price,
    //             'quantity' => 1
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return response()->json(['status' => 'success', 'cart' => $cart]);
    // }


    public function add(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found.']);
        }

        if ($product->qty <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Product is out of stock.']);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $product->qty) {
                return response()->json(['status' => 'error', 'message' => 'Not enough stock available.']);
            }
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success', 'cart' => $cart]);
    }


    public function increase(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    public function decrease(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] -= 1;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['status' => 'success']);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $cart = session()->get('cart', []);

        $filteredCart = array_filter($cart, function ($item) use ($searchTerm) {
            return stripos($item['name'], $searchTerm) !== false;
        });

        return response()->json(['cart' => array_values($filteredCart)]);
    }

    public function removeCart(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart', []);

        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        session()->put('cart', $cart);
        return response()->json(['cart' => array_values($cart)]);
    }

}
