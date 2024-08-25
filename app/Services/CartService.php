<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;

class CartService
{
  public static function getItemsInCart ($items)
  {
    $products = [];

    foreach ($items as $item) {
      $product = Product::findOrFail($item->product_id);
      // オーナー情報
      // $owner = $product->shop->owner->select('name', 'email')->first()->toArray();
      $owner = $product->shop->owner;
      // オーナー情報のキーを変更（name → ownerName）
      // $values = array_values($owner);
      // $keys = ['ownerName', 'email'];
      // $ownerInfo = array_combine($keys, $values);
      $ownerInfo = [
        'ownerName' => $owner->name,
        'email' => $owner->email
      ];

      // 商品情報
      $productInfo = Product::where('id', $item->product_id)->select('id', 'name', 'price')->get()->toArray();

      // 数量
      $quantity = Cart::where('product_id', $item->product_id)->select('quantity')->get()->toArray();

      $result = array_merge($productInfo[0], $ownerInfo, $quantity[0]);
      array_push($products, $result);
    }

    return $products;
  }
}