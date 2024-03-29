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
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ0-9_]+$/]|is_unique[customers.username]',
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
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Efternamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'username' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ0-9_]+$/]|is_unique[customers.username,customer_id,{id}]',
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
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
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
			'rules' => 'cleanString[address]|required|regex_match[/^[A-Za-zÀ-ÿ0-9 ]+$/',
			'label' => 'Adress',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får innehålla bokstäver, mellanslag och siffror'
			]
		],
		'city' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ ]+$/]',
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

	public $billing = [
		'firstname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
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
		'address' => [
			'rules' => 'cleanString[address]|required|regex_match[/^[A-Za-zÀ-ÿ0-9 ]+$/',
			'label' => 'Adress',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får innehålla bokstäver, mellanslag och siffror'
			]
		],
		'city' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ ]+$/]',
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
		'email' => [
			'rules' => 'required|valid_email',
			'label' => 'Email',
			'errors' => [
				'required' => '{field} fältet får inte vara tomt',
				'valid_email' => '{field} fältet måste vara en giltig email adress'
			]
		],
	];

	public $delivery = [
		'firstname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
			'label' => 'Förnamn',
			'errors' => [
				'required' => '{field}s fältet får inte vara tomt',
				'regex_match' => '{field}et får bara innehålla bokstäver',
			]
		],
		'lastname' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ]+$/]',
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
		'address' => [
			'rules' => 'cleanString[address]|required|regex_match[/^[A-Za-zÀ-ÿ0-9 ]+$/',
			'label' => 'Adress',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får innehålla bokstäver, mellanslag och siffror'
			]
		],
		'city' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ ]+$/]',
			'label' => 'Stad',
			'errors' => [
				'required' => 'Fältet får inte vara tomt',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag'
			]
		],
	];

	public $newsletter = [
		'email' => [
			'rules' => 'required|valid_email|is_unique[newsletter.email]',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'valid_email' => 'Ange en giltig mailadress.',
				'is_unique' => 'Mailadressen är redan registrerad'
			]
		],
	];

	public $createProduct = [
		'productName' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ ]+$/]|is_unique[products.name]',
			'label' => 'namn',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag',
				'is_unique' => 'Det finns redan en produkt med detta namn'
			]
		],
		'productPrice' => [
			'rules' => 'required|alpha_numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'alpha_numeric' => 'Fältet får bara innehålla siffor'
			]
		],
		'type' => [
			'rules' => 'required|alpha_numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'alpha_numeric' => 'Ett alternativ måste vara valt'
			]
		],
		'productImage' => [
			'rules' => 'uploaded[productImage]|ext_in[productImage,png,jpg]',
			'errors' => [
				'uploaded' => 'En bild måste vara uppladdad',
				'ext_in' => 'Bilden måte vara en png eller jpg'
			]
		]
	];

	public $editProduct = [
		'productName' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ ]+$/]|is_unique[products.name,product_id,{id}]',
			'label' => 'namn',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag',
				'is_unique' => 'Det finns redan en produkt med detta namn'
			]
		],
		'productPrice' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'numeric' => 'Fältet får bara innehålla siffor'
			]
		],
		'type' => [
			'rules' => 'required|alpha_numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'alpha_numeric' => 'Ett alternativ måste vara valt'
			]
			],
			'productImage' => [
				'rules' => 'ext_in[productImage,png,jpg]',
				'errors' => [
					'ext_in' => 'Bilden måte vara en png eller jpg'
				]
			]
	];

	public $sale = [
		'productDiscount' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'numeric' => 'Fältet får bara innehålla siffor'
			]
		],
		'saleName' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ0-9 ]+$/]|is_unique[sale.sale_name]',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag',
				'is_unique' => 'Kampanjnamnet finns redan'
			]
		]
	];
	
	public $updateSale = [
		'productDiscount' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'numeric' => 'Fältet får bara innehålla siffor'
			]
		],
		'saleName' => [
			'rules' => 'required|regex_match[/^[A-Za-zÀ-ÿ0-9 ]+$/]|is_unique[sale.sale_name,sale_id,{sale_id}]',
			'errors' => [
				'required' => 'Fältet måste vara ifyllt.',
				'regex_match' => 'Fältet får bara innehålla bokstäver och mellanslag',
				'is_unique' => 'Kampanjnamnet finns redan'
			]
		]
	];
}