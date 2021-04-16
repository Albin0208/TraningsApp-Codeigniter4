<?php

namespace App\Controllers;

use App\Models\CouponModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Coupon extends Controller
{  
  /**
   * Lägg till en rabattkod
   *
   * @return Redirect Tillbaka till föregående sida
   */
  public function index()
  {
    $validation = \Config\Services::validation();
    $cart = \Config\Services::cart();

    $validation->setRule('discount_code', 'discount', 'alpha_numeric|is_not_unique[coupons.name.discount_code]');

    if ($validation->run($_POST)) {
      $model = new CouponModel();
      $cart->setDiscountCode($model->where('name', $this->request->getPost('discount_code'))->first());
      return redirect()->back()->with('couponSuccess', 'Rabattkoden är tillagd');
    }
    return redirect()->back()->with('couponFail', 'Ogiltig rabattkod');
  }
  
  /**
   * Ta bort rabattkoden
   *
   * @return Redirect Tillbaka till föregående sida
   */
  public function delete()
  {
    $cart = \Config\Services::cart();
    $cart->removeDiscount();
    return redirect()->back();
  }
}