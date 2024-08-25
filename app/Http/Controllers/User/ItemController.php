<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use App\Mail\TestMail;
use App\Jobs\SendThanksMail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function index (Request $request)
    {
        // 同期処理
        // Mail::to('test@example.com')->send(new TestMail());

        // 非同期処理
        // SendThanksMail::dispatch();

        $categories = PrimaryCategory::with('secondary')->get();
        $products = Product::availableItems()
                            ->selectCategory($request->category ?? '0')
                            ->searchKeyword($request->keyword)
                            ->sortOrder($request->sort)
                            ->paginate($request->pagination ?? 20);
    
        return view('user.index', compact('products', 'categories'));
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
