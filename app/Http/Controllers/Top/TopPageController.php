<?php

namespace App\Http\Controllers\Top;

use App\Constants\Common;
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
        $categories = PrimaryCategory::select('id', 'name')
                        ->with('secondary:id,name,primary_category_id')
                        ->get();

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
        $shops = Shop::select('id', 'name', 'filename')
                    ->where('is_selling', Common::SELLING_FLG['enabled'])
                    ->limit(4)
                    ->get();

        return view('top.index', compact('categories', 'products', 'recomends', 'shops'));
    }
}
