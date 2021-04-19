<?php 
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ShopModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Admin extends Controller
{
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
      'products'        => $model->paginate(6, 'group'),
      'pager'           => $model->pager,
    ];

    return view('/admin/adminpanel', $data);
  }

  public function createProduct()
  {
    
  }

  public function editProduct(string $slug)
  {
    
  }
}