<?php 
namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Models\CategoriesModel;
use App\Models\ProductOnsaleModel;
use App\Models\SaleModel;
use App\Models\ShopModel;
use CodeIgniter\Controller;

class Sale extends Controller
{
  public function __construct() {
    helper('form');
  }
  
  /**
   * Skapa en ny kampanj
   *
   * @return View
   */
  public function create()
  {
    $shopModel = new ShopModel();
    $categoryModel = new CategoriesModel();

    $data = [
      'title'      => 'Elit-Träning | Admin - Skapa Kampanj',
      'products'   => $shopModel->getProductsNotOnSale(),
      'categories' => $categoryModel->findAll(),
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      
      if ($validation->run($_POST, 'sale')) {
        $saleModel = new SaleModel();

        $saleData =[
          'sale_name'  => $this->request->getPost('saleName'),
          'sale_value' => $this->request->getPost('productDiscount'),
          'value_type' => $this->request->getPost('discountType'),
        ];
        
        $id = $saleModel->insert($saleData);
        
        //Vill vi skapa kampanj på en eller flera kategorier?
        if ($this->request->getPost('categories'))
          $this->saleWithCategory($id);
          
        //Vill vi skapa kampanj på en eller flera produkter?
        if ($this->request->getPost('products'))
          $this->saleWithProducts($id);
        
        return redirect()->to('/admin/panel')->with('success', 'Kampanj skapad');
      }
    }

    return view('/admin/sales/create', $data);
  }
  
  /**
   * Redigera en befintlig kampanj
   *
   * @param  string $saleKey Nyckel för en specifik kampanj
   * @return View
   */
  public function edit(string $saleKey)
  {
    $db = db_connect();
    $model = new AdminModel($db);
    $saleModel = new SaleModel();

    $sale = $saleModel->where('sale_name', $saleKey)->first();

    $products = $model->getProductsOnSale($sale['sale_id']);

    $data = [
      'title' => 'Elit-Träning | Admin - Redigera kampanj',
      'sale' => $sale,
      'products' => $products
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      $_POST['sale_id'] = $sale['sale_id'];  
      if ($validation->run($_POST, 'updateSale')) {

        $saleData =[
          'sale_name'  => $this->request->getPost('saleName'),
          'sale_value' => $this->request->getPost('productDiscount'),
          'value_type' => $this->request->getPost('discountType'),
        ];
        
        $saleModel->update($sale['sale_id'], $saleData);
          
        //Vill vi skapa kampanj på en eller flera produkter?
        if ($this->request->getPost('products'))
          $this->saleWithProducts($sale['sale_id'], true);
        
        return redirect()->to('/admin/panel')->with('success', 'Kampanj uppdaterad');
      }
    }

    return view("admin/sales/edit", $data);
  }
  
  /**
   * Avsluta en kampanj
   *
   * @param  string $saleKey Nyckeln till en specifik kampanj
   * @return Redirect Tillbaka till adminsidan med ett meddelande
   */
  public function delete(string $saleKey)
  {
    if (empty($saleKey) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $saleKey))
      return redirect()->to('/admin')->with('error', 'Något gick fel');
  
    $model = new SaleModel();

    return $model->where('sale_name', $saleKey)->delete() 
            ? redirect()->to('/admin/panel')->with('success', 'Kampanjen är avslutad') 
            : redirect()->to('/admin/panel')->with('error', 'Något gick fel');

  }
  
  /**
   * Skapa en kampanj för en specifik kategori
   *
   * @param  int $id Kampanj id
   * @return void
   */
  private function saleWithCategory(int $id)
  {
    $productModel = new ShopModel();
    $productOnSaleModel = new ProductOnsaleModel();
    
    foreach ($this->request->getPost('categories') as $category) {
      //Är det 0 ska allt ingå i kampanjen, annars hämta de produkterna som tillgör den kategorin
      $products = $category == 0 ? $productModel->findAll() : $productModel->where('type', $category)->findAll();

      //Lägg till alla produkterna som ska vara med i kampanjen
      foreach ($products as $product) {
        $saleData = [
          'sale_id'    => $id,
          'product_id' => $product['product_id']
        ];
        $productOnSaleModel->insert($saleData);
      }
    }
  }
  
  /**
   * Skapa en kampanj för specifika produkter
   *
   * @param  int $id Kampanj id
   * @param  bool $update Om DB ska uppdateras
   * @return void
   */
  private function saleWithProducts(int $id, bool $update = false)
  {
    $productOnSaleModel = new ProductOnsaleModel();
    // Om uppdatering ska produkterna som har det kampanj ID rensas
    if ($update)
      $productOnSaleModel->where('sale_id', $id)->delete();
      
    foreach ($this->request->getPost('products') as $productId) {
      $saleData = [
        'sale_id'    => $id,
        'product_id' => $productId
      ];

      $productOnSaleModel->insert($saleData);
    }
  }

}