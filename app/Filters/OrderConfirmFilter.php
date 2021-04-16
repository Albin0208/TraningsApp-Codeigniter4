<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OrderConfirmFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    //Hämta sessionen
    $session = \Config\Services::session();
    
    if (!$session->has('orderPlaced') && $session->get('orderPlaced') == false) {
      if (current_url() == base_url().'/cart/orderConfirm')
        return redirect()->to('/');
        
      return redirect()->back();
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}