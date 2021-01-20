<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Register extends Controller
{
  public function index()
  {
    helper('form');
    $data = [
      'title' => 'Träning AB - Bli medlem'
    ];


    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      // $rules = [
      //   'email' => [
      //     'rules' => 'required|valid_email',
      //     'label' => 'Email',
      //     'errors' => [
      //       'required' => '{field} fältet får inte vara tomt',
      //       'valid_email' => '{field} fältet måste vara en giltig email adress',
      //     ]
      //   ],
      //   'password' => 'required|min_length[8]',
      //   'confirm_password' => 'required|matches[password]',
      //   'fname' => 'required|alpha',
      //   'lname' => 'required|alpha',
      //   'uname' => 'required',
      // ];

      // if ($validation->run($data, 'register')) {
      //   //Logga in
      //   //Skapa ny användare
      // } else {
      //   $data['errors'] = $validation->getErrors();
      // }

      $rules = $validation->getRuleGroup('register');

      if ($this->validate($rules)) {
        //Logga in
        //Skapa ny användare
      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view("register", $data);
  }
}
