<?php

namespace App\Validation;

use App\Models\UserModel;

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

    $user = $model->where('id', $data['id'])->first();

    return password_verify($data['current_password'], $user['password']);
  }
}
