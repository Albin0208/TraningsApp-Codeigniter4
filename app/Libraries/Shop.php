<?php

namespace App\Libraries;

use App\Models\ShopModel;

class Shop
{
  public function productItem($params)
  {
    $model = new ShopModel();

    // $product = $model->where('id', $params['id'])->first();

    return view('components/product_item', ['product' => $params]);
  }
}
