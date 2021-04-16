<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Cart extends Controller
{
  public function __construct()
  {
    helper('form');
  }
  
  /**
   * Visa varukorgen
   *
   * @return View Varukorgen
   */
  public function index()
  {
    $cart = \Config\Services::cart();

    $data = [
      'title' => 'Elit-Träning | Varukorg',
      'cart' => $cart,
    ];

    return view('layouts/checkout/cart', $data);
  }
  
  /**
   * Hanterar checkout
   *
   * @return View Checkout vyn
   */
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
        $order = new OrderModel();
        $orderItem = new OrderItemModel();
        $cart = \Config\Services::cart();
        
        $orderData = [
          'customer_id' => session()->get('id') ?? null,
          'email' => $this->request->getPost('email'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'address' => $this->request->getPost('address'),
          'zip_code' => $this->request->getPost('zipCode'),
          'city' => $this->request->getPost('city'),
          'phone' => $this->request->getPost('phone'),
          'order_price' => $cart->total(),
          'quantity' => $cart->totalItems(),
          'discount_value' => $cart->discountValue(),
          'shipping' => $cart->shipping()
        ];
        
        $id = $order->insert($orderData);
        
        foreach ($cart->contents() as $item) {
          $orderData = [
            'order_id' => $id,
            'product_id' => $item['product_id'],
            'quantity' => $item['qty'],
            'item_price' => $item['price']
          ];
          
          $orderItem->insert($orderData);
        }
        
        // if ($this->sendMail()) {
        //   $cart->destroy();
          session()->setFlashData('orderPlaced', true);
          return redirect()->to('/cart/orderConfirm')->with('orderId', $id);
        // }
      } else {
        $data['validation'] = $validation;
      }
    } else {
      if (session()->has('id')) {
        $model = new UserModel();
        $data['user'] = $model->getAddressDetails('billing', session()->get('id'))->getRowArray();
      }
    }

    return view('layouts/checkout/checkout', $data);
  }
  
  /**
   * Visa orderbekräftelsen
   *
   * @return View Orderbekräftelse
   */
  public function orderConfirm()
  {
    $orderModel = new OrderModel();
    $itemModel = new OrderItemModel();

    $order = $orderModel->find(session()->get('orderId'));
    $items = $itemModel->where('order_id', $order['order_id'])->findAll();
    
    $data = [
      'title' => 'Din order är slutförd',
      'email' => $order['email'],
      'orderNumber' => $order['order_number'],
      'orderPrice' => $order['order_price'],
      'orderItems' => $items,
    ];

    return view('layouts/checkout/orderConfirm', $data);
  }
  
  /**
   * Redigera varukorg
   *
   * @return void
   */
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
    
  /**
   * Ta bort rabattkoden
   *
   * @return Redirect Tillbaka till varukorgen
   */
  public function removeDiscount()
  {
    $cart = \Config\Services::cart();

    $cart->removeDiscount();
    return redirect()->back();
  }
  
  /**
   * Skicka iväg ett mail
   *
   * @return Bool Om mailet blev skickat
   */
  private function sendMail()
  {
    $data = [
      'cart' => \Config\Services::cart(),
      'email' => $this->request->getPost('email'),
      'firstname' => $this->request->getPost('firstname'),
      'lastname' => $this->request->getPost('lastname'),
      'address' => $this->request->getPost('address'),
      'zipCode' => $this->request->getPost('zipCode'),
      'city' => $this->request->getPost('city'),
      'phone' => $this->request->getPost('phone'),
    ];

    $email = \Config\Services::email();
    $message = view('emails/orderConfirmEmail', $data);
    $email->setTo($this->request->getPost('email'));
    $email->setSubject('Din Elit-Träning order är nu slutförd');
    $email->setMessage($message);

    return $email->send();
  }
}