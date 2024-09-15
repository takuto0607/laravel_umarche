<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    const ORDER_RECOMMEND = '0';

    public function __construct()
    {
        
    }

    public function index ()
    {
        // カテゴリー取得
        $categories = PrimaryCategory::with('secondary')->get();

        // 商品一覧取得（4件）
        $products = Product::availableItems()
                            ->limit(4)
                            ->get();

        // おすすめ商品一覧取得（4件）
        $recomends = Product::availableItems()
                            ->sortOrder(self::ORDER_RECOMMEND)
                            ->limit(4)
                            ->get();

        // 店舗一覧取得
        $shops = Shop::limit(4)->get();

        return view('top.index', compact('categories', 'products', 'recomends', 'shops'));
    }

    public function itemsIndex (Request $request)
    {
        $categories = PrimaryCategory::with('secondary')->get();
        $products = Product::availableItems()
                            ->selectCategory($request->category ?? '0')
                            ->searchKeyword($request->keyword)
                            ->sortOrder($request->sort)
                            ->paginate($request->pagination ?? 20);
    
        return view('top.items.index', compact('products', 'categories'));
    }
}
