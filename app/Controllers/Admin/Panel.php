<?php 
namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\CouponModel;
use App\Models\NewsletterModel;
use App\Models\SaleModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Panel extends Controller
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
    return view('/admin/panel', $data);
  }

}