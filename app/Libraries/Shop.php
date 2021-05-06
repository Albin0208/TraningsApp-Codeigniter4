<?php

namespace App\Libraries;

use App\Models\ProductOnsaleModel;
use App\Models\SaleModel;

class Shop
{  
  /**
   * Visa en produkt
   *
   * @param  mixed $params produkten
   * @return View Produkten
   */
  public function productItem($params)
  {
    $model = new ProductOnsaleModel();
    $saleModel = new SaleModel();

    if ($sale = $model->where('product_id', $params['product_id'])->first()) {
      $saleInfo = $saleModel->find($sale['sale_id']);
      $salePrice = 0;

      if ($saleInfo['value_type'] == 'Percent') {
        $percentLeft = 1 - ($saleInfo['sale_value'] / 100);

        $salePrice = $params['price'] * $percentLeft;
      } else 
        $salePrice = $params['price'] - $saleInfo['sale_value'];

      $params['onSale'] = true;
      $params['salePrice'] = $salePrice;
    }

    return view('components/product_item', ['product' => $params]);
  }
}