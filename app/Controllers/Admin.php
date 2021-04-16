<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'Elit-Träning | Admin',
    ];

    return view('/admin/adminpanel', $data);
  }
}