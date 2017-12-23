<?php

namespace App\Http\Controllers\Home;

use App\Cart;
use App\CartItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addItem($productId)
    {
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        if(!$cart)
        {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }

        $cartItem = new CartItem();
        $cartItem->product_id = $productId;
        $cartItem->cart_id = $cart->id;
        $cartItem->save();

        return redirect('/cart');
    }

    /**
     * @return $this
     */
    public  function  showCart()
    {
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        if(!$cart)
        {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
        $items = $cart->cartitem;
        $total = 0;
        foreach ($items as $item)
        {
            $total += $item->product->price;
        }
        return view('cart')->with([
            'items' => $items,
            'total' => $total
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeItem($id)
    {
        CartItem::destroy($id);
        return redirect('/cart');
    }
}
