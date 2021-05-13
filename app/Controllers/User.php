<?php
namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
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

        return $model->update($newData['id'], $newData)
                ? redirect()->back()->with('success', 'Lyckad uppdatering')
                : redirect()->to('/error');
      } else {
        $data['validation'] = $validation;
      }
      unset($data['id']);
    }

    $data['user'] = $model->getUser(session()->get('id'));
    return view('users/profile', $data);
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
      'orders' => $model->where('customer_id', session()->get('id'))->orderBy('created_at', 'DESC')->paginate(8, 'group'),
      'pager' => $model->pager,
      'time' => new Time(),
      'pageTitle' => 'Mina Beställningar'
    ];

    return view('users/orders', $data);
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

    return view('users/display_order', $data);
  }
  
  /**
   * Visa adresserna som tillhör en användare
   *
   * @return void
   */
  public function addresses()
  {
    $model = new UserModel();
    $id = session()->get('id');

    $data = [
      'title' => 'Elit-Träning | Adresser',
      'pageTitle' => 'Mina Adresser',
      'billing' => $model->getAddressDetails('billing', $id),
      'delivery' => $model->getAddressDetails('delivery', $id)
    ];

    return view('users/addresses', $data);
  }
  
  /**
   * Redigera en adress
   *
   * @param  string $page Vilken adress som ska redigeras
   * @return View Redigeringsvyn
   */
  public function editAddress(string $page)
  {
    if ($page != 'billing' && $page != 'delivery')
      return redirect()->to('/error');

    $title = $page == 'billing' ? 'Faktureringsadress' : 'Leveransadress';
    $data = [
      'title' => 'Elit-Träning | ' . $title,
      'editTitle' => $title,
      'page' => $page
    ];

    $table = $page == 'billing' ? 'billing' : 'delivery';
    $id = session()->get('id');
    
    $model = new UserModel();
    $data['addressDetails'] = $model->getAddressDetails($table, $id);

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
        ];
        
        // Om billing ändras lägg till mail och telefon
        if ($page == 'billing') {
          $newData['email'] = $this->request->getPost('email');
          $newData['phone'] = $this->request->getPost('phone');
        }
        
        return $model->updateAddress($table, $id, $newData)
                ? redirect()->to('/user/addresses')->with('success', 'Adressändring genomfördes')
                : redirect()->to('/error');
      } else {
        $data['validation'] = $validation;
      }
    }
    
    return view("users/edit_address", $data);
  }
}