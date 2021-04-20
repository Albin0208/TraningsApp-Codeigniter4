<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RestrictedFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    //Kolla om vi har en session och användaren är inloggad
    if ($this->request->getMethod() == 'get') {
      return redirect()->to('/');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}