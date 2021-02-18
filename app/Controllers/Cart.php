<?php

namespace App\Controllers;

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

    $data = [
      'title' => 'Elit-Träning | Kassa',
      'cart' => $cart,
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      if ($validation->run($_POST, 'checkout')) {

        //TODO Skapa checkout validation

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
          return redirect()->to(previous_url());
          break;

        case 'increase':
          $rowid = $this->request->getPost('rowid');
          $cart->increase($rowid);
          return redirect()->to(previous_url());
          break;

        case 'decrease':
          $rowid = $this->request->getPost('rowid');
          $cart->decrease($rowid);
          return redirect()->to(previous_url());
          break;

        case 'discount':
          $validation = \Config\Services::validation();

          $validation->setRule('discount_code', 'discount', 'validDiscount[discount_code]');

          if ($validation->run($_POST)) {
            $cart->setDiscountCode($this->request->getPost('discount_code'));
            return redirect()->to(previous_url());
          } else {
            $data['validation'] = $validation;
          }
          break;
      }
    }
  }
}
