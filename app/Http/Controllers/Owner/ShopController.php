<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $owner = Owner::findOrFail($id);

        // return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, string $id)
    {
        // $owner = Owner::findOrFail($id);
        // $owner->name = $request->name;
        // $owner->email = $request->email;
        // $owner->password = Hash::make($request->password);
        // $owner->save();

        // return redirect()->route('admin.owners.index')->with(['message' => 'オーナー情報を更新しました。', 'status' => 'info']);
    }
}
