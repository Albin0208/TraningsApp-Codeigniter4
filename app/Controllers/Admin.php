<?php 
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\CategoriesModel;
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
      // 'products'        => $model->paginate(6, 'group'),
      'pager'           => $model->pager,
    ];

    return view('/admin/adminpanel', $data);
  }

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
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'image' => 'test',
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];
        $model = new ShopModel();

        if ($model->insert($productData) == false)
          echo 'Failed';
        else
        return redirect()->to('/admin')->with('success', 'Produkten är skapad');
        
      } else
        $data['validation'] = $validation;
    }
      

    return view('admin/createProduct', $data);
  }

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
          'image' => 'test',
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];
        $model = new ShopModel();

        if ($model->update($this->request->getPost('id'), $productData) == false)
          echo 'Failed';
        else
        return redirect()->to('/admin')->with('success', 'Produkten är uppdaterad');
        
      } else
        $data['validation'] = $validation;
    }
      

    return view('admin/editProduct', $data);
  }

  public function deleteProduct(string $slug)
  {
    $model = new ShopModel();

    $model->where('slug', $slug)->delete();

    return redirect()->back()->with('success', 'Produkten är borttagen');
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
}