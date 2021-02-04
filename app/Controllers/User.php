<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

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
    ];

    $model = new UserModel();

    $data['user'] = $model->where('id', session()->get('id'))->first();

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      $validation->setRuleGroup('updateUser');
      // $validation->setRules([
      //   'current_password' => [
      //     'rules' => 'required|matchesUser[current_password]',
      //     'label' => 'Nuvarande Lösenord',
      //     'errors' => [
      //       'required' => '{field}s fältet får inte vara tomt',
      //     ]
      //   ],
      //   'password' => [
      //     'rules' => 'required_with[current_password]|min_length[8]',
      //     'label' => 'Lösenord',
      //     'errors' => [
      //       'required' => '{field}s fältet får inte vara tomt',
      //       'min_length' => '{field} fältet måste vara minst 8 tecken',
      //     ]
      //   ],
      //   'confirm_password' => [
      //     'rules' => 'required_with[password]|matches[password]',
      //     'label' => 'Bekräfta lösenord',
      //     'errors' => [
      //       'matches' => '{field} matchar inte lösenordet',
      //     ]
      //   ],
      // ]);

      if ($validation->run($_POST)) {
      } else {
        $data['validation'] = $validation;
      }
    }

    return view('userLayouts/userProfile', $data);
  }

  public function orders()
  {
    $data = [
      'title' => 'Elit-Träning | Beställningar'
    ];

    return view('userLayouts/userOrders', $data);
  }

  public function programs()
  {
    $data = [
      'title' => 'Elit-Träning | Mina program'
    ];

    return view('userLayouts/userPrograms', $data);
  }
}
