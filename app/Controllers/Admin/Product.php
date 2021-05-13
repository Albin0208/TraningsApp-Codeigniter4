<?php 
namespace App\Controllers\Admin;

use App\Models\CategoriesModel;
use App\Models\ShopModel;
use CodeIgniter\Controller;

class Product extends Controller
{
  public function __construct() {
    helper('form');
  }
  
  /**
   * Skapa en ny produkt
   *
   * @return View
   */
  public function create()
  {
    $categories = new CategoriesModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Skapa produkt',
      'categories' => $categories->findAll()
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'createProduct')) {
        $file = $this->request->getFile('productImage');

        if ($file->isValid() && !$file->hasMoved())
          $file->move('.' . IMAGE_PATH);
        
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'image' => IMAGE_PATH . $file->getName(),
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];

        $model = new ShopModel();

        return $model->insert($productData)
                ? redirect()->to('/admin/panel')->with('success', 'Produkten är skapad')
                : redirect()->to('/admin/panel')->with('error', 'Något gick fel när produkten skulle skapas');
      } else
        $data['validation'] = $validation;
    }

    return view('admin/products/create', $data);
  }
  
  /**
   * Redigera en befintlig produkt
   *
   * @param  string $slug Sluggen till produkten som ska redigeras
   * @return View
   */
  public function edit(string $slug)
  {
    $model = new ShopModel();
    $categories = new CategoriesModel();

    $data = [
      'title' => 'Elit-Träning | Admin - Redigera produkt',
      'product' => $model->getProduct($slug),
      'categories' => $categories->findAll()
    ];

    if ($this->request->getMethod() == 'post') {
      $validation = \Config\Services::validation();

      if ($validation->run($_POST, 'editProduct')) {
        $productData = [
          'type' => $this->request->getPost('type'),
          'name' => $this->request->getPost('productName'),
          'description' => $this->request->getPost('productDescription'),
          'price' => $this->request->getPost('productPrice'),
          'slug' => $this->generateSlug($this->request->getPost('productName')),
        ];

        $file = $this->request->getFile('productImage');

        if ($file->isValid() && !$file->hasMoved()) {
          unlink('.' . $data['product']['image']);
          $productData['image'] = $file->move('.' .IMAGE_PATH);
        }
        
        $model = new ShopModel();

        return $model->update($this->request->getPost('id'), $productData)
                ? redirect()->to('/admin/panel')->with('success', 'Produkten är uppdaterad')
                : redirect()->to('/admin/panel')->with('error', 'Något gick fel när produkten skulle uppdateras');
        
      } else
        $data['validation'] = $validation;
    }
      
    return view('admin/products/edit', $data);
  }
  
  /**
   * Ta bort en produkt
   *
   * @param  string $slug
   * @return Redirect Tillbaka till admin sidan
   */
  public function delete(string $slug)
  {
    if (empty($slug) || !preg_match('/^[a-z-]+$/', $slug))
      return redirect()->to('/admin/panel')->with('error', 'Något gick fel');
      
    $model = new ShopModel();

    $productImage = $model->where('slug', $slug)->first();

    if (file_exists('./' . $productImage['image']))
      unlink('./' . $productImage['image']);

    $model->where('slug', $slug)->delete();

    return redirect()->to('/admin/panel')->with('success', 'Produkten är borttagen');
  }
  
  /**
   * Generera en slug från en sträng
   *
   * @param  string $text Strängen som ska bli en slug
   * @return string Slugen
   */
  private function generateSlug(string $text)
  {
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
  }

}