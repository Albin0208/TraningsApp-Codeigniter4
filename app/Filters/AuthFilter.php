<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    //Hämta sessionen
    $session = \Config\Services::session();

    //Kolla om vi har en session och användaren är inloggad
    if (!isset($session) || isset($session) && $session->isLoggedIn != true) {
      return redirect()->to('/login');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
