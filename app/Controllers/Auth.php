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
        ];

        return $model->save($newData)
                ? redirect()->to("/login")->with('success', 'Lyckad registrering')  
                : redirect()->back()->with('error', 'Något gick fel vid registreringen, vänligen försök igen');
      } else {
        $data['validation'] = $validation;
      }
    }
    return view("auth/register", $data);
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
    //Spara flashdatan till nästa request
    session()->keepFlashdata('redirect');
    
    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      if ($validation->run($_POST, 'login')) {
        $model = new UserModel();
        $user = $model->getUser($this->request->getPost('email'));
        $this->setUserSession($user);
        
        //Om vi har redirect i session hämta dess värde annars sätt page till user
        $page = session()->getFlashdata('redirect') ?? 'user';

        return redirect()->to("/{$page}");
      } else {
        $data['validation'] = $validation;
      }
    }
    return view("auth/login", $data);
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
      'id' => $user['customer_id'],
      'firstname' => $user['firstname'],
      'lastname' => $user['lastname'],
      'email' => $user['email'],
      'username' => $user['username'],
      'isLoggedIn' => true,
    ];
    
    if ($user['isAdmin'] == 1) 
      $data['isAdmin'] = true;
      
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