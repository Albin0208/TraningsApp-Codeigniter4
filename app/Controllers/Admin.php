<?php 
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\CategoriesModel;
use App\Models\CouponModel;
use App\Models\NewsletterModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductOnsaleModel;
use App\Models\SaleModel;
use App\Models\UserModel;
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
    $couponsModel = new CouponModel();
    $newsletterModel = new NewsletterModel();

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
      'sales'           => $saleModel->paginate(6, 'sales'),
      'coupons'         => $couponsModel->paginate(6, 'coupons'),
      'newsletter'      => $newsletterModel->paginate(6, 'newsletter'),
      'pager'           => $model->pager,
    ];
    //TODO Fixa så att admin kan lägga till och ta bort kategorier
    //TODO Fixa så att produkter kan markeras som nyhet eller kampanj
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

        if ($file->isValid() && !$file->hasMoved())
          $file->move('./uploads/images');
        
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'image' => '/uploads/images/' . $file->getName(),
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];

        $model = new ShopModel();

        return $model->insert($productData)
                ? redirect()->to('/admin')->with('success', 'Produkten är skapad')
                : redirect()->to('/admin')->with('error', 'Något gick fel när produkten skulle skapas');
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

        return $model->update($this->request->getPost('id'), $productData)
                ? redirect()->to('/admin')->with('success', 'Produkten är uppdaterad')
                : redirect()->to('/admin')->with('error', 'Något gick fel när produkten skulle uppdateras');
        
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
   * @return Redirect Tillbaka till adminsidan med ett meddelande
   */
  public function endSale(string $saleKey)
  {
    if (empty($saleKey) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $saleKey))
      return redirect()->to('/admin')->with('error', 'Något gick fel');
  
    $model = new SaleModel();

    return $model->where('sale_name', $saleKey)->delete() 
            ? redirect()->to('/admin')->with('success', 'Kampanjen är avslutad') 
            : redirect()->to('/admin')->with('error', 'Något gick fel');

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
   * @return void
   */
  private function saleWithProducts(int $id)
  {
    $productOnSaleModel = new ProductOnsaleModel();
    foreach ($this->request->getPost('products') as $productId) {
      $saleData = [
        'sale_id'    => $id,
        'product_id' => $productId
      ];

      $productOnSaleModel->insert($saleData);
    }
  }

  #endregion

  #region Hanter rabattkoder
  
  /**
   * Skapa en rabattkod
   *
   * @return Redirect Till admin med meddelande
   */
  public function createDiscount()
  {
    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      $validation->setRules([
        'discountName' => 'required|is_unique[coupons.name]',
        'productDiscount' => 'required|is_numeric'
      ]);
      
      if ($validation->run($_POST)) {
        $model = new CouponModel();

        $newCode = [
          'type' => $this->request->getPost('discountType'),
          'name' => $this->request->getPost('discountName'),
          'value' => $this->request->getPost('productDiscount')
        ];

        $model->insert($newCode);

        return redirect()->to('/admin')->with('success', 'Rabattkod skapad');
      }
      return redirect()->to('/admin')->with('error', 'Rabattkoden finns redan eller så är den ogiltig');
      }
  }
  
  /**
   * Ta bort en rabattkod
   *
   * @param  string $name Namnet på rabattkoden
   * @return Redirect Till admin med meddelande
   */
  public function removeDiscount(string $name)
  {
    if (empty($name) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $name))
      return redirect()->to('/admin')->with('error', 'Något gick fel');

    $model = new CouponModel();

    return $model->where('name', $name)->delete()
            ? redirect()->to('/admin')->with('success', 'Rabattkoden är borttagen')
            : redirect()->to('/admin')->with('error', 'Något gick fel');
  }

  #endregion

  #region Visa Ordrar och användare
  
  /**
   * Visa en order
   *
   * @param  int $orderNumber Ordernumret
   * @return View Ordervyn
   */
  function order(string $orderNumber)
  {
    $orderModel = new OrderModel();
    $itemModel = new OrderItemModel();
    
    $data = [
      'title' => 'Elit-Träning | Admin - Order',
      'pageTitle' => 'Order ' . $orderNumber,
      'orderDetails' => $order = $orderModel->where('order_number', $orderNumber)->first(),
      'orderItems' => $itemModel->where('order_id', $order['order_id'])->findAll(),
      'time' => new Time(),
    ];

    return view('admin/order', $data);
  }

  public function allOrders()
  {
    $orderModel = new OrderModel();
    
    $data = [
      'title' => 'Elit-Träning | Admin - Ordrar',
      'orders' => $orderModel->orderBy('order_number', 'DESC')->paginate('10', 'orders'),
      'pager' => $orderModel->pager,
      'time' => new Time(),
    ];

    return view('admin/allOrders', $data);
  }
  
  /**
   * Visa en kund
   *
   * @param  string $username Användarnamnet
   * @return View Kundvyn
   */
  public function customer(string $username)
  {
    $model = new UserModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Användare',
      'customer' => $model->where('username', $username)->first(),
    ];

    return view('admin/customer', $data);
  }

  #endregion
  
  /**
   * Skicka nyhetsbrev
   *
   * @return Redirect Tillbaka admin sidan med meddelande
   */
  public function newsletter()
  {
    if ($this->request->getMethod() == 'post') {
      $model = new NewsletterModel();
      $subscribers = $model->findAll();

      if (count($subscribers) == 0)
        return redirect()->to('/admin')->with('error', 'Inget nyhetsbrev skickat. Det finns ingen som är registrerad på nyhetsbrevet');

      foreach ($subscribers as $subscriber) {
        $newsData = [
          'subject' => $this->request->getPost('subject'),
          'content' => $this->request->getPost('content'),
          'delete_key' => $subscriber['delete_key'],
        ];

        $email = \Config\Services::email();
        $message = view('emails/newsletterEmail', $newsData);
        $email->setTo($subscriber['email']);
        $email->setSubject('Elit-Träning | Nyhetsbrev');
        $email->setMessage($message);

        if (!$email->send())
          return redirect()->to('/admin')->with('error', 'Något gick fel när ett nyhetsbrev skulle skickas');
      }
      return redirect()->to('/admin')->with('success', 'Nyhetsbrevet är skickat');
    }
  }

}