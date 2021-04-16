<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CartFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $uri = service('uri', current_url(true));

    if ($uri->getSegment(2) == 'orderConfirm')
      return;

    $cart = \Config\Services::cart();
    if ($cart->totalItems() < 1)
      return redirect()->to(base_url() . '/cart');
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}