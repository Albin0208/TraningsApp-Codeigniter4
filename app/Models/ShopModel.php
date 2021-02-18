<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'product_id';

    public function getProduct($slug = null)
    {
        return $this->where('slug', $slug)->first();
    }
}
