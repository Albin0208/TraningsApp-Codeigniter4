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
			'rules' => 'required|valid_email|is_unique[customers.email]',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig emailadress',
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
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|regex_match[/^[A-Z0-9åäöÅÄÖ]+$/i]|is_unique[customers.username]',
			'label' => 'Användarnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver och siffror',
				'is_unique' => '{field}et är upptaget'
			]
		],
	];

	public $updateUser =   [
		'firstname' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|regex_match[/^[A-Z0-9åäöÅÄÖ]+$/i]|is_unique[customers.username,customer_id,{id}]',
			'label' => 'Användarnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver och siffror',
				'is_unique' => '{field}et är upptaget'
			]
		],
	];

	public $updateUserPassword = [
		'current_password' => [
			'rules' => 'required_with[password]|matchesUser[current_password]',
			'label' => 'Nuvarande Lösenord',
			'errors' => [
				'matchesUser' => 'Fel lösenord',
				'required_with' => '{field}s fältet måste vara ifyllt',
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
	];

	public $checkout = [
		'email' => [
			'rules' => 'required|valid_email',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig email adress'
			]
		],
		'firstname' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö]+$/i]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'zipCode' => [
			'rules' => 'cleanString[zipCode]|required|numeric|exact_length[5]',
			'label' => 'Postnummer',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'numeric' => 'Fältet får bara innehålla siffror',
				'exact_length' => 'Fältet måste vara 5 siffror långt',
			]
		],
		'socialNumber' => [
			'rules' => 'cleanString[socialNumber]|required|numeric|exact_length[10]',
			'label' => 'Personnummer',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'numeric' => 'Fältet får bara innehålla siffror',
				'exact_length' => 'Fältet måste vara {param} siffror långt',
			]
		],
		'address' => [
			'rules' => 'cleanString[address]|required|regex_match[[a-z]|å|ä|ö ]/i',
			'label' => 'Adress',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får innehålla bokstäver, mellanslag och siffror'
			]
		],
		'city' => [
			'rules' => 'required|regex_match[/^[A-ZÅÄÖåäö ]+$/i]',
			'label' => 'Stad',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag'
			]
		],
		'phone' => [
			'rules' => 'required|numeric|min_length[7]|max_length[13]',
			'label' => 'Telefonnummer',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'numeric' => 'Fältet får bara innehålla siffror',
				'min_length' => 'Fältet måste innehålla minst {param} siffror',
				'max_length' => 'Fältet får innehålla max {param} siffror'
			]
		],
		'cardNumber' => [
			'rules' => 'required|validateCard[cardNumber]',
			'label' => 'Kortnummer',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'validateCard' => 'Ange antingen ett mastercard, visa eller maestro'
			]
		],
		'expiration' => [
			'rules' => 'required|valid_expiration_date[expiration]',
			'label' => '',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'valid_expiration_date' => 'Ogiltigt utgångsdatum'
			]
		],
		'cvc' => [
			'rules' => 'required|numeric|exact_length[3]',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'numeric' => 'Fältet får bara innehålla siffror',
				'exact_length' => 'Fältet måste vara exakt {param} siffror'
			]
		],
	];
}