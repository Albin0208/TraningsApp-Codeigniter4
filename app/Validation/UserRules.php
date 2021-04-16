<?php

namespace App\Validation;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Validation\CreditCardRules;

class UserRules
{
  /**
   * Validerar så att användaren finns med i databasen,
   * Ser till att rätt lösenord är skrivet
   *
   * @param  String $str
   * @param  String $fields
   * @param  Array $data
   * @return Bool Om lösenordet stämmer
   */
  public function validateUser(string $str, string $fields, array $data)
  {
    $model = new UserModel();

    $user = $model->where('email', $data['email'])->first();

    if (!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }

  /**
   * matchesUser
   *
   * @param  String $str
   * @param  String $fields
   * @param  Array $data
   * @return Bool Om lösenordet matchar användares lösenord
   */
  public function matchesUser(string $str, string $fields, array $data)
  {
    $model = new UserModel();

    $user = $model->where('customer_id', $data['id'])->first();

    return password_verify($data['current_password'], $user['password']);
  }

  public function valid_expiration_date(string $str, string $fields, array $data)
  {
    $month = substr($str, 0,2);
    $year = substr($str, 3, 2);
    
    if (!checkdate($month, 1, $year))
    return false;
    
    $myTime = Time::today();
    $date = Time::createFromFormat('m/y', $str);

    return $myTime->isBefore($date);
  }

  public function cleanString(string &$str =null, string $fields, array $data)
  {
    $str = preg_replace('/[^a-z|å|ä|ö\d]/i', '', $str);
  }

  public function validateCard(string $str, string $fields, array $data)
  {
    $cards = ['mastercard', 'visa', 'maestro'];
    $cardRules = new CreditCardRules();
    
    foreach ($cards as $card) {
      if ($cardRules->valid_cc_number($str, $card))
        return true;
    }
    return false;
  }

  public function validName(string $str, string $fields, array $data)
  {
    return (bool) preg_match('/^(?![×÷])[A-Za-zÀ-ÿ]+$/m', $str);
  }
}