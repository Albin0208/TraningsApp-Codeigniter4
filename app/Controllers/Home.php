<?php

namespace App\Controllers;

use App\Models\ShopModel;

class Home extends BaseController
{
	public function index()
	{
		helper('form');

		$model = New ShopModel();
		$data = [
			'title' => 'Elit-Träning | Startsida',
			'products' => $model->paginate(8, 'group'),
      // 'cart' => session()->get('cart_contents')
		];

		return view("home", $data);
	}
}