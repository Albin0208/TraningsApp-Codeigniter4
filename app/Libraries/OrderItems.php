<?php

namespace App\Libraries;

use App\Models\ShopModel;

class OrderItems
{
  public function item($item)
  {
    $shopModel = new ShopModel();

    $product = $shopModel->find($item['product_id']);

    $productDetails = [
      'qty' => $item['quantity'],
      'price' => $item['item_price'] * $item['quantity'],
      'name' => $product['name']
    ];

    return view('components/order_item', ['product' => $productDetails]);
  }
}