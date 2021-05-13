<?php
namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\ProductOnsaleModel;
use App\Models\SaleModel;
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

    return view('shop/shop', $data);
  }
  
  /**
   * Visa en produkt
   *
   * @param  string slugen för produkten
   * @return View Produktvyn
   */
  public function product($slug = null)
  {
    if (!$slug)
      return redirect()->to('error');

    $shopModel = new ShopModel();
    
    $data['product'] =  $shopModel->getProduct($slug);
    $data['title'] =  'Elit-Träning | ' .$data['product']['name'];

    $model = new ProductOnsaleModel();
    $saleModel = new SaleModel();

    if ($sale = $model->where('product_id', $data['product']['product_id'])->first()) {
      $saleInfo = $saleModel->find($sale['sale_id']);
      $salePrice = 0;

      if ($saleInfo['value_type'] == 'Percent') {
        $percentLeft = 1 - ($saleInfo['sale_value'] / 100);

        $salePrice = $data['product']['price'] * $percentLeft;
      } else 
        $salePrice = $data['product']['price'] - $saleInfo['sale_value'];

      $data['product']['onSale'] = true;
      $data['product']['salePrice'] = $salePrice;
    }
    
    return view('shop/single_product', $data);
  }
  
  /**
   * Lägg till en vara i varukorgen
   *
   * @return Redirect Tillbaka till föregående sida
   */
  public function addToCart()
  {
    $id = $this->request->getPost('product_id');

    $cart = \Config\Services::cart();
    $model = new ShopModel();
    $productOnSaleModel = new ProductOnsaleModel();

    $product = $model->where('product_id', $id)->first();
    //Om antalet inte finns så ska en vara läggas till
    $product['qty'] = $this->request->getPost('quantity') ?? 1;

    if ($sale = $productOnSaleModel->where('product_id', $product['product_id'])->first()) {
      $saleModel = new SaleModel();
      $saleInfo = $saleModel->find($sale['sale_id']);

      if ($saleInfo['value_type'] == 'Percent') {
        $percentLeft = 1 - ($saleInfo['sale_value'] / 100);
        $product['price'] *= $percentLeft;
      } else 
      $product['price'] -= $saleInfo['sale_value'];
    }

    $cart->insert($product);

    return redirect()->back()->with('cartSuccess', 'Varan är tillagd i varukorgen');
  }
}