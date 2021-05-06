<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['type', 'name', 'description', 'price', 'discount', 'discountType', 'image', 'slug'];
    
    /**
     * Hämta en produkt
     *
     * @param  string $slug Sluggen för produkten
     * @return array Produkten
     */
    public function getProduct($slug = null)
    {
        return $this->where('slug', $slug, true)->first();
    }
    
    /**
     * Hämta produkt information för 6 produkter
     *
     * @return array Produkterna
     */
    public function getProductsInfo()
    {
        $this->builder()
             ->join('productcategories', "category_id = type");

        return $this->paginate(6, 'products');
    }
    
    /**
     * Hämta alla produktersom inte är med i en kampanj
     *
     * @return array Produkterna
     */
    public function getProductsNotOnSale()
    {
        $builder = $this->db->table('products_on_sale');

        $result = $builder->select('product_id')
                          ->get()
                          ->getResultArray();

        $ids = [];
        for ($i=0; $i < count($result); $i++) { 
            $ids[$i] = $result[$i]['product_id'];
        }

        if (count($result) > 0)
            $this->builder()->whereNotIn('product_id', $ids);

        $this->builder()
             ->join('productcategories', "category_id = type");

        return $this->builder()
                    ->get()
                    ->getResultArray();
    }
    
    /**
     * Hämta produkter
     *
     * @param  string $product Produktnamnet
     * @return array Produkten
     */
    public function getProducts(string $product)
    {
        return $this->builder()
                    ->like('name', $product)
                    ->get()
                    ->getResultArray();
    }
}