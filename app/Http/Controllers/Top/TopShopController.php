<?php

namespace App\Http\Controllers\Top;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;

class TopShopController extends Controller
{
    public function __construct()
    {

        $this->middleware(function (Request $request, Closure $next) {
            // URLのshopId取得
            $id = $request->route()->parameter('shop');

            if (!is_null($id)) {
                $shopId = Shop::where('id', $id)->where('is_selling', Common::DEFAULT_ITEM_NUM);

                if (!$shopId) {
                    // 404画面
                    abort(404);
                }
            }

            return $next($request);
        });
    }

    public function index ()
    {
        $shops = Shop::select('id', 'name', 'information', 'filename')
                        ->where('is_selling', Common::SELLING_FLG['enabled'])
                        ->paginate(Common::DEFAULT_ITEM_NUM);
    
        return view('top.shops.index', compact('shops'));
    }

    public function show (string $id)
    {
        $shop = Shop::findOrFail($id);

        return view('top.shops.show', compact('shop'));
    }
}
