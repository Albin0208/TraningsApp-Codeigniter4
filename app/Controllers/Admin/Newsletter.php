<?php 
namespace App\Controllers\Admin;

use App\Models\NewsletterModel;
use CodeIgniter\Controller;

class Newsletter extends Controller
{
  /**
   * Skicka nyhetsbrev
   *
   * @return Redirect Tillbaka admin sidan med meddelande
   */
  public function send()
  {
    if ($this->request->getMethod() == 'post') {
      $model = new NewsletterModel();
      $subscribers = $model->findAll();

      if (count($subscribers) == 0)
        return redirect()->to('/admin/panel')->with('error', 'Inget nyhetsbrev skickat. Det finns ingen som är registrerad på nyhetsbrevet');

      foreach ($subscribers as $subscriber) {
        $newsData = [
          'subject' => $this->request->getPost('subject'),
          'content' => $this->request->getPost('content'),
          'delete_key' => $subscriber['delete_key'],
        ];

        $email = \Config\Services::email();
        $message = view('emails/newsletterEmail', $newsData);
        $email->setTo($subscriber['email']);
        $email->setSubject('Elit-Träning | Nyhetsbrev');
        $email->setMessage($message);

        if (!$email->send())
          return redirect()->to('/admin/panel')->with('error', 'Något gick fel när ett nyhetsbrev skulle skickas');
      }
      return redirect()->to('/admin/panel')->with('success', 'Nyhetsbrevet är skickat');
    }
  }
}