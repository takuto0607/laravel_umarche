<?php

namespace App\Http\Controllers\Owner;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Image;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use App\Http\Requests\ProductRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function (Request $request, Closure $next) {
            $id = $request->route()->parameter('product');

            if (!is_null($id)) {
                $productsOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productId = (int)$productsOwnerId;

                if ($productId !== Auth::id()) {
                    // 404画面
                    abort(404);
                }
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerInfo = Owner::with('shop.product.imageFirst')->where('id', Auth::id())->get();

        return view('owner.products.index', compact('ownerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::where('owner_id', Auth::id())->select('id', 'name')->get();
        $images = Image::where('owner_id', Auth::id())->select('id', 'title', 'filename')->orderBy('updated_at', 'desc')->get();
        $categories = PrimaryCategory::with('secondary')->get();

        return view('owner.products.create', compact('shops', 'images', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use($request) {
                $product = Product::create([
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'sort_order' => $request->sort_order,
                    'shop_id' => $request->shop_id,
                    'secondary_category_id' => $request->category,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                    'is_selling' => $request->is_selling,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);

            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()->route('owner.products.index')->with(['message' => '商品登録をしました。', 'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        $shops = Shop::where('owner_id', Auth::id())->select('id', 'name')->get();
        $images = Image::where('owner_id', Auth::id())->select('id', 'title', 'filename')->orderBy('updated_at', 'desc')->get();
        $categories = PrimaryCategory::with('secondary')->get();

        return view('owner.products.edit', compact('product', 'quantity', 'shops', 'images', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $request->validate([
            'current_quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($request->current_quantity !== strval($quantity)) {
            $id = $request->route()->parameter('product');
            
            return redirect()->route('owner.products.edit', ['product' => $id])->with(['message' => '在庫数が変更されています。再度確認してください。', 'status' => 'alert']);
        } else {
            try {
                DB::transaction(function () use($request, $product) {
                    $product->name = $request->name;
                    $product->information = $request->information;
                    $product->price = $request->price;
                    $product->sort_order = $request->sort_order;
                    $product->shop_id = $request->shop_id;
                    $product->secondary_category_id = $request->category;
                    $product->image1 = $request->image1;
                    $product->image2 = $request->image2;
                    $product->image3 = $request->image3;
                    $product->image4 = $request->image4;
                    $product->is_selling = $request->is_selling;
                    $product->save();

                    if ($request->type === Common::PRODUCT_LIST['add']) {
                        $newQuantity = $request->quantity;
                    }

                    if ($request->type === Common::PRODUCT_LIST['reduce']) {
                        $newQuantity = $request->quantity * -1;
                    }
    
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => $request->quantity,
                        'quantity' => $newQuantity,
                    ]);
    
                }, 2);
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }
    
            return redirect()->route('owner.products.index')->with(['message' => '商品情報を更新しました。', 'status' => 'info']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('owner.products.index')->with(['message' => '商品を削除しました。', 'status' => 'alert']);
    }
}
