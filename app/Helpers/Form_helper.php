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
      return '<span class="invalid-feedback text-dark bg-warning text-start ps-1">' .
        $validation->getError($field) . '</span>';
    } else {
      return '<span class="valid-feedback text-white bg-success text-start ps-1"> Ser bra ut! </span>';
    }
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
