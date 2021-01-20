<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $register =   [
		'email' => [
			'rules' => 'required|valid_email',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig email adress',
			]
		]
	];
	// 'password' => 'required|min_length[8]',
	// 'confirm_password' => 'required|matches[password]',
	// 'fname' => 'required|alpha',
	// 'lname' => 'required|alpha',
	// 'uname' => 'required',
	// ];
}
