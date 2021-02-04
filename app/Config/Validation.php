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
		\App\Validation\UserRules::class,
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

	public $login = [
		'email' => [
			'rules' => 'required|valid_email',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig email adress',
			]
		],
		'password' => [
			'rules' => 'required|validateUser[email,password]',
			'label' => 'Lösenord',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'validateUser' => 'Användaren finns inte'
			]
		]
	];

	public $register =   [
		'email' => [
			'rules' => 'required|valid_email|is_unique[users.email]',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig email adress',
				'is_unique' => '{field} adressen är upptagen'
			]
		],
		'password' => [
			'rules' => 'required|min_length[8]',
			'label' => 'Lösenord',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'min_length' => '{field} fältet måste vara minst 8 tecken',
			]
		],
		'confirm_password' => [
			'rules' => 'matches[password]',
			'label' => 'Bekräfta lösenord',
			'errors' => [
				'matches' => '{field} matchar inte lösenordet',
			]
		],
		'firstname' => [
			'rules' => 'required|regex_match[[a-z]|å|ä|ö[A-Z]|Å|Ä|Ö]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[[a-z]|å|ä|ö[A-Z]|Å|Ä|Ö]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|alpha_numeric|is_unique[users.username]',
			'label' => 'Användarnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'alpha_numeric' => '{field}et får bara innehålla bokstäver och siffror',
				'is_unique' => '{field}et är upptaget'
			]
		],
	];

	public $updateUser =   [
		'firstname' => [
			'rules' => 'required|regex_match[[a-z]|å|ä|ö[A-Z]|Å|Ä|Ö]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[[a-z]|å|ä|ö[A-Z]|Å|Ä|Ö]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|alpha_numeric|is_unique[users.username]',
			'label' => 'Användarnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'alpha_numeric' => '{field}et får bara innehålla bokstäver och siffror',
				'is_unique' => '{field}et är upptaget'
			]
		],
	];
}
