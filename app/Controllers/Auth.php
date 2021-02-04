<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
  public function __construct()
  {
    helper('form');
  }

  /**
   * Hanterar regristering
   *
   * @return View Regristerings vyn
   */
  public function register()
  {
    $data = [
      'title' => 'Elit-Träning | Bli medlem'
    ];

    //Om ett formulär är skickats med post
    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'register')) {
        $model = new UserModel();

        $newData = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'username' => $this->request->getPost('username'),
          'password' => $this->request->getPost('password'),
          'confirm_password' => $this->request->getPost('confirm_password'),
        ];
        if ($model->save($newData) == false)
          return view('errors/errors', ['errors/errors' => $model->errors(), 'data' => $newData]);

        $session = session();
        $session->setFlashdata('success', 'Lyckad registrering');

        return redirect()->to("/login");
      } else {
        $data['validation'] = $validation;
      }
    }
    return view("register", $data);
  }

  /**
   * Hanterar inloggning av användare
   *
   * @return View Login vyn
   */
  public function login()
  {
    $data = [
      'title' => 'Elit-Träning | Logga in'
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'login')) {
        $model = new UserModel();

        $user = $model->where('email', $this->request->getVar('email'))
          ->first();
        $this->setUserSession($user);
        return redirect()->to('/user');
      } else {
        $data['validation'] = $validation;
      }
    }
    return view("login", $data);
  }

  /**
   * Skapa en session för användaren
   *
   * @param  Array $user
   * @return void
   */
  private function setUserSession($user)
  {
    $data = [
      'id' => $user['id'],
      'firstname' => $user['firstname'],
      'lastname' => $user['lastname'],
      'email' => $user['email'],
      'username' => $user['username'],
      'isLoggedIn' => true
    ];
    session()->set($data);
    return;
  }

  /**
   * Logga ut användaren
   *
   * @return /Skickar tillbaka användaren till inloggningssidan
   */
  public function logout()
  {
    session()->destroy();
    return redirect()->to('/login');
  }
}
