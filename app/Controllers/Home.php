<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Elit-Träning | Startsida',
		];

		return view("home", $data);
	}
}
