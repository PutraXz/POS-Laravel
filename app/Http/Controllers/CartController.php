<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    private function getCart(Request $request)
    {
        return $request->session()->get('cart', []);
    }

    private function putCart(Request $request, array $cart)
    {
        $request->session()->put('cart', $cart);
    }

    private function totals(array $cart)
    {
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $diskon   = 5000;
        $pajak    = (int) round($subtotal * 0.1);
        $total    = max(0, $subtotal - $diskon) + $pajak;
        return compact('subtotal','diskon','pajak','total');
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);
        $product = Product::findOrFail($request->product_id);

        $cart = $this->getCart($request);
        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'id'    => $product->id,
                'name'  => $product->name_product,
                'price' => (int)$product->price,
                'image' => $product->image,
                'qty'   => 0,
            ];
        }
        $cart[$product->id]['qty'] += 1;

        $this->putCart($request, $cart);

        $html = view('layouts.sidebar-right', [
            'cart' => $cart,
            'tot'  => $this->totals($cart),
        ])->render();

        return response()->json(['ok' => true, 'html' => $html]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'qty'        => 'required|integer',
        ]);

        $cart = $this->getCart($request);
        if (isset($cart[$data['product_id']])) {
            $cart[$data['product_id']]['qty'] = max(1, $data['qty']);
            $this->putCart($request, $cart);
        }

        $html = view('partials.cart_sidebar', [
            'cart' => $cart,
            'tot'  => $this->totals($cart),
        ])->render();

        return response()->json(['ok' => true, 'html' => $html]);
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);
        $cart = $this->getCart($request);
        unset($cart[$request->product_id]);
        $this->putCart($request, $cart);

        $html = view('partials.cart_sidebar', [
            'cart' => $cart,
            'tot'  => $this->totals($cart),
        ])->render();

        return response()->json(['ok' => true, 'html' => $html]);
    }
    public function fragment(Request $request)
    {
        $cart = $this->getCart($request);
        $html = view('partials.cart_sidebar', [
            'cart' => $cart,
            'tot'  => $this->totals($cart),
        ])->render();

        return response()->json(['ok' => true, 'html' => $html]);
    }
}
