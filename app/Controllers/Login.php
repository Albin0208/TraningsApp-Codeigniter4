<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
  public function index()
  {
    helper('form');
    $data = [
      'title' => 'Träning AB - Logga in'
    ];


    if ($this->request->getMethod() == 'post') {
      $rules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[8]'
      ];

      if ($this->validate($rules)) {
        //Logga in
        //Skapa ny användare
      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view("login", $data);
  }
}
