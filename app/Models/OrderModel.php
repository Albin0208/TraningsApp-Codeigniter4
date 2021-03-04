<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'order_id';

    protected $allowedFields = ['customer_id', 'order_price'];
}