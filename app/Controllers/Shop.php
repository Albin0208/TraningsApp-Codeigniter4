<?php

namespace App\Controllers;

use App\Models\ShopModel;
use CodeIgniter\Controller;

class Shop extends Controller
{
  public function __construct()
  {
    helper('form');
  }
  public function index()
  {
    $model = new ShopModel();

    $data = [
      'title' => 'Elit-Träning | Butik',
      'products' => $model->paginate(3, 'group'),
      'pager' => $model->pager,
      'cart' => session()->get('cart_contents')
    ];

    return view('shop/shop', $data);
  }

  public function product($slug = null)
  {
    if (!$slug) {
      //return 404 sida
      echo '404 Page not found';
    }

    $model = new ShopModel();

    $data['product'] =  $model->getProduct($slug);

    return view('shop/single_product', $data);
  }

  public function addToCart()
  {
    $id = $this->request->getPost('product_id');
    $qty = $this->request->getPost('quantity');

    $cart = \Config\Services::cart();
    $model = new ShopModel();

    $product = $model->where('product_id', $id)->first();
    $product['qty'] = $qty;

    $cart->insert($product);

    return redirect()->to(previous_url());
  }
}
