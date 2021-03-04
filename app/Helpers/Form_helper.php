<?php

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Skriv ut eventuellt felmeddelande
 *
 * @param String $field Inputfältet
 * @return String Felmeddelandet
 */
function displayError(string $field)
{
  if (!empty($_POST)) {
    $validation = \Config\Services::validation();
    if ($validation->hasError($field)) {
      return '<div class="mt-1 alert alert-danger atext-danger aposition-absolute text-start">' .
        $validation->getError($field) . '</div>';
      // return '<div class="invalid-feedback text-dark bg-danger text-start ps-1">' .
      //   $validation->getError($field) . '</div>';
    }
    return;
  }
}

function getError($field)
{
  if (!empty($_POST)) {
    $validation = \Config\Services::validation();
    if ($validation->hasError($field))
      return $validation->getError($field);
  }
}

/**
 * Hämta om det finns ett fel på inputfältet
 *
 * @param String $field Inputfältet
 * @return Boolean Om det finns ett fel
 */
function isInvalidLogin(string $field)
{
  if (!empty($_POST)) {
    $validation = \Config\Services::validation();
    return $validation->hasError($field) ? true : false;
  }
}

/**
 * Hämta om det finns ett fel på inputfältet
 *
 * @param String $field Inputfältet
 * @return Boolean Om det finns ett fel
 */
function isInvalid(string $field)
{
  if (!empty($_POST)) {
    $validation = \Config\Services::validation();
    return $validation->hasError($field) ? 'is-invalid' : 'is-valid';
  }
}
