<?php

namespace App\Models;

use CodeIgniter\Model;

class CouponModel extends Model
{
    protected $table      = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $allowedFields = ['type', 'name', 'value'];
}
