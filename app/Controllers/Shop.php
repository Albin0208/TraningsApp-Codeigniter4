<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\ShopModel;
use CodeIgniter\Controller;

class Shop extends Controller
{
  public function __construct()
  {
    helper('form');
  }
    
  /**
   * Visa butiken
   *
   * @return View Butiksvyn
   */
  public function index($category = null)
  {
    $model = new ShopModel();

    $data = [
      'title' => 'Elit-Träning | Butik',
      'products' => $model->paginate(6, 'group'),
      'pager' => $model->pager,
      'cart' => session()->get('cart_contents')
    ];
    
    if ($category != null) {

      $categoryModel = new CategoriesModel();
      
      $result = $categoryModel->like('category_name', $category)->first();
      
      $data['products'] = $model->where('type', $result['category_id'])
                                ->paginate(6, 'group');
      $data['pager'] = $model->pager;
    }


    return view('layouts/shop/shop', $data);
  }
  
  /**
   * Visa en produkt
   *
   * @param  string slugen för produkten
   * @return View Produktvyn
   */
  public function product($slug = null)
  {
    if (!$slug) {
      //TODO return 404 sida
      echo '404 Page not found';
    }

    $model = new ShopModel();

    $data['product'] =  $model->getProduct($slug);
    $data['title'] =  'Elit-Träning | ' .$data['product']['name'];

    return view('layouts/shop/single_product', $data);
  }
  
  /**
   * Lägg till en vara i varukorgen
   *
   * @return Redirect Tillbaka till föregående sida
   */
  public function addToCart()
  {
    $id = $this->request->getPost('product_id');
    $qty = $this->request->getPost('quantity');

    $cart = \Config\Services::cart();
    $model = new ShopModel();

    $product = $model->where('product_id', $id)->first();
    //Om antalet inte finns så ska en vara läggas till
    $product['qty'] = $qty ?? 1;

    $cart->insert($product);

    return redirect()->back()->with('cartSuccess', 'Varan är tillagd i varukorgen');
  }
}