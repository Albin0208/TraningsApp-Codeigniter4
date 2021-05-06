<?php

namespace App\Libraries;

class Cart
{

  /**
   * Innehållet i varukorgen
   *
   * @var array
   */
  protected $cartContents = [];

  /**
   * Session Service
   *
   * @var \CodeIgniter\Session\Session $session
   */
  protected $session;

  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->session = session();

    //Hämta varukorgen från sessionen
    $this->cartContents = $this->session->get('cart_contents');
    if ($this->cartContents === null) {
      //Ingen varukorg finns, sätt några basvärden
      $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
    }
  }
  
  /**
   * Lägg till produkter i varukorgen
   *
   * @param  array $items Produkterna som ska läggas till
   * @return Rowid id för raden som skapades
   */
  public function insert($items = [])
  {
    //Se till så att data är skickad
    if (!is_array($items) || count($items) === 0) {
      return false;
    }

    $save_cart = false;
    if (isset($items['product_id'])) {
      if ($this->_insert($items))
        $save_cart = true;
    }

    if ($save_cart) {
      $this->saveCart();
      return $rowid ?? true;
    }

    return false;
  }
  
  /**
   * Protected - Lägg till produkter i varukorgen
   *
   * @param  array $items Produkterna som ska läggas till
   * @return Rowid id för raden som skapades
   */
  protected function _insert($items = [])
  {
    //Se till så att data är skickad
    if (!is_array($items) || count($items) === 0)
      return false;

    //Innehåller arrayen id, quantity, price och name? Dessa är nödvändiga
    if (!isset($items['product_id'], $items['qty'], $items['price'], $items['name']))
      return false;

    /*
      Skapa ett unikt id för produkterna.
      Varje produkt måste ha ett unikt id för att kunna spara samma produkt med olika alternativ.
    */
    if (isset($items['options']) && count($items['options']) > 0)
      $rowid = md5($items['product_id'] . serialize($items['options']));
    else
      $rowid = md5($items['product_id']);

    $old_quantity = isset($this->cartContents[$rowid]['qty']) ? $this->cartContents[$rowid]['qty'] : 0;

    $items['rowid'] = $rowid;
    $items['qty'] += $old_quantity;
    $this->cartContents[$rowid] = $items;

    return $rowid;
  }
  
  /**
   * Uppdatera varukorgen
   *
   * @param  array $items Produkterna som ska uppdateras
   * @param  string $rowid Radid
   * @return Bool Om uppdateringen lyckades
   */
  public function update($items = [], $rowid = null)
  {
    //Se till så att data är skickad
    if (!is_array($items) || count($items) === 0)
      return false;

    $save_cart = false;
    if (array_key_exists($rowid, $this->cartContents)) {
      if ($this->_update($items, $rowid))
        $save_cart = true;
    }

    // Save the cart data if the insert was successful
    if ($save_cart === true) {
      $this->saveCart();
      return true;
    }

    return false;
  }

  /**
   * Protected - Uppdatera varukorgen
   *
   * @param  array $items Produkterna som ska uppdateras
   * @param  string $rowid Radid
   * @return Bool Om uppdateringen lyckades
   */
  protected function _update($items = [], $rowid = null)
  {
    //Se till så att data är skickad
    if (!is_array($items) || count($items) === 0 || !isset($rowid))
      return false;

    $oldItem = $this->getItem($rowid);

    $oldItem['qty'] += $items['qty'];

    $this->cartContents[$rowid] = $oldItem;
  }
  
  /**
   * Öka antalet produkten
   *
   * @param  string $rowid Produktens rad id
   * @return Bool Om lyckad uppdatering
   */
  public function increase($rowid = null)
  {
    //Se till så vi har ett rad id
    if (!isset($rowid))
      return false;

    $save_cart = false;
    if ($this->_increase($rowid))
      $save_cart = true;

    if ($save_cart) {
      $this->saveCart();
      return true;
    }

    return false;
  }
  
  /**
   * Protected - Öka antalet produkten
   *
   * @param  string $rowid Produktens rad id
   * @return Bool Om lyckad uppdatering
   */
  protected function _increase($rowid)
  {
    //Se till att vi har ett rad id
    if (!isset($rowid))
      return false;

    $item = $this->getItem($rowid);

    $item['qty']++;

    $this->cartContents[$rowid] = $item;
    return true;
  }
  
  /**
   * Minska antalet produkten
   *
   * @param  string $rowid Produktens rad id
   * @return Bool Om lyckad uppdatering
   */
  public function decrease($rowid = null)
  {
    //Se till så vi har ett rad id
    if (!isset($rowid))
      return false;

    $save_cart = false;
    if ($this->_decrease($rowid))
      $save_cart = true;

    if ($save_cart) {
      $this->saveCart();
      return true;
    }

    return false;
  }

  /**
   * Protected - Minska antalet produkten
   *
   * @param  string $rowid Produktens rad id
   * @return Bool Om lyckad uppdatering
   */
  protected function _decrease($rowid)
  {
    //Se till att vi har ett rad id
    if (!isset($rowid))
      return false;

    $item = $this->getItem($rowid);

    $item['qty']--;

    if ($item['qty'] === 0) {
      unset($this->cartContents[$rowid]);
      return true;
    }

    $this->cartContents[$rowid] = $item;
    return true;
  }

  public function hasOptions($rowid)
  {
    //TODO Fixa options
  }

  public function productOptions($rowid)
  {
    //TODO Fixa options
  }
  
  /**
   * Rabattkodens värde beroende av produktpriset
   *
   * @return int Värdet på rabattkoden
   */
  public function discountValue()
  {
    if (@$this->cartContents['discount_code']) {
      if ($this->cartContents['discount_code']['type'] == 'SEK')
        return $this->cartContents['discount_code']['value'];
      else if ($this->cartContents['discount_code']['type'] == 'Percent') {
        $percent = $this->cartContents['discount_code']['value'] / 100;
        return $this->total() * $percent;
      }
    }
    return false;
  }
  
  /**
   * Värdet på rabattkoden
   *
   * @return int Värdet på rabatt koden
   */
  public function discountTotal()
  {
    if (@$this->cartContents['discount_code'])
      return $this->cartContents['discount_code']['value'];
  }
  
  /**
   * Vilken typ av rabatt det är
   *
   * @return string Typen av rabatt
   */
  public function discountType()
  {
    if ($this->cartContents['discount_code'])
      return $this->cartContents['discount_code']['type'];
  }
  
  /**
   * Spara en rabatt kod i varukorgen
   *
   * @param  string $discountCode Rabattkoden
   * @return void
   */
  public function setDiscountCode($discountCode)
  {
    $this->cartContents['discount_code'] = [
      'code' => $discountCode['name'],
      'value' => $discountCode['value'],
      'type' => $discountCode['type']
    ];
    $this->saveCart();
  }
  
  /**
   * Ta bort rabattkoden som finns i varukorgen
   *
   * @return void
   */
  public function removeDiscount()
  {
    unset($this->cartContents['discount_code']);
    $this->saveCart();
  }
  
  /**
   * Hämta namnet på rabattkoden
   *
   * @return string Namnet på rabattkoden
   */
  public function discountCode()
  {
    if (@$this->cartContents['discount_code'])
      return $this->cartContents['discount_code']['code'];
    return false;
  }
  
  /**
   * Protected - Spara varukorgen
   *
   * @return Bool Om lyckad sparning
   */
  protected function saveCart()
  {
    $this->cartContents['total_items'] = $this->cartContents['cart_total'] = 0;
    foreach ($this->cartContents as $key => $val) {
      //Se till att arrayen är korrekt
      if (!is_array($val) || !isset($val['price'], $val['qty']))
        continue;

      $this->cartContents['cart_total'] += $val['price'] * $val['qty'];
      $this->cartContents['total_items'] += $val['qty'];
      $this->cartContents[$key]['subtotal'] = $this->cartContents[$key]['price'] * $this->cartContents[$key]['qty'];
    }

    // Är varukorgen tom? Isåfall ta bort den från sessionen
    if (count($this->cartContents) <= 1)
      $this->session->remove('cart_contents');

    //Lägg till varukorgen i sessionen
    $this->session->set('cart_contents', $this->cartContents);

    return true;
  }
  
  /**
   * Totalen för produkterna
   *
   * @return int Totalen
   */
  public function total()
  {
    return $this->cartContents['cart_total'];
  }

  /**
   * Ta bort vara från varukorgen
   *
   * @param  string $rowid
   * @return Bool
   */
  public function remove($rowid)
  {
    unset($this->cartContents[$rowid]);
    $this->saveCart();
    return true;
  }
  
  /**
   * Antalet varor i varukorgen
   *
   * @return int Antalet varor
   */
  public function totalItems()
  {
    return $this->cartContents['total_items'];
  }
  
  /**
   * Hämta innehållet i varukorgen
   *
   * @return array Innehållet i varukorgen
   */
  public function contents()
  {
    $cart = $this->cartContents;

    unset($cart['total_items'], $cart['cart_total'], $cart['discount_code']);

    return $cart;
  }
  
  /**
   * Hämta en specifik vara från varukorgen
   *
   * @param  string $rowid Id för varan
   * @return array Varan
   */
  public function getItem($rowid)
  {
    return (in_array($rowid, ['total_items', 'cart_total'], true) or !isset($this->cartContents[$rowid]))
      ? false
      : $this->cartContents[$rowid];
  }
  
  /**
   * Hämta fraktvärdet
   *
   * @return int Fraktvärdet
   */
  public function shipping()
  {
    return $this->cartContents['cart_total'] > 499 ? 0 : 49;
  }

  /**
   * Tömmer varukorgen och förstör sessionen
   *
   * @return void
   */
  public function destroy()
  {
    $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
    $this->session->remove('cart_contents');
  }
}