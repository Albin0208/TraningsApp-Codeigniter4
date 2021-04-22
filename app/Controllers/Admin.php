<?php 
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\CategoriesModel;
use App\Models\ProductOnsaleModel;
use App\Models\SaleModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Admin extends Controller
{
  public function __construct() {
    helper('form');
  }
  
  public function index()
  {
    $db = db_connect();
    $admin = new AdminModel($db);
    $model = new ShopModel();
    $saleModel = new SaleModel();

    $data = [
      'title'           => 'Elit-Träning | Admin',
      'time'            => new Time(),
      'customerCount'   => $admin->countFromTable('customers'),
      'orderCount'      => $admin->countFromTable('orders'),
      'productCount'    => $admin->countFromTable('products'),
      'totalRevenue'    => $admin->getTotalRevenue(),
      'latestOrders'    => $admin->getLatest('orders'),
      'latestCustomers' => $admin->getLatest('customers'),
      'products'        => $model->getProductsInfo(),
      'sales'           => $saleModel->paginate(6, 'group2'),
      'pager'           => $model->pager,
    ];
    //TODO Fixa så admin kan lägga till och ta bort rabattkoder
    //TODO Fixa så att admin kan lägga till och ta bort kategorier
    //TODO Fixa så att produkter kan markeras som nyhet eller kampanj
    //TODO Fixa så att det visas hur många produkter som en kampanj rabatterar
    //TODO Fixa så att man kan se vilka produkter som är rabatterade
    return view('/admin/adminpanel', $data);
  }
  
  #region Hantera produkter

  /**
   * Skapa en ny produkt
   *
   * @return View
   */
  public function createProduct()
  {
    $categories = new CategoriesModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Skapa produkt',
      'categories' => $categories->findAll()
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'createProduct')) {
        $file = $this->request->getFile('productImage');

        if ($file->isValid() && !$file->hasMoved()) {
          $file->move('./uploads/images');
        }
        
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'image' => '/uploads/images/' . $file->getName(),
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];

        $model = new ShopModel();

        return $model->insert($productData) == false 
                                            ? redirect()->to('/admin')->with('error', 'Något gick fel när produkten skulle skapas') 
                                            : redirect()->to('/admin')->with('success', 'Produkten är skapad');
        
      } else
        $data['validation'] = $validation;
    }
      

    return view('admin/products/createProduct', $data);
  }
  
  /**
   * Redigera en befintlig produkt
   *
   * @param  string $slug Sluggen till produkten som ska redigeras
   * @return View
   */
  public function editProduct(string $slug)
  {
    $model = new ShopModel();
    $categories = new CategoriesModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Redigera produkt',
      'product' => $model->getProduct($slug),
      'categories' => $categories->findAll()
    ];


    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'editProduct')) {
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];

        $file = $this->request->getFile('productImage');

        if ($file->isValid() && !$file->hasMoved()) {
          unlink('.' . $data['product']['image']);
          $file->move('./uploads/images');
          $productData['image'] = '/uploads/images/' . $file->getName();
        }
        
        $model = new ShopModel();

        return $model->update($this->request->getPost('id'), $productData) == false 
                                            ? redirect()->to('/admin')->with('error', 'Något gick fel när produkten skulle uppdateras') 
                                            : redirect()->to('/admin')->with('success', 'Produkten är uppdaterad');
        
      } else
        $data['validation'] = $validation;
    }
      
    return view('admin/products/editProduct', $data);
  }
  
  /**
   * Ta bort en produkt
   *
   * @param  string $slug
   * @return Redirect Tillbaka till admin sidan
   */
  public function deleteProduct(string $slug)
  {
    if (empty($slug) || !preg_match('/^[a-z-]+$/', $slug))
      return redirect()->to('/admin')->with('error', 'Något gick fel');
    
    $model = new ShopModel();

    $productImage = $model->where('slug', $slug)->first();

    if (file_exists('./' . $productImage['image']))
      unlink('./' . $productImage['image']);

    $model->where('slug', $slug)->delete();

    return redirect()->to('/admin')->with('success', 'Produkten är borttagen');
  }
  
  /**
   * Generera en slug från en sträng
   *
   * @param  string $text Strängen som ska bli en slug
   * @return string Slugen
   */
  private function generateSlug(string $text)
  {
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
  }
  
  #endregion

  #region Hantera kampanjer
  
  /**
   * Skapa en ny kampanj
   *
   * @return View
   */
  public function createSale()
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
        $productOnSaleModel = new ProductOnsaleModel();

        $saleData =[
          'sale_name'  => $this->request->getPost('saleName'),
          'sale_value' => $this->request->getPost('productDiscount'),
          'value_type' => $this->request->getPost('discountType')
        ];

        $id = $saleModel->insert($saleData);
        
        foreach ($this->request->getPost('products') as $productId) {
          $saleData = [
            'sale_id'    => $id,
            'product_id' => $productId[0]
          ];
  
          $productOnSaleModel->insert($saleData);

        }
        return redirect()->to('/admin')->with('success', 'Kampanj skapad');
      }
    }

    return view('/admin/sale/createSale', $data);
  }
  
  /**
   * Redigera en befintlig kampanj
   *
   * @param  string $saleKey Nyckel för en specifik kampanj
   * @return View
   */
  public function editSale(string $saleKey)
  {
    # code...
  }
  
  /**
   * Avsluta en kampanj
   *
   * @param  string $saleKey Nyckeln till en specifik kampanj
   * @return View
   */
  public function endSale(string $saleKey)
  {
    if (empty($saleKey) || !preg_match('/^[A-Za-zÀ-ÿ ]+$/', $saleKey))
      return redirect()->to('/admin')->with('error', 'Något gick fel');
  
  $model = new SaleModel();

  $model->where('sale_name', $saleKey)->delete();

  return redirect()->to('/admin')->with('success', 'Kampanjen är avslutad');
  }

  #endregion
}