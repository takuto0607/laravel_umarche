<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Closure;
use Illuminate\Http\Request;

class TopItemController extends Controller
{
    public function __construct()
    {
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

    public function index (Request $request)
    {
        $categories = PrimaryCategory::with('secondary')->get();
        $products = Product::availableItems()
                            ->selectCategory($request->category ?? '0')
                            ->searchKeyword($request->keyword)
                            ->sortOrder($request->sort)
                            ->paginate($request->pagination ?? 20);
        $keyword = $request->keyword;
    
        return view('top.items.index', compact('products', 'categories', 'keyword'));
    }

    public function show (string $id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($quantity > 9) {
            $quantity = 9;
        }

        return view('top.items.show', compact('product', 'quantity'));
    }
}
