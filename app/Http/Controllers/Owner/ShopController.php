<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function (Request $request, Closure $next) {
            // URLのshopId取得
            $id = $request->route()->parameter('shop');

            if (!is_null($id)) {
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId;

                // ログインしているオーナーのID取得
                $ownerId = Auth::id();

                if ($shopId !== $ownerId) {
                    // 404画面
                    abort(404);
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        // $ownerId = Auth::id();
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index', compact('shops'));
    }

    public function edit(string $id)
    {
        $shop = Shop::findOrFail($id);

        return view('owner.shops.edit', compact('shop'));
    }

    public function update(Request $request, string $id)
    {
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            // リサイズなしの場合
            // Storage::putFile('public/shops', $imageFile);

            // リサイズあり
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;

            $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();

            // dd($imageFile, $resizedImage);

            Storage::put('public/shops/' . $fileNameToStore, $resizedImage);
        }

        return redirect()->route('owner.shops.index');
    }
}
