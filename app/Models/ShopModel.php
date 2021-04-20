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
             ->select('*')
             ->join('productcategories', "category_id = type");

        return $this->paginate(6, 'group');
    }
}