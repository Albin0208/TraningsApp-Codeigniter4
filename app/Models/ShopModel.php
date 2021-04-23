<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['type', 'name', 'description', 'price', 'discount', 'discountType', 'image', 'slug'];

    public function getProduct($slug = null)
    {
        return $this->where('slug', $slug, true)->first();
    }

    public function getProductsInfo()
    {
        $this->builder()
             ->join('productcategories', "category_id = type");

        return $this->paginate(6, 'group');
    }

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

    public function getProducts(string $product)
    {
        return $this->builder()
                    ->like('name', $product)
                    ->get()
                    ->getResultArray();
    }
}