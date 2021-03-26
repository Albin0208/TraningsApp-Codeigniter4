<?php

namespace App\Controllers;

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

  public function index()
  {
    $data = [
      'title' => 'Elit-Träning | Mitt Konto',
      'pageTitle' => 'Min Profil'
    ];

    $model = new UserModel();

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      $_POST['id'] = $data['id'] = session()->get('id');
      $validation->loadRuleGroup('updateUser');

      if ($this->request->getPost('password')) {
        $validation->loadRuleGroup('updateUserPassword');
      }

      if ($validation->run($_POST)) {
        $newData = [
          'id' => session()->get('id'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'username' => $this->request->getPost('username')
        ];

        //Om användaren vill ändra lösenord
        if ($this->request->getPost('current_password') && $this->request->getPost('password')) {
          $newData['password'] = $this->request->getPost('password');
        }

        if ($model->update($newData['id'], $newData) == false)
          return view('errors/errors', ['errors/errors' => $model->errors(), 'data' => $newData]);

        session()->setFlashData('success', 'Lyckad uppdatering');
        return redirect()->to(current_url());
      } else {
        $data['validation'] = $validation;
      }
      unset($data['id']);
    }

    $data['user'] = $model->getUser(session()->get('id'));
    return view('layouts/userLayouts/userProfile', $data);
  }

  public function orders()
  {
    $model = new OrderModel();

    $data = [
      'title' => 'Elit-Träning | Beställningar',
      'orders' => $model->where('customer_id', 1)->orderBy('created_at', 'DESC')->paginate(10, 'group'),
      'pager' => $model->pager,
      'time' => new Time(),
      'pageTitle' => 'Mina Beställningar'
    ];

    return view('layouts/userLayouts/userOrders', $data);
  }

  public function order(int $orderId)
  {
    
  }

  public function programs()
  {
    $data = [
      'title' => 'Elit-Träning | Mina program',
      'pageTitle' => 'Mina Program'
    ];

    return view('layouts/userLayouts/userPrograms', $data);
  }
}