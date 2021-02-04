<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Shop extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'Elit träning | Butik'
    ];

    return view('shop', $data);
  }
}
