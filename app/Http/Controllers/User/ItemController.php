<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function (Request $request, Closure $next) {
            $id = $request->route()->parameter('item');

            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('products.id', $id)->exists();

                if (!$itemId) {
                    // 404画面
                    abort(404);
                }
            }

            return $next($request);
        });
    }

    public function index ()
    {
        $products = Product::availableItems()->get();
    
        return view('user.index', compact('products'));
    }

    public function show (string $id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($quantity > 9) {
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}
