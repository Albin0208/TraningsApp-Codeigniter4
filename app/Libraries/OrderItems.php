<?php

namespace App\Libraries;

use App\Models\ShopModel;

class OrderItems
{
  public function item($item)
  {
    $productDetails = $this->getProductDetails($item);

    return view('components/order_item', ['product' => $productDetails]);
  }
  
  public function orderDetails($item)
  {
    $productDetails = $this->getProductDetails($item);

    return view('components/order_detail', ['product' => $productDetails]);
  }

  private function getProductDetails($item)
  {
    $shopModel = new ShopModel();

    $product = $shopModel->find($item['product_id']);

    return [
      'qty' => $item['quantity'],
      'price' => $item['item_price'] * $item['quantity'],
      'name' => $product['name'],
      'slug' => $product['slug']
    ];
  }
}