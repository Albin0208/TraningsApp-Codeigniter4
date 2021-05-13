<?php 
namespace App\Controllers\Admin;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Orders extends Controller
{
  public function __construct() {
    helper('form');
  }
  
  /**
   * Visa en order
   *
   * @param  int $orderNumber Ordernumret
   * @return View Ordervyn
   */
  public function view(string $orderNumber)
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

    return view('admin/orders/single_order', $data);
  }
  
  /**
   * Visa alla ordrar
   *
   * @return View Ordervyn
   */
  public function viewAll()
  {
    $orderModel = new OrderModel();
    
    $data = [
      'title' => 'Elit-Träning | Admin - Ordrar',
      'orders' => $orderModel->getAllOrdersByDate(),
      'pager' => $orderModel->pager,
      'time' => new Time(),
    ];

    return view('admin/orders/all_orders', $data);
  }
}