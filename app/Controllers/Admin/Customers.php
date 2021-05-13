<?php 
namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Customers extends Controller
{
  public function __construct() {
    helper('form');
  }
  
    /**
   * Visa en kund
   *
   * @param  string $username Användarnamnet
   * @return View Kundvyn
   */
  public function view(string $username)
  {
    $model = new UserModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Användare',
      'customer' => $model->where('username', $username)->first(),
    ];

    return view('admin/customers/single_customer', $data);
  }
}