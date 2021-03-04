<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Controller;

class Cart extends Controller
{
  public function __construct()
  {
    helper('form');
  }

  public function index()
  {
    $cart = \Config\Services::cart();

    $data = [
      'title' => 'Elit-Träning | Varukorg',
      'cart' => $cart,
    ];

    return view('cart', $data);
  }

  public function checkout()
  {
    $cart = \Config\Services::cart();
    session()->setFlashdata('redirect', 'cart/checkout');

    $data = [
      'title' => 'Elit-Träning | Kassa',
      'cart' => $cart,
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      if ($validation->run($_POST, 'checkout')) {
        //TODO Skapa checkout validation

        // $order = new OrderModel();
        // $orderItem = new OrderItemModel();
        // $cart = \Config\Services::cart();

        // //TODO Lägg till faktura info
        // $orderData = [
        //   'customer_id' => session()->get('id') ?? null,
        //   'order_price' => $cart->total()
        // ];

        // $id = $order->insert($orderData);

        // foreach ($cart->contents() as $item) {
        //   $orderData = [
        //     'order_id' => $id,
        //     'product_id' => $item['product_id'],
        //     'quantity' => $item['qty']
        //   ];

        //   $orderItem->insert($orderData);
        // }
        // //TODO Skicka orderbekräftelse på mail
        // $cart->destroy();
        return redirect()->to('/cart/order');
      } else {
        $data['validation'] = $validation;
      }
    } else {
      $id = session()->get('id');
      if (isset($id)) {
        $model = new UserModel();

        $data['user'] = $model->getUser($id);
      }
    }

    return view('checkout', $data);
  }

  public function order()
  {
    $data = [
      'title' => 'Elit-Träning | Order',
    ];

    //TODO Visa en orderbekräftelse

    return view('orderConfirm', $data);
  }

  public function editCart()
  {
    $cart = \Config\Services::cart();
    //Om ett formulär är skickats med post
    if ($this->request->getMethod() == 'post') {
      $action = $this->request->getPost('action');
      $data['action'] = $action;
      switch ($action) {
        case 'delete':
          $rowid = $this->request->getPost('rowid');
          $cart->remove($rowid);
          return redirect()->back();
          break;

        case 'increase':
          $rowid = $this->request->getPost('rowid');
          $cart->increase($rowid);
          return redirect()->back();
          break;

        case 'decrease':
          $rowid = $this->request->getPost('rowid');
          $cart->decrease($rowid);
          return redirect()->back();
          break;
      }
    }
  }
}