<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ShopModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class User extends Controller
{
  public function __construct()
  {
    helper('form');
  }
  
  /**
   * Hantera användarprofilen
   *
   * @return View Mitt konto vyn
   */
  public function index()
  {
    $data = [
      'title' => 'Elit-Träning | Mitt Konto',
      'pageTitle' => 'Mitt Konto'
    ];

    $model = new UserModel();

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      $_POST['id'] = $data['id'] = session()->get('id');
      $validation->loadRuleGroup('updateUser');

      if ($this->request->getPost('password'))
        $validation->loadRuleGroup('updateUserPassword');

      if ($validation->run($_POST)) {
        $newData = [
          'id' => session()->get('id'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'username' => $this->request->getPost('username')
        ];

        //Om användaren vill ändra lösenord
        if ($this->request->getPost('current_password') && $this->request->getPost('password'))
          $newData['password'] = $this->request->getPost('password');

        if ($model->update($newData['id'], $newData) == false)
          return view('errors/errors', ['errors/errors' => $model->errors(), 'data' => $newData]);

        return redirect()->back()->with('success', 'Lyckad uppdatering');
      } else {
        $data['validation'] = $validation;
      }
      unset($data['id']);
    }

    $data['user'] = $model->getUser(session()->get('id'));
    return view('layouts/userLayouts/userProfile', $data);
  }
  
  /**
   * Visa alla ordrar av användaren
   *
   * @return View Ordrar vyn
   */
  public function orders()
  {
    $model = new OrderModel();

    $data = [
      'title' => 'Elit-Träning | Beställningar',
      'orders' => $model->where('customer_id', session()->get('id'))->orderBy('created_at', 'DESC')->paginate(5, 'group'),
      'pager' => $model->pager,
      'time' => new Time(),
      'pageTitle' => 'Mina Beställningar'
    ];

    return view('layouts/userLayouts/userOrders', $data);
  }
  
  /**
   * Visar en order
   *
   * @param int order nummret
   * @return View Order vyn
   */
  public function order(int $orderNumber)
  {
    $orderModel = new OrderModel();
    
    $order = $orderModel->where('order_number', $orderNumber)->first();
    
    //Se till att ordern tillhör den inloggade användaren
    if (session()->get('id') != $order['customer_id'])
    return redirect()->back();
    
    $itemModel = new OrderItemModel();
    $data = [
      'title' => 'Elit-Träning | Order',
      'pageTitle' => 'Order ' . $orderNumber,
      'orderDetails' => $order,
      'orderItems' => $itemModel->where('order_id', $order['order_id'])->findAll(),
      'time' => new Time(),
    ];

    return view('layouts/displayOrder', $data);
  }

  public function addresses()
  {
    $model = new UserModel();
    $id = session()->get('id');

    $data = [
      'title' => 'Elit-Träning | Adresser',
      'pageTitle' => 'Mina Adresser',
      'billing' => $model->getAddressDetails('billing', $id)->getRowArray(),
      'delivery' => $model->getAddressDetails('delivery', $id)->getRowArray()
    ];

    return view('layouts/userLayouts/userAddresses', $data);
  }

  public function editAddress($page)
  {
    if ($page != 'billing' && $page != 'delivery') {
      //Skicka till 404 sida
      echo '404';
      return;
    }

    $title = $page == 'billing' ? 'Faktureringsadress' : 'Leveransadress';
    $data = [
      'title' => 'Elit-Träning | ' . $title,
      'editTitle' => $title,
    ];

    $table = $page == 'billing' ? 'billing' : 'delivery';
    $id = session()->get('id');
    
    $model = new UserModel();
    $data['addressDetails'] = $model->getAddressDetails($table, $id)
                                    ->getRowArray();

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      $validation->loadRuleGroup($page == 'billing' ? 'billing' : 'delivery');

      if ($validation->run($_POST)) {
        $newData = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'address' => $this->request->getPost('address'),
          'city' => $this->request->getPost('city'),
          'zip_code' => $this->request->getPost('zipCode'),
          'email' => $this->request->getPost('email'),
          'phone' => $this->request->getPost('phone'),
        ];
        
        $model->updateAddress($table, $id, $newData);
        return redirect()->to(base_url() . '/user/addresses')->with('success', 'Adressändring genomfördes');
      } else {
        $data['validation'] = $validation;
      }
    }
    
    return view("edit/address", $data);
  }
}