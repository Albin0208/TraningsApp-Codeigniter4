<?php

namespace App\Libraries;

use App\Models\ShopModel;

class OrderItems
{  
  /**
   * Visa en specifik produkt
   *
   * @param  mixed $item Produkten som ska visas
   * @return View Produktvyn
   */
  public function item($item)
  {
    $productDetails = $this->getProductDetails($item);

    return view('components/order_item', ['product' => $productDetails]);
  }
    
  /**
   * Visa orderdetaljerna
   *
   * @param  mixed $item
   * @return View Detaljvyn
   */
  public function orderDetails($item)
  {
    $productDetails = $this->getProductDetails($item);

    return view('components/order_detail', ['product' => $productDetails]);
  }
  
  /**
   * Hämta informationen om en produkt
   *
   * @param  mixed $item Produkten
   * @return array Produkt detaljerna
   */
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