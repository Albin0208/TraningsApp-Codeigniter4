<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table      = 'order_item';
    protected $primaryKey = 'order_id';

    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'item_price'];
    protected $useTimestamps = false;
}