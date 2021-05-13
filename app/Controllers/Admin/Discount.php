<?php 
namespace App\Controllers\Admin;

use App\Models\CouponModel;
use CodeIgniter\Controller;

class Discount extends Controller
{
  public function __construct() {
    helper('form');
  }

  /**
   * Skapa en rabattkod
   *
   * @return Redirect Till admin med meddelande
   */
  public function create()
  {
    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
      $validation->setRules([
        'discountName' => 'required|is_unique[coupons.name]',
        'productDiscount' => 'required|is_numeric'
      ]);
      
      if ($validation->run($_POST)) {
        $model = new CouponModel();

        $newCode = [
          'type' => $this->request->getPost('discountType'),
          'name' => $this->request->getPost('discountName'),
          'value' => $this->request->getPost('productDiscount')
        ];

        if($model->insert($newCode))
          return redirect()->to('/admin/panel')->with('success', 'Rabattkod skapad');
      }
      return redirect()->to('/admin/panel')->with('error', 'Rabattkoden finns redan eller så är den ogiltig');
    }
  }
  
  /**
   * Ta bort en rabattkod
   *
   * @param  string $name Namnet på rabattkoden
   * @return Redirect Till admin med meddelande
   */
  public function delete(string $name)
  {
    if (empty($name) || !preg_match('/^[A-Za-zÀ-ÿ0-9 ]+$/', $name))
      return redirect()->to('/admin/panel')->with('error', 'Något gick fel');

    $model = new CouponModel();

    return $model->where('name', $name)->delete()
            ? redirect()->to('/admin/panel')->with('success', 'Rabattkoden är borttagen')
            : redirect()->to('/admin/panel')->with('error', 'Något gick fel');
  }
}