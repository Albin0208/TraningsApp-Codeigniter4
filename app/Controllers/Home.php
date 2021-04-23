<?php

namespace App\Controllers;

use App\Models\NewsletterModel;
use App\Models\SaleModel;
use App\Models\ShopModel;

class Home extends BaseController
{
	public function index()
	{
		helper('form');

		$model = new ShopModel();
		$saleModel = new SaleModel();

		$data = [
			'title' => 'Elit-Träning | Startsida',
			'products' => $model->paginate(8, 'group'),
			'sales' => $saleModel->findAll(),
			'noccos' => $model->getProducts('Nocco')
		];

		return view("home", $data);
	}
	
	/**
	 * Bli medlem i nyhetsbrevet
	 *
	 * @return void
	 */
	public function newsletterSignup()
	{
		if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();
			
      if ($validation->run($_POST, 'newsletter')) {
				$model = new NewsletterModel();

				$data['email'] = $this->request->getPost('email');

				do {
					$deleteKey = md5(uniqid(rand(), true));
				} while ($model->where('delete_key', $deleteKey)->first());

				$data['delete_key'] = $deleteKey;
				$model->insert($data);

				$email = \Config\Services::email();

				$email = \Config\Services::email();
				$message = view('emails/newsletterSignup', $data);
				$email->setTo($data['email']);
				$email->setSubject('Elit-Träning Nyhetsbrev');
				$email->setMessage($message);
				$email->send();
				
				return redirect()->back()->with('newsletter', 'Lyckad registrering');
      } else {
        $data['validation'] = $validation;
				return redirect()->back()->with('error', $validation->getError('email'));
      }
    }
		return redirect()->back();
	}
	
	/**
	 * Avregristrera emailen från nyhetsbrevet
	 *
	 * @return View
	 */
	public function unsubscribe(string $key)
	{
		$model = new NewsletterModel();

		if (empty($key) || !$model->where('delete_key', $key)->first())
			return redirect()->to('/');

		$model->where('delete_key', $key)->delete();

		$data = [
			'title' => 'Elit-Träning | Nyhetsbrev'
		];

		return view('layouts/unsubscribe', $data);
	}
}